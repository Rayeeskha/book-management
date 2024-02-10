<?php 
namespace App\Helpers;
use App\Models\Role;
use App\Models\Module;
use DB;
use Auth;

class CustomHelper{

    static function getUserRolePermission(){
        $previllage = '';
        $roleMaster =  Role::whereid(Auth::user()->role_id)->first();
        if (!is_null($roleMaster)) {
            $previllage = json_decode($roleMaster->permissions, true);
        }
        return $previllage;
    }

    static function checkPermission($module_id, $action){
        $role_id = Auth::user()->role_id;
        if(!empty($role_id) && $role_id  == '1'){
            return true;
        }
        $permissionRole = false;
        $previllage = CustomHelper::getUserRolePermission();
        
        if (!empty($previllage) && ($key1 = array_search($module_id, array_column($previllage, 'module_id') ) ) !== false ) {
            $rolePermissions = isset($previllage[$key1]) ? $previllage[$key1] : '';
            if(!empty($rolePermissions) && count($rolePermissions) > 0){
                if(isset($rolePermissions[$action]) && $rolePermissions[$action] == 1){
                    $permissionRole = true;
                }
            }
        }
        return $permissionRole;
    }

    static function getModules(){
        return Module::wherestatus(1)->get();
    }

    static function generatePurchaseId() {
        $year = date('Y');
        $month = date('m');
        $counterFilePath = 'counter.txt';
        if (!file_exists($counterFilePath)) {
            file_put_contents($counterFilePath, '1');
        }
        $counter = (int) file_get_contents($counterFilePath);
        $numericID = str_pad($counter, 4, '0', STR_PAD_LEFT); 
        $counter++;
        file_put_contents($counterFilePath, $counter);
        return sprintf('%s-%s-%s', $year, $month, $numericID);
    }
    


}