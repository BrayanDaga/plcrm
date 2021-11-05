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
                <div class="card-body">
                    <course-form course="{{ $course->id }}"></course-form>
                </div>
            </div>
        </div>
    </div>

@endsection
