@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row text-center">
            <div class="col-md-4">
            <div class="card text-white bg-info">
                <div class="card-header">
                    <h2>Users</h2>
                </div>
                <div class="card-body">
                <h2>{{$user_count}}</h2>
                </div>
            </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger">
                    <div class="card-header">
                        <h2>Posts</h2>
                    </div>
                    <div class="card-body">
                    <h2>{{ $post_count}}</h2>
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning">
                        <div class="card-header">
                            <h2>Category</h2>
                        </div>
                        <div class="card-body">
                        <h2>{{$category_count}}</h2>
                        </div>
                    </div>
                    </div>
        </div>
    </div>
</div>
@endsection
