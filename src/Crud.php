<?php

namespace Ardi7923\Laravelcmsapi;

use App\Http\Controllers\Controller;
use Ardi7923\Laravelcmsapi\Utilities\RequestUtility;
use Ardi7923\Laravelcmsapi\Traits\FileTrait;

class Crud extends Controller
{
    use RequestUtility;
    use FileTrait;

    protected $model;
    protected $resource;
    protected $validator;
    

    public function __construct()
    {
        $this->model = new $this->model;
        $this->resource = new $this->resource;
        $this->request = app('request');
        if($this->validator){
            $this->validator = new $this->validator;
        }

        
    }
}
