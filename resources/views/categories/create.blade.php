@extends('layouts.app')
@section('styles')
<link href="{{ asset('css/Category/create.css') }}" rel="stylesheet">
@endsection
@section('content')

    <div class="card">
        <div class="card-header">
            <h2>{{isset($category) ? 'update Category' : 'Add new Category'}}</h2>
        </div>
        <div class="card-body">
            <form action="{{isset($category) ? route('categories.update',$category):route('categories.store')}}" method="POST">
                @csrf
                @if (isset($category->id))
                @method('put')
                @endif
                <div class="form-group">
                    <input type="text" name="name" id="" class="form-control " class="@error('name') is-invalid @enderror"placeholder="Category Title" aria-describedby="helpId" value="{{isset($category) ? ($category->name):(old('name'))}}">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                 @enderror

                    <div class="form-group text-center">
                     <button type="submit" class="btn btn-success w-50 create">{{isset($category) ? 'Update':'Create' }}</button>
                    </div>
            </form>
        </div>
    </div>

@endsection
