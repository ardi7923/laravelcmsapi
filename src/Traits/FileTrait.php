<?php

namespace Ardi7923\Laravelcmsapi\Traits;

use Storage;
use File;

trait FileTrait
{
    public function saveFile($filename, $path, $file)
    {
        try {
            if($file){
                $filename = $filename.'.'.$file->getClientOriginalExtension();
                Storage::putFileAs('/public/'.$path,$file,$filename);
                return "/storage/".$path."/".$filename;
            }else{
                return null;
            }

        }catch (\Exception $exception){
            throw $exception;
        }
    }


    public function updateFile($filename, $path, $file,$data)
    {
        try {
            if($file){
                if($data){
                    File::delete(substr($data,1));
                    $filename = $filename.'.'.$file->getClientOriginalExtension();
                    Storage::putFileAs('/public/'.$path,$file,$filename);
                    return "/storage/".$path."/".$filename;
                }else{
                    $filename = $filename.'.'.$file->getClientOriginalExtension();
                    Storage::putFileAs('/public/'.$path,$file,$filename);
                    return "/storage/".$path."/".$filename;
                }

            }else{
                return $data;
            }

        }catch (\Exception $exception){
            throw $exception;
        }
    }


    public function deleteFile($data)
    {
        File::delete(substr($data,1));
    }
}
