<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use App\Models\Module;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $this->verifyModule($module,$cla);
        return view('content.courses.modules.lessons.edit',compact('module','cla'));
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

    public function addVideo(Request $request, Module $module, Clas $cla)
    {
        $this->verifyModule($module,$cla);
         $request->validate([
             'path' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
         ]);
        $path = $request->file('path')->store('courses/modules/class');
        // $image = $request->file('image')->store('courses');

        $video = Video::make(
            ['path' => $path]
        );

        $cla->video()->save($video);
        return redirect()->back()->withSuccess('The video has been uploaded successfully.');
    }

    public function delVideo(Module $module, Clas $cla)
    {
        $this->verifyModule($module,$cla);
        Storage::delete($cla->video->path);
        $cla->video()->delete();
        return redirect()->back()->withSuccess('The video has been deleted.');
    }

    protected function verifyModule(Module $module, Clas $cla)
    {
        if ($module->id != $cla->id_modules) {
            throw new HttpException(422,'The specified module is not the actual module of the class');
        }
    }
}
