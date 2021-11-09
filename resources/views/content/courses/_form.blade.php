<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="title"> Course title </label>
            <input  type="text" id="title" class="form-control" name="title"
                placeholder="course title" value="{{ old('title', $course->title) }}"/>                               
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
            <textarea  id="description" class="form-control" name="description" placeholder="enter description">{{ old('description',$course->description) }}</textarea>
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
                placeholder="enter price" value="{{ old('price' ,$course->price) }}" />                               
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
            <br>
           <button type="submit" class="btn btn-primary btn-block">Save</button>                       
        </div>
    </div>
</div>