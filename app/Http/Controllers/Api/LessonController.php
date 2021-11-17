<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
     /**
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $user = User::find(Auth::user()->id);
        $lessons = $user->lessons;
        $lesson = $lessons->last();
        $module = $lesson->module;
        $module->course;
        return $lesson;
    }
}
