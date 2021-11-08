<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use App\Models\Module;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        $lesson = new Clas;
        $lesson->name = $request->name;
        $lesson->id_modules = $module->id;
        $lesson->time = '00:00:00';
        $lesson->url = '/class/example';
        $lesson->description = 'description';
        $lesson->save();
        return $lesson;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @param  \App\Models\Clas  $cla
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module, Clas $cla)
    {
        $this->verifyModule($module,$cla);
        return $cla;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @param  \App\Models\Clas  $cla
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module, Clas $cla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @param  \App\Models\Clas  $cla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module, Clas $cla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @param  \App\Models\Clas  $cla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module, Clas $cla)
    {
        $this->verifyModule($module,$cla);
        $cla->delete();
        return $cla;
    }

    protected function verifyModule(Module $module, Clas $cla)
    {
        if ($module->id != $cla->id_modules) {
            throw new HttpException(422,'The specified module is not the actual module of the class');
        }
    }

}
