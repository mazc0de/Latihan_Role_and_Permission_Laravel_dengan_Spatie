@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Product List
                    <a href="#" class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Tshirt</td>
                            <td>$99,00</td>
                            <td>
                                <a href="#" class="btn btn-success">Edit <i class="fas fa-edit"></i></a>
                                @role('admin')
                                    <a href="#" class="btn btn-danger">Edit <i class="fas fa-trash"></i></a>
                                @endrole
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection