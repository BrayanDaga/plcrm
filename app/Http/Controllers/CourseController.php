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
    public function list($id){
        $data = Course::select('courses.title','categories.name','courses.price','courses.status')
                      ->join('categories','categories.id','=','courses.id_categories')
                      ->where('courses.user_id','=',$id)
                      ->get();
        if(count($data)<>0){
            return $data;
        }else{
            return ['error'=>'No existe el productor'];
        }
    }
}