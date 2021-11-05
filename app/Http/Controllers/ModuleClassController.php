<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function index(Module $module)
    {
        $lessons = $module->lessons;
        return $lessons;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function create(Module $module)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Module $module)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @param  \App\Models\Clas  $clas
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module, Clas $clas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @param  \App\Models\Clas  $clas
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module, Clas $clas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @param  \App\Models\Clas  $clas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module, Clas $clas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @param  \App\Models\Clas  $clas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module, Clas $clas)
    {
        //
    }
}
