@extends('layouts.contentLayoutMaster')
@section('title', 'BinaryCut')

@section('content')

    @can('is-admin')
        <form action="{{ route('binarycut.store') }}" method="post">
            @csrf
            <input type="submit" value="Cut apply?" class="btn btn-danger">
        </form>

        @if (session('success'))
        <div role="alert" class="alert alert-success">
            <div class="alert-body">
                        <span> <strong>Success!</strong> {{ session('success') }} </span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
        @endif

        <x-table-component tableclass="table-hover table-striped table-bordered" :datatable=true>
            <x-slot name="theadRows">
                <tr>
                    <th>UserMembreship</th>
                    <th>Left Points</th>
                    <th>Rigth Points</th>
                    <th>Amount to Transfer</th>
                </tr>
            </x-slot>
            <x-slot name="tbodyRows">
                @foreach ($users as $user)
                    <tr>
                        <td> {{ $user->fullName }} </td>
                        <td> {{ $user->LeftPoints }} </td>
                        <td> {{ $user->RightPoints }} </td>
                        <td>
                            @if ($user->LeftPoints < $user->RightPoints)
                                {{ ($user->LeftPoints * $user->accountType->pay_in_binary) / 100 }}
                            @else
                                {{ ($user->RightPoints * $user->accountType->pay_in_binary) / 100 }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table-component>
    @endcan

@endsection
