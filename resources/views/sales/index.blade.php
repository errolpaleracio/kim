@extends('layouts.app')
@section('content')
<div class="container">
    <a href="sales/create" class="btn btn-primary mb-4">Add new Sales</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Subtotal</th>
                <th>Discount</th>
                <th>Total Amount</th>
                <th>Branch</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td>{{$sale->id}}</td>
                    <td>{{date_format(date_create($sale->sales_date), 'F d, Y')}}</td>                    
                    <td>{{$sale->get_total()}}</td>
                    <td>{{$sale->get_discount()}}</td>
                    <td>{{$sale->get_total()}}</td>
                    <td>{{$sale->branch->name}}</td>
                    <td><button class="btn btn-primary" data-toggle="modal" data-target="#ViewSalesDetailModal" data-id="{{$sale->id}}">View Details</button></td>
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

<div class="modal fade" id="ViewSalesDetailModal" tabindex="-1" role="dialog" aria-labelledby="ViewSalesDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ViewSalesDetailModalLabel">View Sales Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table" id="sales_items">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                            <th>Discount</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.onload = function(){
    var $tbody = $('#sales_items tbody');
    $('#ViewSalesDetailModal').on('show.bs.modal', function (e) {
        $tbody.empty();
        var button = $(e.relatedTarget);
        var id = button.data('id');
        
        $.ajax({
            url: '{{route("sale_items")}}',
            data :{"id" : id},
            success: function(result,status,xhr){
                $.each(result, function(i, item){
                   var $tr = $('<tr>').append(
                        $('<td>').text(item.product.name),
                        $('<td>').text(item.quantity),
                        $('<td>').text(item.unit_price),
                        $('<td>').text(parseFloat(item.quantity * item.unit_price - item.discount).toFixed(2)),
                        $('<td>').text(item.discount)
                   ).appendTo($tbody);
                });
            }
        });
    })
}
</script>
@endsection