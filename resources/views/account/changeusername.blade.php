@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Change Username</div>
            <div class="card-body">
                @if(Session::has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{Session::get('message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="POST" action="{{ route('change-username') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="old_username" class="col-md-4 col-form-label text-md-right">Old Username</label>

                        <div class="col-md-6">
                            <input id="old_username" type="text" class="form-control @error('old_username') is-invalid @enderror" name="old_username" value="{{ Auth::user()->username }}" required autocomplete="old_username" autofocus disabled>

                            @error('old_username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_username" class="col-md-4 col-form-label text-md-right">New Username</label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                            @error('username')
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