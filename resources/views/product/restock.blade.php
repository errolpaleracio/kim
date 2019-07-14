@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Add Product</div>

            <div class="card-body">
                <form method="POST" action="{{ route('restock-product') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-right">Quantity</label>

                        <div class="col-md-6">
                            <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{old('quantity', $product->quantity)}}" required autocomplete="quantity" disabled>

                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="restock_quantity" class="col-md-4 col-form-label text-md-right">Restock Quantity</label>

                        <div class="col-md-6">
                            <input id="restock_quantity" type="text" class="form-control @error('restock_quantity') is-invalid @enderror" name="restock_quantity" value="{{old('restock_quantity')}}" required autocomplete="restock_quantity">

                            @error('restock_quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
@endsection
@section('scripts')
    <script>
        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;  
        }

        window.onload = function(){
            document.getElementById('restock').onkeypress = isNumberKey;
            document.getElementById('quantity').onkeypress = isNumberKey;
        }
    </script>
@endsection