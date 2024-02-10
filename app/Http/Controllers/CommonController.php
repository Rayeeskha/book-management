<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models;
use CustomHelper;
use Auth;

class CommonController extends Controller
{
	public function deleteDataTableRow(){
        if(request()->ajax()){
            $chek_foreign = '';
            $data = '';
            $ex = explode('-',request()->data);
            if(count($ex) !=2){
                return response()->json(['status' => 'error', 'error' => 'Record not found']);
            }
            $table = isset($ex[1]) ? $ex[1]:'';
            $id = isset($ex[0]) ? $ex[0]:'';
            switch ($table) {
                case "books":
                $data = \App\Models\Book::find($id);
                break;
                case "roles":
                    $data = \App\Models\Role::find($id);
                    break;
                case "users":
                    $data = \App\Models\User::find($id);
                    break;
                    
            }
            if(!is_null($data)){
                if ($chek_foreign > 0) {
                    return response()->json(['status' => 'error', 'error' =>'delete first child']);
                }
                if($data->delete()){
                    return response()->json(['status' => 'success','message' => 'Record deleted successfully']);
                }else{
                    return response()->json(['status' => 'error', 'error' => 'Record not found']); 
                }
            }else{
                return response()->json(['status' => 'error', 'error' => 'Record not found']); 
            }
        }
    }

    public function changeDataTableStatus(Request $request){
        if(request()->ajax()){
            $data = '';
            $ex = explode('-',request()->data);
            if(count($ex) !=2){
                return response()->json(['success' =>false, 'error' => 'Record not found!'],201);
            }
            $table = isset($ex[1]) ? $ex[1]:'';
            $id = isset($ex[0]) ? $ex[0]:'';
            switch ($table) {
                case "books":
                $data = \App\Models\Book::find($id);
                    break;  
                case "roles":
                    $data = \App\Models\Role::find($id);
                    break;
                case "users":
                    $data = \App\Models\User::find($id);
                    break;    
            }
            if(!is_null($data)){
                $data->status = $data->status == 1 ? 0 : 1;
                $data->save();
                return response()->json(['success' =>true, 'message' => 'Updated Successfully!','status'=>$data->status],200);
            }else{
                return response()->json(['success' =>'error', 'error' => 'opps! Something went wrong !'],201); 
            }
        }
    }


}