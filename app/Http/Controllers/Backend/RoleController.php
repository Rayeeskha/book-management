<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Traits\Authorization;
use App\Models\Module;
use App\Models\Role;
use CustomHelper;

class RoleController extends Controller
{
    use Authorization;

    protected $roleRepository;

    private $module_id = 'RolePermission';

    public function __construct(RoleRepository $roleRepository) {
        $this->roleRepository = $roleRepository;

        $this->middleware(function ($request, $next) {
            $this->authorizedAccessPermission($this->module_id);
            return $next($request);
        });
    }

    public function index(Request $request){
        if ($request->ajax()) {
            return $this->roleRepository->index($this->module_id);
        }
        return view('backend.roles.index');
    }

    public function create()
    {
        return view('backend.roles.create')->with('modules', Module::wherestatus(1)->orderBy('id', 'desc')->get());
    }

    public function store(RoleRequest $request)
    {
        $request->validated();
        try {
            $response = $this->roleRepository->store($request->all());
            // dd($response);
            return response()->json(['success' => true,'message' => $response,'url'=> route('admin.roles.index')],200);
            
        }catch (\Throwable $e)  {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function edit(Role $role)
    {
        $previllage = json_decode($role->permissions, true);
        
        $modules = CustomHelper::getModules();
        return view('backend.roles.edit', compact('modules','role', 'previllage'));
    }

    public function getRole(){
        return response()->json([ 'roles' => Role::orderBy('name', 'ASC')->select('id', 'name')->wherestatus(1)->cursor() ]);  
    }


}   
