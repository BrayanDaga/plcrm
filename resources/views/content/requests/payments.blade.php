@extends('layouts.contentLayoutMaster')
@section('title', 'Payment')
@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection
@section('content')

    <div>
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Payments</h4>
                        </div>
                        <div class="card-body">
                            <div class="demo-spacing-0">This table lists all the Promolider Payments</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="row">
                <div class="col-12">
                    <x-table-component tableclass="table-hover-animation table-striped table-bordered" :datatable=true>
                        <x-slot name="theadRows">
                            <tr>
                                <th>Name</th>
                                <th>User</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Operation Number</th>
                                <th>Date of Purchase</th>
                                <th>Actions</th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbodyRows">
                            @foreach ($payments as $payment)
                                <tr>
                                    <td height="30px">{{ $payment->userMembreship->fullName() }}
                                    </td>
                                    <td height="30px">{{ $payment->userMembreship->user }}</td>
                                    <td height="30px">{{ $payment->description }}</td>
                                    <td height="30px">{{ $payment->amount }}</td>
                                    <td height="30px">{{ $payment->paymentMethod->name }}</td>
                                    <td height="30px">{{ $payment->operation_number }}</td>
                                    <td height="30px">{{ $payment->created_at->toFormattedDateString() }}</td>
                                    <td>
                                        <a href="#" title="View Purchase" class="mr-1" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4">
                                                <path d="M19.8005808,10 C17.9798698,6.43832409 14.2746855,4 10,4 C5.72531453,4 2.02013017,6.43832409 0.199419187,10 C2.02013017,13.5616759 5.72531453,16 10,16 C14.2746855,16 17.9798698,13.5616759 19.8005808,10 Z M10,14 C12.209139,14 14,12.209139 14,10 C14,7.790861 12.209139,6 10,6 C7.790861,6 6,7.790861 6,10 C6,12.209139 7.790861,14 10,14 Z M10,12 C11.1045695,12 12,11.1045695 12,10 C12,8.8954305 11.1045695,8 10,8 C8.8954305,8 8,8.8954305 8,10 C8,11.1045695 8.8954305,12 10,12 Z" id="Combined-Shape"></path>
                                         </svg>
                                        </a>
                                        <a href="#" title="Authorize" class="mr-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4">
                                                <polygon id="Path-126" points="0 11 2 9 7 14 18 3 20 5 7 18"></polygon>
                                         </svg>
                                        </a> 
                                         <a href="#" title="Disavow" class="mr-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4">
                                                <path d="M0 10a10 10 0 1 1 20 0 10 10 0 0 1-20 0zm16.32-4.9L5.09 16.31A8 8 0 0 0 16.32 5.09zm-1.41-1.42A8 8 0 0 0 3.68 14.91L14.91 3.68z"></path>
                                            </svg>
                                        </a>
                                       
                                        
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-table-component>
                </div>
            </div>
            <div
            class="modal fade"
            id="exampleModalCenter"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Vertically Centered</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>
                    Croissant jelly-o halvah chocolate sesame snaps. Brownie caramels candy canes chocolate cake
                    marshmallow icing lollipop I love. Gummies macaroon donut caramels biscuit topping danish.
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>

@endsection
