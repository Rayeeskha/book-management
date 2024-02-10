<?php

namespace App\Repositories\Backend;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use DataTables;
use CustomHelper;

class UserRepository extends BaseRepository
{
	public function model()
    {
        return User::class;
    }

    public function index($module_id){

        $data = User::with('role')->select('*',\DB::raw('@rownum  := @rownum  + 1 AS DT_RowIndex'))->orderBy('id', 'DESC');
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row) use($module_id){
                    $deletePermission = CustomHelper::checkPermission($module_id, 'delete_per');
                    $editPermission = CustomHelper::checkPermission($module_id, 'edit_per');
                    $btn = ''; 
                    if ($editPermission) {
                        $btn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm float-left mr-1 editUser" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="bx bx-edit text-white"></i></a>';
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

                })->editColumn('role_id', function($row){
                    return $row->role->name ?? 'N/A';

                })->rawColumns(['action', 'status'])->make(true);
    }

    public function store($data){
        $id = @$data['id'];
        $password = Hash::make($data['password']);

        if($id > 0){
            if(empty($data['password'])){
                $user  = User::where('id', $id)->first();
                $data['password'] = $user->password;
            }else{
                $data['password'] = $password;
            }
        }else{
            $data['password'] = $password;
        }

        User::updateOrCreate(['id' => $id], $data);
        return  $id > 0 ? 'Updated Sucessfully' : 'Added Successfully';
    }

}