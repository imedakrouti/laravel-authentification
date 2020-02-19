@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />
<link href="{{ asset('css/Category/create.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')

    <div class="card">
        <div class="card-header">
            <h2>Update Post</h2>
        </div>
        <div class="card-body">
            <form action="{{route('posts.update',$post->id)}}" method="post"
            enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"placeholder="Post Title" value="{{$post->title}}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
            <textarea name="description" id=""  class="form-control @error ('description') is-invalid @enderror">{{$post->description}}</textarea>
                @error('content')
            <span class="invalid-feedback text-bold">{{ $message }}</span>
                 @enderror
            </div>
            <div class="form-group">
                <input id="x" type="hidden" name="content"value="{{$post->content}}">
                 <trix-editor input="x"></trix-editor>
                 {{--
                    <textarea name="content"  class="form-control @error ('content') is-invalid @enderror">{{old('content')}}</textarea>
                    @error('content')
                      <span class="invalid-feedback text-bold">{{ $message }}</span>
                     @enderror
                 </div>
                 --}}
                 <div class="form-group text-center">
                    <img src="{{asset('storage/'.$post->image)}}" class="rounded-circle mt-2 text-center"alt="">

                </div>
                <div class="form-group">
                  <input type="file" name="image" id="" class="form-control " class="@error('image') is-invalid @enderror"placeholder="Image" aria-describedby="helpId" value="{{old('image')}}">
                    @error('image')
                    <span class="invalid-feedback text-bold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="selectTag">Select a tag</label>
                    <select name="tags[]" class="form-control tags" id="selectTag" multiple>
                      @foreach ($tags as $tag)
                        <option value="{{$tag->id}}"@if ($post->hasTag($tag->id))
                            selected
                          @endif>
                          {{$tag->name}}
                        </option>
                        @endforeach

                    </select>
                  </div>
                    <div class="form-group text-center">
                     <button type="submit" class="btn btn-success w-50 create">update</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.tags').select2();
});
</script>
@endsection
