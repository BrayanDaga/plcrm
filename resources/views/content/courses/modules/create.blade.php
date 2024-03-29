@extends('layouts/contentLayoutMaster')
@section('title', 'Courses')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Course <b>{{ $course->title }}</b></h2>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12">
                            <course-form :course="{{$course}}"></course-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
