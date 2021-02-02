@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Users List
                    <a href="#" class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>
                                        <span class="badge badge-success">
                                            {{-- {{ print_r($user->getRoleNames(),1)}} --}}
                                            {{$user->getRoleNames()[0]}}
                                        </span>
                                </td>
                                <td>
                                    <a href="{{ route('edit',$user->id)}}" class="btn btn-success">Edit <i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger">Edit <i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection