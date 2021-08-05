@extends('layouts.contentLayoutMaster')
@section('title', "$ Users' Wallet Funds")

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">$ Users' Wallet Funds</h4>
        </div>
        <div class="card-body">
            <x-table-component tableclass="table-hover table-striped table-bordered" :datatable=true >
                <x-slot name="theadRows">
                    <tr>
                        <th>UserMembreship</th>
                        <th>Amount available</th>
                    </tr>
                </x-slot>
                <x-slot name="tbodyRows">
                    @foreach ($wallets as $wallet )
                    <tr>
                        <td>{{ $wallet->userMembreship->fullName }}</td>
                        <td> <span class="text-primary font-weight-bold">$ {{ $wallet->amount }}</span></td>
                    </tr>
                    @endforeach
                </x-slot>
            </x-table-component>
        </div>
        <div class="card-footer">
            <h4 class="d-inline">Total: </h4>
            <h3 class="mb-75 mt-2 pt-50 d-inline"><a href="javascript:void(0);">$ {{ $wallets->sum('amount') }}  </a></h3>
          </div>
      </div>
    </div>
  </div>
@endsection

  


