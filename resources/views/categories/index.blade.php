@extends('layouts.app')
@section('content')
    <div class="col-12">
    <a href="{{route('categories.create')}}" class="btn btn-success px-5 float-right mx-2 ">create</a>

</div>
<div class="card">
        <div class="card-header">
            <H3 class="text-center text-dark">Categories</H3>

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
       <table class="table table-borderd">
           <tbody>
               @forelse ($categories as $category)
               <tr class='lead text-bold bg-dark text-light text-capitalize'>
                <td  > {{$category->name}} <span class="badge badge-info mx-2">{{$category->posts->count()}}</span>Posts
                </td>
                <td>
                    <button class="btn btn-danger float-right mx-2"onclick="hundeldelete({{ $category->id }})">Delete</button>

                <a href="{{route('categories.edit',$category->id)}}"class="float-right btn btn-warning"onclick="">Edit</a>
                </td>
            </tr>
               @empty

               @endforelse

           </tbody>
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
@endsection
@section('scripts')
<script>
    function hundeldelete(id){
        console.log(id)
     var form=document.getElementById('delete')
     form.action='/categories/'+id
     //console.log(form)
     $('#deleteModal').modal('show')
    }
</script>
@endsection


