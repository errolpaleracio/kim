@extends('layouts.app')
@section('content')
<div class="container">
    <a href="{{route('create-account')}}" class="btn btn-primary mb-4">Add new User</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Email Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->username}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>    
</div>
@endsection

@section('scripts')
<script>
</script>
@endsection