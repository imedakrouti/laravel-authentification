@extends('layouts.app')
@section('content')
    <div class="col-12">
    <a href="{{route('posts.create')}}" class="btn btn-success px-5 float-right mx-2 ">create</a>

</div>
<div class="card">
        <div class="card-header">
            <H3 class="text-center text-dark">Posts</H3>

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
            @if(count($posts)>0)
       <table class="table table-borderd">
           <tbody>
               <thead>
                   <tr>
                   <th>Image</th>
                   <th>Title</th>
                   <th class="text-center">Action</th>
                   </tr>
               </thead>
            </tbody>
            @foreach ($posts as $post)
               <tr class='lead text-bold bg-dark text-light text-capitalize'>
               <td><img class="rounded-circle"src="{{asset('storage/'.$post->image)}}" alt=""width="100px"height="50px"></td>
               <td>{{$post->title}} <span class="badge badge-info mx-2">{{$post->tags->count()}}</span>Tag</td>
                <td>
                <button class="btn btn-danger float-right mx-2"onclick=" hundeldelete({{$post->id}})"> {{$post->trushed ?'Delete':'Truch'}}</button>
                    @if(!$post->trashed())
                <a href="{{route('posts.edit',$post->id)}}"class="float-right btn btn-warning"onclick="">Edit</a>
                @else
                <a href="{{route('trushed.restore',$post->id)}}"class="float-right btn btn-warning"onclick="">Restore</a>

                @endif
                </td>
            </tr>
               @endforeach
               @else
                <h2 class="text-center lees">No Posts Yet</h2>
            @endif
       </table>
       <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post"id='delete'>
                @csrf
                @method('delete')
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete category</h5>
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post"id='delete'>
                @csrf
                @method('delete')
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete category</h5>
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
@endsection
@section('scripts')
<script>
    function hundeldelete(id){
        console.log(id)
     var form=document.getElementById('delete')
     form.action='/posts/'+id
     console.log(form)
     $('#deleteModal').modal('show')
    }
</script>
@endsection



