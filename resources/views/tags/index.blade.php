@extends('../layout')
@section('content')
<div class="container">

    <div class="card">
        <div class="card-body">
            <h5 class="display-4">All Tags</h5>
            <a href="{{route('tags.create')}}" class="btn btn-primary">Add New tag</a>
        </div>
    </div>
    @if($message = Session::get('success'))
    <div class="alert alert-success">{{$message}}</div>
    @endif
    @if(count($all_tags) != 0)

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tag Title</th>
                <th scope="col">Created</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            {{$i=1;}}
            @endphp

            @foreach($all_tags as $tag)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$tag->tag}}</td>
               
                <!--diffForhumans() فانكشن لاظهار المدة الزمنية المنقضية من نشأة البوست-->
                <td>{{$tag->created_at->diffForhumans()}}</td>
                <td>
                    <div class="row">
                        <div class="col-sm">
                            <a href="{{route('tags.show',$tag->id)}}" class="btn btn-success">Show</a>
                        </div>
                        <div class="col-sm">
                            <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-primary">Edit</a>
                        </div>
                        <div class="col-sm">
                            <a href="{{route('tags.destroy',$tag->id)}}" class="btn btn-danger">Delete</a>
                        </div>
                       
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
      <!--to show pagination-->
      {!! $all_tags->links('pagination::bootstrap-4')!!}
    @else
    <div class="alert alert-danger">
       there is no tag exist
    </div>
    @endif
  

</div>
@endsection