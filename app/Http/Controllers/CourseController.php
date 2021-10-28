<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\Clas;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show($id){
        $curso = Course::find($id);
        if($curso){
            $modules = Module::where('id_courses','=',$id)->get();
            $clas = [];
            $modulesJson=[];
            foreach($modules as $mod){
                $clas = Clas::where('id_modules',$mod->id)->get();
                $modulesJson[] = [
                    'id_module' =>$mod->id,
                    'module'    => $mod->name,
                    'lessons'    => $clas
                ];
            }
            $courseJson = [
                'id_course' => $curso->id,
                'course'    => $curso->title,
                'modules'   => $modulesJson
            ];
            return $courseJson;   
        }else{
            return "no existen cursos";
        }
    }
}