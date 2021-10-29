<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Module;
use App\Models\Clas;
use Illuminate\Http\Request;
class CourseController extends Controller 
{  
    public function show($id){
        
        $curso = Course::select('title')->find($id);
        if($curso){
            $modules = Module::select('id','name')->where('id_courses','=',$id)->get();
            $leason = [];
            $modulesJson=[];
            foreach($modules as $mod){
                $leason = Clas::select('name','time','url','description')->where('id_modules',$mod->id)->get();
                $modulesJson[] = [
                    'name'       => $mod->name,
                    'lessons'    => $leason
                ];
            }
            $courseJson = [
                'title'    => $curso->title,
                'modules'   => $modulesJson
            ];
            return $courseJson;   
        }else{
            return ['error'=>'El curso no existe'];
        }
    }
}