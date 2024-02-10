<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\UserRepository;
use App\Traits\Authorization;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    use Authorization;

    protected $userRepository;

    private $module_id = 'UserManagements';

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;

        $this->middleware(function ($request, $next) {
            $this->authorizedAccessPermission($this->module_id);
            return $next($request);
        });
    }

    public function index(Request $request){
        if ($request->ajax()) {
            return $this->userRepository->index($this->module_id);
        }
        return view('backend.users.index');
    }

    public function store(UserRequest $request){
        $request->validated();
        try {
            $response = $this->userRepository->store($request->all());
            return response()->json(['success' => true,'message' => $response,'url'=> ''],200);
            
        }catch (\Throwable $e)  {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }



    



}
