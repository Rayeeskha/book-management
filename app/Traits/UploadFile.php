<?php 

namespace App\Traits;
use DB;
use File;
use Auth;
use CustomHelper;

trait UploadFile{
	
	public function uploadImage($fileName, $fileDirectory, $tablename= '', $args = '', $imageColumnName=''){
	   	if (empty($fileName) && empty($fileDirectory)) {
    		return false;
    	}

    	if (!empty($args)) {
    		$table = DB::table($tablename)->where($args)->first();
    		if(!empty($table->$imageColumnName)){
                if (session()->get('PROPERTY_ID_SESSION') !=  $args) {
                    if (file_exists($table->$imageColumnName)){
                        @unlink($table->$imageColumnName);
                        if ($tablename ==  'property_images') {
                            DB::table($tablename)->where($args)->delete();

                            session()->put('PROPERTY_ID_SESSION', $args);
                        }
                    }
                }
            }
    	}
    	$file_name = 'image_'.time().'_'.rand(1,100).'.'.$fileName->getClientOriginalExtension();

        $destinationPath = public_path($fileDirectory);
        if (! File::exists($destinationPath)){
            File::makeDirectory( $destinationPath );
        }
        $image_name = "$fileDirectory/".$file_name;
        $fileName->move( $destinationPath, $file_name );
       	
       	session()->put('PROFILE_IMAGE', $image_name);
        return $image_name;
	}	
}