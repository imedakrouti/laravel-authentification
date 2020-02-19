@extends('layouts.app')
@section('styles')
@endsection
@section('content')

    <div class="card">
        <div class="card-header">
            <h2>{{isset($tag) ? 'update Tag' : 'Add new Tag'}}</h2>
        </div>
        <div class="card-body">
            <form action="{{isset($tag) ? route('tags.update',$tag):route('tags.store')}}" method="POST">
                @csrf
                @if (isset($tag->id))
                @method('put')
                @endif
                <div class="form-group">
                    <input type="text" name="name" id="" class="form-control " class="@error('name') is-invalid @enderror"placeholder="tag Title" aria-describedby="helpId" value="{{isset($tag) ? $tag->name:old('name')}}">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                 @enderror

                    <div class="form-group text-center">
                     <button type="submit" class="btn btn-success w-50 create">{{isset($tag) ? 'Update':'Create' }}</button>
                    </div>
            </form>
        </div>
    </div>

@endsection
