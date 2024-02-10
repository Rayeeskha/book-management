<?php

namespace App\Repositories\Backend;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use App\Models\Role;
use Auth;
use DataTables;
use CustomHelper;

class RoleRepository extends BaseRepository
{
	public function model()
    {
        return Role::class;
    }

    public function index($module_id){

        $data = Role::select('id','name','permissions','description','status','created_at',\DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->orderBy('id', 'DESC');
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use($module_id){
                    $deletePermission = CustomHelper::checkPermission($module_id, 'delete_per');
                    $editPermission = CustomHelper::checkPermission($module_id, 'edit_per');
                    $btn = ''; 
                    if ($editPermission) {
                        $btn .= '<a href="'.route('admin.roles.edit', $row->id).'" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="bx bx-edit text-white"></i></a>';
                    }                                       
                    if ($deletePermission) {
                        $btn .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="delete btn btn-danger btn-sm deleteDataTableRow" style="height:30px; width:30px;border-radius:50%"><span class="bx bx-trash text-white"></span></a>';
                    }
                    return $btn;
                })->editColumn('status', function($row) use($module_id){
                    $statusPermission = CustomHelper::checkPermission($module_id, 'status_per');                    
                    $active = $row->status == '1' ? "checked" : '';
                    $x = ($active) ? " switch3-checked " : " ";
                    return '<div class="form-check form-switch form-switch-right form-switch-md">
                        <label for="rounded-button" class="form-label text-muted '.$x.' "></label>
                        <input class="form-check-input code-switcher status_change_datatable" type="checkbox" id="rounded-button" '.$active.'>
                    </div>';  

                })->editColumn('created_at', function($row){
                    return date('d M Y',strtotime($row->created_at));

                })->addColumn('permissions', function($row){
                    $permissionsData= [];
                    if (!empty($row->permissions)) {
                        $permissions = json_decode($row->permissions, true);
                        foreach($permissions as $value){
                            array_push($permissionsData, @$value['module_id']);
                        }
                    }
                    return implode(',', $permissionsData);
                    
                })->rawColumns(['action', 'status'])->make(true);
    }

    public function store($data){
        try {
            $id = @$data['id'];
            $moduleData = [];
            if (!empty($data['module_id'])) {
                foreach($data['module_id'] as $key => $value){
                    $add = $value.'_add';
                    $edit = $value.'_edit';
                    $view = $value.'_view';                     
                    $status = $value.'_status';
                    $delete = $value.'_delete';
                    // $list = $value.'_view';
                    $add_per = (isset($data[$add]))?1:0;
                    $edit_per = (isset($data[$edit]))?1:0;
                    $view_per = (isset($data[$view]))?1:0;
                    $status_per = (isset($data[$status]))?1:0;
                    $delete_per = (isset($data[$delete]))?1:0;
                    // $list_per = $list;
                    $moduleData[] =  [
                        'module_id' => $value,
                        'add_per' => $add_per,                        
                        'edit_per' => $edit_per,
                        'view_per' => $view_per,
                        'status_per' => $status_per,
                        'delete_per' => $delete_per,
                    ];
                }
            }
            
            Role::updateOrCreate(['id' => $id], [
                'name' => $data['role_name'],
                'description' => $data['role_description'],
                'permissions' => json_encode($moduleData),
                'status'      => 1
            ]);
            return  $id > 0 ? 'Updated Sucessfully' : 'Added Successfully';

        }catch (\Throwable $e)  {
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

}