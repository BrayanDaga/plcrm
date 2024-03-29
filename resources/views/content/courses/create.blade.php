@extends('layouts/contentLayoutMaster')
@section('title', 'Courses')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2>Informacion General</h2>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div role="alert" class="alert alert-success">
                    <div class="alert-body">
                        <span><strong>Success </strong> {{ session('success') }}!</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif        
                @if (isset($errors) && $errors->any())
                <div role="alert" class="alert alert-danger">
                    <div class="alert-body">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
                <form action="{{ route('courses.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('content.courses._form',['btnText' => 'Create'])
                </form>
            </div>
        </div>

    </div>
@endsection
