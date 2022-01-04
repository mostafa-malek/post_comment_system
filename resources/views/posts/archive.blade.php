@extends('../layout')
@section('content')
<div class="container">

    <div class="card">
        <div class="card-body">
            <h5 class="display-4">All Archive</h5>
            <a href="{{route('posts.index')}}" class="btn btn-primary">All posts</a>
        </div>
    </div>
    @if($all_archive->count() > 0)
      <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Post Title</th>
                <th scope="col">Post Description</th>
                <th scope="col">Approved Status</th>
                <th scope="col">Auther</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            {{$i=1;}}
            @endphp
                        @foreach($all_archive as $post)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$post->title}}</td>
                            <td>{{$post->description}}</td>
                            <td>{{$post->is_approved}}</td>
                            <td>{{$post->auther}}</td>
                            <td>
                                <div class="row">
                            
                                    <div class="col-sm">
                                        <a href="{{route('posts.restore',$post->id)}}" class="btn btn-primary">Restore</a>
                                    </div>
                                    <div class="col-sm">
                                        <form action="{{route('posts.destroy',$post->id)}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                
                                </div>
                            </td>
                        </tr>
                        @endforeach
            
        </tbody>
    </table>
    <!--to show pagination-->
    {!! $all_archive->links('pagination::bootstrap-4')!!}
    @else
    <div class="alert alert-danger">
        Trash is empty
     </div>
    @endif
</div>
@endsection