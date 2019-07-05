@extends('layouts.app')
@section('content')
<form action="Posts" method="POST">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-4">
            <input type="name" class="form-control" id="inputEmail3" placeholder="Email">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
    </div>
</form>    
@endsection