@extends('layouts/contentLayoutMaster')
@section('title', 'Courses')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2>Informacion General</h2>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name"> Course name </label>
                                <input  type="text" id="name" class="form-control" name="name"
                                    placeholder="course name"/>                               
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="id_categories">Category</label>
                                {{-- Input select option bootstrap --}}
                                <select name="id_categories" id="id_categories" class="custom-select">
                                    <option value="1">Categoria 1</option>
                                    <option value="1">Categoria 2</option>
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
                                    <option value="1">Basic</option>
                                    <option value="1">Intermediate</option>
                                    <option value="1">Advanced</option>
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
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
