@extends('layouts.app')
@section('content')
    <a href="products/create" class="btn btn-primary mb-4">Add new Product</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Critical Lvl</th>
                <th>Branch</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product.id}}</td>
                    <td>{{$product.name}}</td>
                    <td>{{$product.unit_price}}</td>
                    <td>{{$product.quantity}}</td>
                    <td>{{$product.critical_lvl}}</td>
                    <td>{{$product.branch_id}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav>
        <ul class="pagination justify-content-end">
            {{$products->links('vendor.pagination.bootstrap-4')}}
        </ul>
    </nav>
@endsection