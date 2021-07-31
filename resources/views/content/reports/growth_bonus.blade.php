@extends('layouts.contentLayoutMaster')
@section('title', "Growth Bonus List")

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Growth Bonus List</h4>
        </div>
        <div class="card-body">
            <x-table-component tableclass="table-hover table-striped table-bordered" :datatable=true >
                <x-slot name="theadRows">
                    <tr>
                        <th>UserMembreship</th>
                        <th>Growth bonus</th>
                        <th>Date</th>
                    </tr>
                </x-slot>
                <x-slot name="tbodyRows">
                    @foreach ($qualifieds as $qualified )
                    <tr>
                        <td>{{ $qualified->userMembreship->fullName() }}</td>
                        <td> <span class="text-primary font-weight-bold">$ {{ $qualified->growth_bonus }}</span></td>
                        <td>{{ $qualified->created_at }}</td>
                    </tr>
                    @endforeach
                </x-slot>
            </x-table-component>
        </div>
        
    </div>
  </div>
@endsection
