@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                              <div class="d-flex justify-content-between" >
                        <div>View Task </div>
                          <div><a href="{{route('books.index')}}" class="btn btn-success">Back</a></div>
                    </div>
                </div>

                <div class="card-body">

 <table class="table table-striped">
    <thead>
      <tr>
        <th width="20%">Field Name</th>
        <th width="80%"> Value</th>
     
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Id</td>
        <td>{{$post->id}}</td>
      
      </tr>
      <tr>
        <td>Project</td>
        <td>{{$post->project->name}}</td>
      
      </tr>
      <tr>
        <td>Start Time</td>
        <td>{{$post->start_time}}</td>
      
      </tr>
      <tr>
        <td>End Time</td>
        <td>{{$post->end_time}}</td>
      
      </tr>
 
      <tr>
        <td>Created At</td>
        <td>
          {{$post->created_at}}
        </td>
      
      </tr>

    </tbody>
  </table>
        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection