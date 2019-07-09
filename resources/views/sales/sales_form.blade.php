@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{ route('products.store') }}" id="sales_form">
                @csrf
                
                <div class="form-group row">
                    <label for="name" class="col-md-1 col-form-label text-md-right">Quantity</label>
                    <div class="col-md-6">
                        <input type="text" name="quantity" id="quantity" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-1 col-form-label text-md-right">Product</label>
                    <div class="col-md-6">
                        <select name="product_id" class="form-control" id="product_id">
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="unit_price" class="col-md-1 col-form-label text-md-right">Price</label>
                    <div class="col-md-6">
                        <input type="text" name="unit_price" id="unit_price" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-md-1 col-md-1">
                        <button class="btn btn-primary" id="add_product">Add</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-4">
            <table class="table table-stripped">
                <tr>
                    <td>No of items in card</td>
                    <td><span id="product_count">0</span></td>
                </tr>
                <tr>
                    <td>Subtotal</td>
                    <td>0</td>
                </tr>
            </table>
            <form id="add_sales">
                    <form method="POST" action="{{ route('products.store') }}" id="sales_form" class="pl1">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label">Discount</label>
                                <div class="col-md-9">
                                    <input type="text" name="discount" id="discount" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1">
                                    <button class="btn btn-primary" id="payment">Payment</button>
                                </div>
                            </div>
                        </form>               
            </form>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered" id="product_list">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td>Total</td>
                    </tr>                    
                </thead>
                <tbody>                    
                </tbody>
            </table>            
        </div>    
    </div>  
</div>  
@endsection
@section('scripts')
    <script>
        var products = [];
        window.onload = function(){
            var $product_list = $('#product_list tbody');
            var $selected_product = $('select[name="product_id"]');
            var $quantity = $('#quantity');
            var $unit_price = $('#unit_price');

            $('#sales_form').submit(function(e){
                e.preventDefault();
            })

            $('#add_product').on('click', function(){
                var product_id = $selected_product.find('option:selected').val();
                var product_name = $selected_product.find('option:selected').text();
                var quantity = $quantity.val();
                var unit_price = $unit_price.val();

                var product = {
                    id : product_id,
                    name : product_name,
                    quantity : quantity,
                    unit_price : unit_price
                };
                products.push(product);
                add_row(product);
                reset_form();

                $('#product_count').text(products.length);
            })

            function add_row(product){
                var row = '<td>' + product.id + '</td>';
                row += '<td>' + product.name + '</td>';
                row += '<td>' + product.quantity + '</td>';
                row += '<td>' + product.unit_price + '</td>';
                row += '<td>' + parseFloat(product.unit_price) * parseInt(product.quantity) + '</td>';
                $product_list.append('<tr>' + row + '</tr>');
            }

            fetch($selected_product.val());

            function fetch(id){
                $.ajax({
                    url: "{{route('get_product')}}",
                    type: 'GET',
                    data: {'id' : id},
                    success: function (result,status,xhr) {
                        $('#unit_price').val(result.data[0].unit_price);
                    }
                });
            }

            $('#product_id').on('change', function(){
                fetch($(this).val());
            });

            function reset_form(){
                $quantity.val('');
            }

            $('#add_sales').on('submit', function(e){
                e.preventDefault();
            });
            var $discount = $('#discount');

            $('#payment').on('click', function(){
                alert('test');
                $.ajax({
                    url: "{{route('add-sale')}}",
                    type: 'POST',
                    data: {
                        'discount' : $discount.val()
                    },
                    success: function (result,status,xhr) {
                        console.log(result);
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        console.log(xhr + " : " + ajaxOptions + " : " + thrownError)
                    }
                });
            });

            function isNumberKey(evt)
            {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if(charCode == 46)
                    return true;
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

                return true;  
            }

            document.getElementById('discount').onkeypress = isNumberKey;
        }


    </script>
@endsection