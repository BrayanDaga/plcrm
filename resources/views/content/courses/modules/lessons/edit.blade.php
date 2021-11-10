@extends('layouts/contentLayoutMaster')

@section('title', 'Edit Class')
@section('content')
      <section id="default-breadcrumb">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              {{-- <div class="card-header">
                <h4 class="card-title">Default</h4>
              </div> --}}
              <div class="card-body">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('courses.modules.create',$module->course) }}">
                    Course: {{ $module->course->title }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('courses.modules.create',$module->course) }}">Module: {{ $module->name }} </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Class: {{ $cla->name }}</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="row match-height">
        <div class="col-lg-12">
          <div class="card">
            {{-- <div class="card-header">
              <h4 class="card-title">Basic Tab</h4>
            </div> --}}
            <div class="card-body">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    id="home-tab"
                    data-toggle="tab"
                    href="#home"
                    aria-controls="home"
                    role="tab"
                    aria-selected="true"
                    >Upload Video</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    id="profile-tab"
                    data-toggle="tab"
                    href="#profile"
                    aria-controls="profile"
                    role="tab"
                    aria-selected="false"
                    >Add form Libraly</a
                  >
                </li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile02">
                          <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                        </div>
                      </div>
                </div>
                <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                  <p>
                    Dragée jujubes caramels tootsie roll gummies gummies icing bonbon. Candy jujubes cake cotton candy.
                    Jelly-o lollipop oat cake marshmallow fruitcake candy canes toffee. Jelly oat cake pudding jelly beans
                    brownie lemon drops ice cream halvah muffin. Brownie candy tiramisu macaroon tootsie roll danish.
                  </p>
                  <p>
                    Croissant pie cheesecake sweet roll. Gummi bears cotton candy tart jelly-o caramels apple pie jelly
                    danish marshmallow. Icing caramels lollipop topping. Bear claw powder sesame snaps.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      
@endsection
