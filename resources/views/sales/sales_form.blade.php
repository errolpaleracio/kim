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
            })

            function add_row(product){
                var row = '<td>' + product.id + '</td>';
                row += '<td>' + product.name + '</td>';
                row += '<td>' + product.quantity + '</td>';
                row += '<td>' + product.unit_price + '</td>';
                row += '<td>' + parseFloat(product.unit_price) * parseInt(product.quantity) + '</td>';
                $product_list.append('<tr>' + row + '</tr>');
            }

            $.ajax({
                url: '{{route('product_list')}}',
                type: 'GET',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY4Y2JkMzM3NjhlM2ZmOGNmZjFjNGM0YTU0YzE2MTFjZmFlNzQ4OWY1YmVkZTg2N2IwMzU2ZWRlOTc4NWY3ZjUwZDQxNGQxZGZkZjQwZjlmIn0.eyJhdWQiOiIyIiwianRpIjoiZjhjYmQzMzc2OGUzZmY4Y2ZmMWM0YzRhNTRjMTYxMWNmYWU3NDg5ZjViZWRlODY3YjAzNTZlZGU5Nzg1ZjdmNTBkNDE0ZDFkZmRmNDBmOWYiLCJpYXQiOjE1NjI1NzAyMzEsIm5iZiI6MTU2MjU3MDIzMSwiZXhwIjoxNTk0MTkyNjMxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Q1LXRYqR9Y9UamkZJSwFKgAx62NZKRxgYpSz7n7zAC045OOpzSrY-5YT1t8m6cvCtaugpdIk0joURhViPAwmesT7Ik55LH3So50vrFb_eA7fWLu4pQUXIFr2VQg8T-uIROlBmGVpJdK8n5l4B-J50c845h58sPsB9jMd0hvniq_RPm06_gyNfUClT-rhy_6V3_VYo0aHzbxFsWK57ggWysQVeBRH39jCVgWynBbb6mBU7rjIW_myzodyDPZTJzyvn4II1ASZyeMyLEPhEkBp2N7Cuynp4oAfHYK1WuU6_OzrOoTmHqPzBPupYSY736IXfml0sfoSvIcDMdf-U3X1JYQAkQdONFckmVS8JIRYCfBpqLdZlokK5qXWRxGXFYG2YcDbZgsG42Q1H-cLHOYppBmXirj5ULIRfYVC9MlQKID6dvhdrP2EU7kC_lHIXv36hpy2PYIa3fsS-znp93wCMXjNSahuuAjJdErNkpUaXJZrdTwCYYYS1VZ-OpumtLY-kQdP4Y9jFGKQTsNSHF9CSKC0rpOzL5dW-7F54UZXxu9-Pl64_6AEo4yGr0473jnX_7WIeelpRkThN-dNZ-TUEGLH0Hwz_I9j635ARgzZjpERcuPVMcnBUHkCcnfFO_pGlpSzrpiDFq4nl6AYDsMSs3_xkR-YebMDgAaNLHB5yWk');
                },
                success: function () { }
            });

            fetch($selected_product.val());

            function fetch(id){
                $.ajax({
                    url: 'http://leader.com/api/products/' + id,
                    type: 'GET',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY4Y2JkMzM3NjhlM2ZmOGNmZjFjNGM0YTU0YzE2MTFjZmFlNzQ4OWY1YmVkZTg2N2IwMzU2ZWRlOTc4NWY3ZjUwZDQxNGQxZGZkZjQwZjlmIn0.eyJhdWQiOiIyIiwianRpIjoiZjhjYmQzMzc2OGUzZmY4Y2ZmMWM0YzRhNTRjMTYxMWNmYWU3NDg5ZjViZWRlODY3YjAzNTZlZGU5Nzg1ZjdmNTBkNDE0ZDFkZmRmNDBmOWYiLCJpYXQiOjE1NjI1NzAyMzEsIm5iZiI6MTU2MjU3MDIzMSwiZXhwIjoxNTk0MTkyNjMxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Q1LXRYqR9Y9UamkZJSwFKgAx62NZKRxgYpSz7n7zAC045OOpzSrY-5YT1t8m6cvCtaugpdIk0joURhViPAwmesT7Ik55LH3So50vrFb_eA7fWLu4pQUXIFr2VQg8T-uIROlBmGVpJdK8n5l4B-J50c845h58sPsB9jMd0hvniq_RPm06_gyNfUClT-rhy_6V3_VYo0aHzbxFsWK57ggWysQVeBRH39jCVgWynBbb6mBU7rjIW_myzodyDPZTJzyvn4II1ASZyeMyLEPhEkBp2N7Cuynp4oAfHYK1WuU6_OzrOoTmHqPzBPupYSY736IXfml0sfoSvIcDMdf-U3X1JYQAkQdONFckmVS8JIRYCfBpqLdZlokK5qXWRxGXFYG2YcDbZgsG42Q1H-cLHOYppBmXirj5ULIRfYVC9MlQKID6dvhdrP2EU7kC_lHIXv36hpy2PYIa3fsS-znp93wCMXjNSahuuAjJdErNkpUaXJZrdTwCYYYS1VZ-OpumtLY-kQdP4Y9jFGKQTsNSHF9CSKC0rpOzL5dW-7F54UZXxu9-Pl64_6AEo4yGr0473jnX_7WIeelpRkThN-dNZ-TUEGLH0Hwz_I9j635ARgzZjpERcuPVMcnBUHkCcnfFO_pGlpSzrpiDFq4nl6AYDsMSs3_xkR-YebMDgAaNLHB5yWk');
                    },
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
        }


    </script>
@endsection