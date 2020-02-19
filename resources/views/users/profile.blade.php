@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />
<link href="{{ asset('css/Category/creat.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
<div class="card card-default">
    <div class="card-header">
        Profile
    </div>
    <div class="card-body">
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
              <input type="text" name="name" class="form-control" value="{{$user->name}}">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" name="email" class="form-control" value="{{$user->email}}">
            </div>
            <div class="form-group">
              <label for="about">About:</label>
            <textarea class="form-control" rows="2" name="about" placeholder="Tell us about you">{{ $profile->about }}</textarea>
            </div>
            <div class="form-group">
              <label for="facebook">Facebook:</label>
              <input type="text" name="facebook" class="form-control" value="{{$profile->facebook}}">
            </div>
            <div class="form-group">
              <label for="twitter">Twitter:</label>
              <input type="text" name="twitter" class="form-control" value="{{$profile->twitter}}">
            </div>
            <div class="form-group">
              <label for="twitter">Picture:</label><br>
              <img src="{{ asset('storage/'.$user->getPicture())}}" width="100px"alt="" height="100px" style="border-radius:50%"class="d-block mx-auto">
              <input type="file" name="picture" class="form-control mt-2">
            </div>
            <div class="form-group">
                <button class="btn btn-success">
                    Update Profile
                </button>
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
