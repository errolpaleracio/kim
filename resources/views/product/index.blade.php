@extends('layouts.app')
@section('content')
<div class="container">
    <a href="products/create" class="btn btn-primary mb-4">Add new Product</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Critical Lvl</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->unit_price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->critical_lvl}}</td>
                    <td>
                        <a href="{{route('products.show', ['product' => $product->id])}}" class="btn btn-primary">Update</a>
                        <a href="{{route('delete-product', ['id' => $product->id])}}" class="btn btn-danger delete-product">Delete</a>
                        <a href="{{route('show-restock', ['id' => $product->id])}}" class="btn btn-success">Restock</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav>
        <ul class="pagination justify-content-end">
            {{$products->links('vendor.pagination.bootstrap-4')}}
        </ul>
    </nav>    
</div>
@endsection

@section('scripts')
<script>
window.onload = function(){
    $(document).on('click', '.delete-product', function(){
        return confirm('Are you sure you want to delete this product?');
    });
}
</script>
@endsection