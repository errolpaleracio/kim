@extends('layouts.app')
@section('content')
<div class="container">
    <a href="sales/create" class="btn btn-primary mb-4">Add new Sales</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Discount</th>
                <th>Branch</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td>{{$sale->id}}</td>
                    <td>{{$sale->date}}</td>
                    <td>{{$sale->discount}}</td>
                    <td>{{$sale->branch->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav>
        <ul class="pagination justify-content-end">
            {{$sales->links('vendor.pagination.bootstrap-4')}}
        </ul>
    </nav>
</div>
@endsection