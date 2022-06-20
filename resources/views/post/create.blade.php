@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    <div class="d-flex justify-content-between" >
                        <div>Asign Task </div>
                          <div><a href="{{route('books.index')}}" class="btn btn-success">Back</a></div>
                    </div>
                </div>

                <div class="card-body">
                 <form action="{{route('books.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="category">Project :</label>
                      <select class="form-control" id="category" name="category">
                        <option value="">Select Category</option>

                        @if(count($categories))
                          @foreach($categories as $category)
                             <option value="{{$category->id}}"  {{(old('category') && old('category')==$category->id )?'selected':''}}  >{{$category->name}}</option>
                          @endforeach
                        @endif
                        
                      </select>
                    @if($errors->any('category'))
                        <span class="text-danger"> {{$errors->first('category')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="start_time">Start Time :</label>
                      <input type="text" value="{{old('start_time')}}" class="form-control"  id="start_time" placeholder="Enter start_time" name="start_time" >
                      @if($errors->any('start_time'))
                        <span class="text-danger"> {{$errors->first('start_time')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="end_time">End Time :</label>
                      <input type="text" value="{{old('end_time')}}" class="form-control"  id="end_time" placeholder="Enter end_time" name="end_time" >
                      @if($errors->any('end_time'))
                        <span class="text-danger"> {{$errors->first('end_time')}}</span>
                      @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
 $("#category").select2({
    placeholder: "Select a project",
    allowClear: true
  });
</script>
@endsection