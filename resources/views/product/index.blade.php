@extends('layouts.app')
@section('content')
<div class="container">
    @if(Auth::user()->branch_id != null)<a href="products/create" class="btn btn-primary mb-4">Add new Product</a>@endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Critical Lvl</th>
                @if(Auth::user()->branch_id != null)
                <th>Actions</th>
                @endif
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
                    @if(Auth::user()->branch_id != null)
                    <td>
                        <a href="{{route('products.show', ['product' => $product->id])}}" class="btn btn-primary">Update</a>
                        <a href="{{route('show-restock', ['id' => $product->id])}}" class="btn btn-success">Restock</a>
                    </td>
                    @endif
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