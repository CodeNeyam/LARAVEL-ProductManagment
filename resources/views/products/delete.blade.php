@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Delete Product</h1>

            <div class="alert alert-danger mb-3">
                <strong>Warning!</strong> You are about to delete the following product:
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                </tbody>
            </table>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="mb-3">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
