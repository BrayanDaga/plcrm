<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Clas;
use App\Models\Course;
use App\Models\Module;
use App\Traits\ResponseFormat;

class CourseController extends Controller 
{  
    use ResponseFormat;
    public function show($id){
        
        $curso = Course::select('title')->find($id);
        if($curso){
            $modules = Module::select('id','name')->where('id_courses','=',$id)->get();
            $lesson = [];
            $modulesJson=[];
            foreach($modules as $mod){
                $lesson = Clas::select('name','time','url','description')->where('id_modules',$mod->id)->get();
                $modulesJson[] = [
                    'name'       => $mod->name,
                    'lessons'    => $lesson
                ];
            }
            $courseJson = [
                'title'    => $curso->title,
                'modules'   => $modulesJson
            ];

            return $this->responseOk('',$courseJson );   
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
            return  $this->responseOk('',$data);
        }else{
            return ['error'=>'No existe el productor'];
        }
    }
    public function detailsCourse(Course $course){
        $category = ($course->category)->name;
        $json = [
            'id'          => $course->id,
            'title'       => $course->title,
            'description' => $course->description,
            'id_category' => $course->id_categories, 
            'category'    => $category,
            'price'       => $course->price,
            'level'       => $course->level,
            'created'     => (explode(" ",$course->created_at))[0]
        ];
        return $this->responseOk('',$json);
    }
    public function recomendations($category){
        $courses = Course::inRandomOrder()->where('id_categories',$category)->get()->take(3);
        foreach($courses as $c){
            $json[] = array(
                'id'        => $c->id,
                'title'     => $c->title,
                'image'     => $c->image,
                'producer'  => ($c->user)->name
            );
        }
        return $this->responseOk('',$json);
    }
}