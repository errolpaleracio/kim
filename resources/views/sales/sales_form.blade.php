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
                    <td><span id="subtotal">0</span></td>
                </tr>
            </table>
            <form id="add_sales">
                    <form method="POST" action="{{ route('products.store') }}" id="sales_form" class="pl1">
                            @csrf
                        <input type="hidden" name="branch_id" value="{{Auth::user()->branch_id}}" id="branch_id">
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
                $('#subtotal').text(get_subtotal());
            })

            function get_subtotal(){
                var subtotal = 0;
                for(i = 0; i < products.length; i++){
                    subtotal += parseFloat(products[i].unit_price * products[i].quantity);
                }
                return subtotal;
            }

            var input = '';
            $('#discount').on('keydown', function(e){
                var subtotal = get_subtotal();
                
                var ch = String.fromCharCode(e.which);
                if(ch == 46)
                    return true;
                if (ch > 31 && (ch < 48 || ch > 57))
                    return false;
                if(parseFloat(input + ch) >= subtotal)
                    return false;
                if(subtotal == 0)
                    return false;
                if(e.which == 8 && input.length > 0)
                    input = input.substring(0, input.length-1);
                if(e.which >= 48 && e.which <= 57)
                    input += ch;
                
                var discount = 0;
                
                console.log(input);
                if(input.length > 0 && parseFloat(input) < subtotal)
                    $('#discount').text(subtotal - parseFloat(input))
                if(input.length == 0)
                $('#discount').text(subtotal)
                
            });

            function add_row(product){
                var row = '<td>' + product.id + '</td>';
                row += '<td>' + product.name + '</td>';
                row += '<td>' + product.quantity + '</td>';
                row += '<td>' + product.unit_price + '</td>';
                row += '<td>' + (parseFloat(product.unit_price) * parseInt(product.quantity)).toFixed(2) + '</td>';
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
                console.log(products)
                $.ajax({
                    url: "{{route('add-sale')}}",
                    type: 'POST',
                    data: {
                        'discount' : $discount.val(),
                        'branch_id' : $('#branch_id').val()
                    },
                    success: function (result,status,xhr) {
                        var sales_id = result.data.id;
                        for(i = 0; i < products.length; i++){
                            $.ajax({
                                url: "{{route('create_sale_item')}}",
                                type: 'POST',
                                data: {
                                    'unit_price' : products[i].unit_price,
                                    'quantity' : products[i].quantity,
                                    'product_id' : products[i].id,
                                    'sales_id' : sales_id
                                },
                                success: function(result,status,xhr){
                                    window.location.href = "{{route('sales.index')}}"
                                }
                            });                            
                        }
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

            document.getElementById('quantity').onkeypress = isNumberKey;
            
        }


    </script>
@endsection