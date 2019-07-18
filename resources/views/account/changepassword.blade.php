@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Change Password</div>
            <div class="card-body">
                @if(Session::has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{Session::get('message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif                
                <form method="POST" action="{{ route('change-password') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="old_password" class="col-md-4 col-form-label text-md-right">Old password</label>

                        <div class="col-md-6">
                            <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="old_password" autofocus>

                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password" class="col-md-4 col-form-label text-md-right">New Password</label>

                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new_password">

                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="repeat_password" class="col-md-4 col-form-label text-md-right">Repeat Password</label>

                        <div class="col-md-6">
                            <input id="repeat_password" type="password" class="form-control @error('repeat_password') is-invalid @enderror" name="repeat_password" required autocomplete="repeat_password">

                            @error('repeat_password')
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
        
    </script>
@endsection