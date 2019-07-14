@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Add Product</div>

            <div class="card-body">
                <form method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{isset($product)?$product->id : ''}}">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', isset($product)?$product->name : '') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unit_price" class="col-md-4 col-form-label text-md-right">Unit Price</label>

                        <div class="col-md-6">
                            <input id="unit_price" type="text" class="form-control @error('unit_price') is-invalid @enderror" name="unit_price" value="{{ old('unit_price', isset($product)?$product->unit_price : '') }}" required autocomplete="unit_price">

                            @error('unit_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @if(!isset($product))
                    <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-right">Quantity</label>

                        <div class="col-md-6">
                            <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{old('quantity', isset($product)?$product->quantity : '')}}" required autocomplete="quantity">

                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="critical_lvl" class="col-md-4 col-form-label text-md-right">Critical Level</label>

                        <div class="col-md-6">
                            <input id="critical_lvl" type="text" class="form-control @error('critical_lvl') is-invalid @enderror" name="critical_lvl" value="{{old('critical_lvl', isset($product)?$product->critical_lvl : '')}}" required autocomplete="critical_lvl">

                            @error('critical_lvl')
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
            if(charCode == 46)
                return true;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;  
        }

        window.onload = function(){
            document.getElementById('unit_price').onkeypress = isNumberKey;
            document.getElementById('quantity').onkeypress = isNumberKey;
            document.getElementById('critical_lvl').onkeypress = isNumberKey;
        }
    </script>
@endsection