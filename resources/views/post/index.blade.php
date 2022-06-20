@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between" >
                        <div>Books Management System</div>
                          <div><a href="{{route('books.create')}}" class="btn btn-success">Create Book</a></div>
                    </div>
                </div>

                <div class="card-body">
                 <div class="mb-2">
                      <form class="form-inline" action="">
                      <label for="category_filter">Filter By Category &nbsp;</label>
                       <select class="form-control" id="category_filter" name="category">
                        <option value="">Select Category</option>
                       @if(count($categories))
                          @foreach($categories as $category)
                             <option value="{{$category->name}}"  {{(Request::query('category') && Request::query('category')==$category->name)?'selected':''}}  >{{$category->name}}</option>
                          @endforeach
                        @endif

               
                      </select>
                      <label for="keyword">&nbsp;&nbsp;</label>
                      <input type="text" class="form-control"  name="keyword" placeholder="Enter keyword" id="keyword">
                      <span>&nbsp;</span> 
                       <button type="button" onclick="search_post()" class="btn btn-primary" >Search</button>
                       @if(Request::query('category') || Request::query('keyword'))
                        <a class="btn btn-success" href="{{route('books.index')}}">Clear</a>
                       @endif

                    </form>
                  </div>
                  <div class="table-responsive">
                    <table style="width: 100%;" class="table table-stripped ">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Book Name</th>
                          <th>Author Name</th>
                          <th>Created By</th>
                          <th>Category</th>
                          <th>Image</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($books))
                          @foreach($books as $post)
                        <tr>
                            <td >{{$post->id}}</td>
                            <td style="width:15%">{{$post->title}}</td>
                            <td style="width:15%">{{$post->author_name}}</td>
                            <td >{{$post->user->name}}</td>
                            <td >{{$post->category->name}}</td>
                                   <td>
            <img width="100px" height="100px" src="{{asset('post_images/'.$post->image)}}">
        </td>
                                                      <td  style="width:250px;">
                              <a  href="{{route('books.show',$post->id)}}" class="btn btn-primary">View</a>
                              <a href="{{route('books.edit',$post->id)}}" class="btn btn-success">Edit</a>
                              <a href="javascript:delete_post('{{route('books.destroy',$post->id)}}')" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>


                          @endforeach
                        @else

                          <tr>
                            <td colspan="6" >No books found</td>
        
                          </tr>
                        @endif

                
                      </tbody>
                    </table>
  @if(count($books))
   {{$books->appends(Request::query())->links()}}
  @endif

                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="post_delete_form" method="post" action="">
  @csrf
  @method('DELETE')
</form>


@endsection

@section('javascript')
<script type="text/javascript">
  var query=<?php echo json_encode((object)Request::only(['category','keyword','sortByComments'])); ?>;


  function search_post(){

    Object.assign(query,{'category': $('#category_filter').val()});
    Object.assign(query,{'keyword': $('#keyword').val()});

    window.location.href="{{route('books.index')}}?"+$.param(query);

  }

  function sort(value){
    Object.assign(query,{'sortByComments': value});

    window.location.href="{{route('books.index')}}?"+$.param(query);
  }

  function delete_post(url){

    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this post!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $('#post_delete_form').attr('action',url);
         $('#post_delete_form').submit();
      } 
    });


  }


</script>
@endsection