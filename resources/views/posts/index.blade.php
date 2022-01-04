@extends('../layout')
@section('content')
<div class="container">

    <div class="card">
        <div class="card-body">
            <h5 class="display-4">All Posts</h5>
            <a href="{{route('posts.create')}}" class="btn btn-primary">Add New Post</a>
            <a href="{{route('posts.archive')}}" class="btn btn-warning">Trashed</a>
        </div>
    </div>
    @if($message = Session::get('success'))
    <div class="alert alert-success">{{$message}}</div>
    @endif
    @if($message = Session::get('failed'))
    <div class="alert alert-danger">{{$message}}</div>
    @endif
    @if(count($all_posts) != 0)

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Post Title</th>
                <th scope="col">Post Description</th>
                <th scope="col">Approved Status</th>
                <th scope="col">Photo</th>
                <th scope="col">Auther</th>
                <th scope="col">Created</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            {{$i=1;}}
            @endphp

            @foreach($all_posts as $post)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->description}}</td>
                <td>{{$post->is_approved}}</td>
                <td><img src="{{$post->photo}}" style="width: 70px; height:50px;"></td>
                <td>{{$post->user->name}}</td>
                <!--diffForhumans() فانكشن لاظهار المدة الزمنية المنقضية من نشأة البوست-->
                <td>{{$post->created_at->diffForhumans()}}</td>
                <td>
                    <div class="row">
                        <div class="col-sm">
                            <a href="{{route('posts.show',$post->slug)}}" class="btn btn-success">Show</a>
                        </div>
                        @if($post->user_id == Auth::id())
                        <div class="col-sm">
                            <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a>
                        </div>
                        <div class="col-sm">
                            <a href="{{route('soft.delete',$post->id)}}" class="btn btn-warning">Trash</a>
                        </div>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
      <!--to show pagination-->
      {!! $all_posts->links('pagination::bootstrap-4')!!}
    @else
    <div class="alert alert-danger">
       there is no post exist
    </div>
    @endif
  

</div>
@endsection