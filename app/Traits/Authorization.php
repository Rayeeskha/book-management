<?php 

namespace App\Traits;
use Auth;
use CustomHelper;
use DB;

trait Authorization{

	public function authorizedAccessPermission($permission){
    $role_id = Auth::user()->role_id;
    $allPermission = false;
    if(!empty($role_id) && $role_id == '1'){
      $allPermission = true;
    }
    $group = CustomHelper::getUserRolePermission();

    if($allPermission || ((array_search($permission, array_column($group, 'module_id'))) !== false )){
      return true;
    }
    return abort(403);
  }


}