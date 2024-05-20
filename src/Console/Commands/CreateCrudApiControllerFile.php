<?php

namespace Ardi7923\Laravelcmsapi\Console\Commands;

use Illuminate\Support\Str;
use Ardi7923\Laravelcmsapi\Utilities\CommandUtility;
use File;

class CreateCrudApiControllerFile
{
    use CommandUtility;

    private $name,
        $resource,
        $model,
        $request;

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }


    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function create(){

        $baseFolderApp = substr(dirname(__FILE__),0,-47)."/app";
        $baseFolderPackage = substr(dirname(__FILE__),0,-17);
        $pathExController = "/Assets/Controller/CrudApiController.php";

        if (Str::contains($this->name, '/')) {

            $controllerName = Str::afterLast($this->name, '/');
            $subFolder      = Str::beforeLast($this->name, '/');
            $file           = $baseFolderApp . "/Http/Controllers/$subFolder/".$controllerName.".php";
            $controllernamespace  = "\\".Str::replace("/","\\",$subFolder);

        }else{

            $controllerName = $this->name;
            $file           = $baseFolderApp . "/Http/Controllers/".$controllerName.".php";
            $controllerDir  = $baseFolderApp . "/Http/Controllers";
            $controllernamespace = "";
        }

        if (Str::contains($this->model, '/')) {
            $modelName      = Str::afterLast($this->model, '/');
            $modelFolder    = Str::beforeLast($this->model, '/');
            $modelPath      = "\\".Str::replace("/","\\",$this->model);
        }else{
            $modelName      = $this->model;
            $modelFolder    = "";
            $modelPath      = "\\".$this->model;
        }

        if($this->request){
            $requestName = Str::afterLast($this->request, '/');
            if (Str::contains($this->request, '/')) {
                $requestpath = "use App\Http\Requests"."\\".Str::replace("/","\\",$this->request).";";
                $requestName = $requestName;
            }else{

                $requestpath = "use App\Http\Requests"."\\".$requestName.";";
                $requestName = $requestName;
            }
        }else{
            $requestpath = "";
            $requestName = "Request";
        }


        if($this->resource){
            $resourceName = Str::afterLast($this->resource, '/');
            if (Str::contains($this->resource, '/')) {
                $requestpath = "use App\Http\Requests"."\\".Str::replace("/","\\",$this->request).";";
                $requestName = $requestName;
            }else{

                $resourcePath = "use App\Http\Resources"."\\".$resourceName.";";
                $resourceClass = 'protected $resource = '.$resourceName .'::class;';
                $getdataMethod = '$this->setResource($this->resource)->getDatas()';
            }
        }else{
            $resourcePath = "";
            $resourceClass = "";
            $getdataMethod = '$this->getDatas()';
        }


        File::copy($baseFolderPackage.$pathExController,$file);

        $str = file_get_contents($file);
        $str = str_replace("controllerName", $controllerName,$str);
        $str = str_replace("\controllernamespace", $controllernamespace,$str);

        $str = str_replace("\modelPath", $modelPath,$str);
        $str = str_replace("modelName", $modelName,$str);

        $str = str_replace("requestName", $requestName,$str);
        $str = str_replace("requestpath;", $requestpath,$str);

        $str = str_replace("resourcePath;", $resourcePath,$str);
        $str = str_replace("resourceClass;", $resourceClass,$str);
        $str = str_replace("getdataMethod", $getdataMethod,$str);



        file_put_contents($file, $str);

    }

}
