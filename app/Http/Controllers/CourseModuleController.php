<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CourseModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $modules = $course->modules;
        return $modules;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('content.courses.modules.create',compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        $module = $course->modules()->create(['name'=>$request->name]);
        return $module;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Module $module)
    {
        $this->verifyCourse($course,$module);
        return $module;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, Module $module)
    {
        $this->verifyCourse($course,$module);
        $module->name = $request->name;
        $module->update();
        return $module;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Module $module)
    {
        $this->verifyCourse($course,$module);
        $module->delete();
        return $module;
    }

    protected function verifyCourse(Course $course, Module $module)
    {
        if ($course->id != $module->id_courses) {
          throw new HttpException(422,'The specified course is not the actual course of the modules');
        }
    }
}
