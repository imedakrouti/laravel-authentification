@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />
<link href="{{ asset('css/Category/creat.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
    <div class="card card-default">
        <div class="card-header">
          Add a new Post
        </div>
        <div class="card-body">
        <form action="{{route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
               
                 <input type="hidden"name ="user_id" value="{{Auth::user()->id }}"  >
                
                <div class="form-group">
                    <label for="post title">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Add a new post" value="{{ isset($post) ? $post->title :old('title') }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
                <div class="form-group">
                    <label for="post description">Description:</label>
                    <textarea class="form-control @error('description')is-invalid @enderror" ropws="2" name="description" placeholder="Add a description"  >{{ isset($post) ? $post->description : old('description')}}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="post content">content:</label>
                    {{-- <textarea class="form-control" rows="3" name="content" placeholder="Add a content"></textarea> --}}
                    <input id="x" type="hidden" name="content" value="{{ isset($post) ? $post->content : old('content')}}" class="@error('image')is-invalid @enderror">
                    <trix-editor input="x"></trix-editor>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @if (isset($post))
                  <div class="form-group">
                    <img src="{{asset('storage/' . $post->image)}}" style="width: 100%" />
                  </div>
                @endif
                <div class="form-group">
                    <label for="post image">Image:</label>
                    <input type="file" name="image" class="form-control @error('image')is-invalid @enderror">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="categoryID">Select Category</label>
                    <select id="categoryID"name="categoryID"class=" custom-select form-control @error('categoryID')is-invalid @enderror">
                        @error('categoryID')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @foreach ( $categories as $category )

                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach

                    </select>
                  </div>
                   {{-- ($tags->count()>0) --}}
                   @if (count($tags))
                  <div class="form-group">
                    <label for="selectTag">Select a tag</label>
                    <select name="tags[]" class="form-control tags" id="selectTag" multiple>
                      @foreach ($tags as $tag)
                        <option value="{{$tag->id}}">
                          {{$tag->name}}
                        </option>
                        @endforeach

                    </select>
                  </div>
                  @endif
                <div class="form-group d-flex justify-content-center ">
                    <button type="submit" class="btn btn-success w-25 ">
                        Add
                    </button>
                </div>

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
