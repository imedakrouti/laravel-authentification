@extends('layouts.app')
@section('content')
<div class="card">
        <div class="card-header">
            <H3 class="text-center text-dark">All users</H3>
            @if (session()->has('success'))
<div class="alert-success py-3 text-center mx-auto w-75">
    {{session()->get('success') }}
</div>
@elseif (session()->has('status'))
<div class="alert-success py-3 text-center mx-auto w-75">
    {{session()->get('status') }}
</div>
@endif
        </div>
        <div class="card-body">
            @if(count($users)>0)
       <table class="table table-borderd">
           <tbody>
               <thead>
                   <tr>
                   <th>Image</th>
                   <th>User Name</th>
                   <th class="text-right">Action</th>
                   </tr>
               </thead>
            </tbody>
            @foreach ($users as $user)
               <tr class='lead text-bold bg-dark text-light text-capitalize'>
               <td>
               {{--<img class="rounded-circle"src="{{asset('storage/'.$user->image)}}" alt=""width="100px"height="50px">  --}}
               <img src="{{$user->hasPicture() ? asset('storage/'.$user->getPicture()) : $user->getGravatar()}}"style="with:30px;height:30px;border-radius:50%">
                {{-- <img src="{{ gravatar()->image('email@example.com') }}">
// or
<img src="{{ gravatar()->avatar('email@example.com') }}">
Or with the facade:

<img src="{{ Gravatar::image('email@example.com') }}">
// or
<img src="{{ Gravatar::avatar('email@example.com') }}">
Or with the service injection:

@inject('gravatar', 'forxer\LaravelGravatar\Gravatar')

<img src="{{ $gravatar->image('email@example.com') }}">
// or
<img src="{{ $gravatar->avatar('email@example.com') }}"> --}}
               </td>
               <td>{{$user->name}} <span class="badge badge-info ml-2">{{$user->role}}</span></td>
                <td>
                @if(!$user->isAdmin())
                <a href=""class="badge badge-danger float-right"onclick=" hundeldelete({{$user->id}})">delete</a>
               <a href="{{route('user.makeAdmin',$user->id)}}"class="badge badge-warning float-right mx-2">Make Admin</a>
               @else
               <a href="{{route('user.makeWriter',$user->id)}}"class="badge badge-warning float-right mx-2">Make Writer</a>

               @endif
                 </<a></td>
            </tr>
               @endforeach
               @else
                <h2 class="text-center lees">No user Yet</h2>
            @endif
       </table>
       <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post"id='delete'>
                @csrf
                @method('delete')
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete user</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p text-center text-bold>Are you sure you want to delet it</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No go back</button>
              <button type="submit" class="btn btn-danger">yes deleted</button>
            </div>
          </div>
            </form>
        </div>
      </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    function hundeldelete(id){
        console.log(id)
     var form=document.getElementById('delete')

     $('#deleteModal').modal('show')
    }
</script>
@endsection



