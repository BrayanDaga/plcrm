<?php

namespace App\Http\Controllers;
use App\Models\Clas;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Traits\ResponseFormat;

class CourseController extends Controller 
{  
    use ResponseFormat;
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
            return $this->responseOk('',$courseJson); 
        }else{
            return ['error'=>'El curso no existe'];
        }
    }
}