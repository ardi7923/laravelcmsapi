<?php

namespace Ardi7923\Laravelcmsapi;

use ResponseService;

class CrudApi Extends Crud
{
    private $facade = null,
        $resource = null,
        $params = [];

    public function __construct()
    {
        parent::__construct();
        $this->response  = new ResponseService;
    }

    public function setFacade($facade)
    {
        $this->facade = $facade;
        return $this;
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }


    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    // GET Data ==========================
    public function getDatas($data = [])
    {

        $limit = $this->request->limit ?? 10;
        $keyword = $this->request->keyword;
        $all = $this->request->all;

        $datas = $this->model::query();

        if ($keyword) {
            if(count($this->filters)){
                foreach ($this->filters as $key => $value) {
                    if($key == 0){
                        $datas = $datas->where($value,'like','%'.$keyword.'%');
                    }else{
                        $datas = $datas->orWhere($value,'like','%'.$keyword.'%');
                    }
                }
            }


            if ($all === true || $all == "true") {
                $datas = $datas->get();
            } else {
                if($this->resource) {
                    $datas = $datas->paginate($limit);
                }else{
                    $datas = wrap_pagination($datas->paginate($limit));
                }
            }

            $response = new ResponseService();
            return $response->setCode(200)
                ->setMsg("OK")
                ->setData($datas)
                ->get();
        }

        if(count($this->filters)){
            foreach ($this->filters as $key => $value) {
                if($this->request->$value){
                    $datas = $datas->where($value,$this->request->$value);
                }
            }
        }

        if ($all === true || $all == "true") {
            $datas = $datas->get();
        } else {
            if($this->resource) {
                $datas = $datas->paginate($limit);
            }else{
                $datas = wrap_pagination($datas->paginate($limit));
            }
        }

        if($this->resource){
            return $this->response->setCode(200)
                ->setMsg("OK")
                ->setData(($all == true) ? $this->resource::collection($datas)->response()->getData() : remove_links_paginate($this->resource::collection($datas)->response()->getData()))
                ->get();
        }else{
            return $this->response->setCode(200)
                ->setMsg("OK")
                ->setData($datas)
                ->get();
        }

    }

    // GET Data Detail ==========================
    public function getDetail()
    {
        $data = $this->model->where($this->InitializeParams($this->params))->firstOrFail();


        return $this->response->setCode(200)
            ->setMsg("OK")
            ->setData($data)
            ->get();
    }

    // save method =========================================
    public function save($data = [])
    {

        try {

            if ($this->facade == null) {
                if ($data) {
                    $this->model->create($data);
                } else {
                    $this->model->create($this->request->except('_token'));
                }
            } else {
                $this->facade->save($this->request);
            }

            return $this->response->setCode(200)
                ->setMsg("Data Berhasil Disimpan")
                ->setData($this->request->all())
                ->get();

        } catch (\Exception $e) {

            $errors = [$e->getMessage()];

            return $this->response->setErrors($errors)->get();
        }
    }

    // update ========================================
    public function change($data = [])
    {
        try {

            if ($this->facade == null) {

                if ($data) {
                    $this->model->where($this->InitializeParams($this->params))->update($data);
                } else {
                    $this->model->where($this->InitializeParams($this->params))->update($this->request->except('_token', '_method'));
                }
            } else {
                $this->facade->update($this->request, $this->params);
            }

            return $this->response->setCode(200)
                ->setMsg("Data Berhasil Diubah")
                ->setData($this->request->all())
                ->get();
        } catch (\Exception $e) {

            $errors = [$e->getMessage()];
            return $this->response->setErrors($errors)->get();
        }
    }
    // Delete =======================================
    public function delete()
    {
        try {

            if ($this->facade == null) {
                $data = $this->model->where($this->InitializeParams($this->params))->firstOrFail();

                if($this->files){
                    if(is_array($this->files)){
                        foreach ($this->files as $file){
                            $field_file = $this->files;
                            $file_name = $data->$field_file;
                            $this->deleteFile($file_name);
                        }
                    }else{
                        $field_file = $this->files;
                        $file = $data->$field_file;

                        $this->deleteFile($file);

                    }
                }
                $data->delete();
            } else {
                $this->facade->delete($this->InitializeParams($this->params));
            }

            return $this->response->setCode(200)
                ->setMsg("Data Berhasil Dihapus")
                ->get();
        } catch (\Exception $e) {

            $errors = [$e->getMessage()];
            return $this->response->setErrors($errors)->get();
        }
    }
}
