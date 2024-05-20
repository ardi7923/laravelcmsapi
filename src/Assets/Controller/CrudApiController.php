<?php

namespace App\Http\Controllers\controllernamespace;

use App\Models\modelPath;
use CrudApi;
use Illuminate\Http\Request;
requestpath;
resourcePath;

class controllerName extends CrudApi
{
    protected $model = modelName::class;
    protected $files = false;
    protected $filters = [];
    resourceClass;


    public function __construct()
    {
        parent::__construct($this);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return getdataMethod;
    }

    /**
     * Show the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return $this->setParams($id)->getDetail();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(requestName $request)
    {
        return $this->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(requestName $request,$id)
    {
        return $this->setParams($id)->change();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->setParams($id)->delete();
    }
}
