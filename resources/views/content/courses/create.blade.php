@extends('layouts/contentLayoutMaster')
@section('title', 'Courses')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2>Informacion General</h2>
            </div>
            <div class="card-body">
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
                <form action="{{ route('course.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="title"> Course title </label>
                                <input  type="text" id="title" class="form-control" name="title"
                                    placeholder="course title"/>                               
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="id_categories">Category</label>
                                {{-- Input select option bootstrap --}}
                                <select name="id_categories" id="id_categories" class="form-control">
                                    @foreach ($categories as $category )
                                    <option value="{{$category->id}}">{{ $category->name }}</option>
                                    @endforeach
                                </select>             
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="description"> Description</label>
                                <textarea  id="description" class="form-control" name="description" placeholder="enter description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="level">Level</label>
                                {{-- Input select option bootstrap --}}
                                <select name="level" id="level" class="custom-select">
                                    <option value="basic">Basic</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>             
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="price"> Price </label>
                                <input  type="text" id="price" class="form-control" name="price"
                                    placeholder="enter price"/>                               
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="image"> Image </label>
                                <input  type="file" id="image" class="form-control" name="image"
                                    placeholder="enter image"/>                               
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="image">Status </label>
                                <select name="status" id="status" class="custom-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>                               
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <br>
                               <button type="submit" class="btn btn-primary btn-block">Save</button>                       
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
