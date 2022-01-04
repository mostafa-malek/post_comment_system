@extends('../layout')
<style>

.media {
    margin-bottom: 50px;

}

  .media img {
    width: 60px;
    height: 60px
}
.card {
    margin-bottom: 20px;

}
.reply a {
    text-decoration: none
}
.date {
    font-size: 11px
}

.comment-text {
    font-size: 12px
}

.fs-12 {
    font-size: 12px
}

.shadow-none {
    box-shadow: none
}

.name {
    color: #007bff
}

.cursor:hover {
    color: blue
}

.cursor {
    cursor: pointer
}

.textarea {
    resize: none
}
</style>
@section('content')
<div class="container">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name : {{$display->title}}  language</h5>
        </div>
    </div>
   
    <div class="card" style="">
        <img class="card-img-top" src="{{url($display->photo)}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{$display->title}}</h5>
          <p class="card-text">{{$display->description}}</p>
          @foreach ($display->tag as $tag)
          #<a href="{{route('tags.tags',$tag->id)}}">{{$tag->tag}}</a>
          @endforeach
          <div class="bg-light p-2">
            <form  action="{{ route('comments.store') }}" method="POST">
                @csrf
                <div class="d-flex flex-row align-items-start">
                    {{Auth::user()->name}}
                    <textarea class="form-control ml-1 shadow-none textarea" name ="description"></textarea>
                </div>
                <input type="hidden" name="post_id" value="{{ $display->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button></div>
            </form>
          </div>
        </div>
    </div>
    <!-- start comment -->
    <div class="row">
        <div class="col-md-12">
            @foreach ($comments as $comment)
                <div class="media"> <img class="mr-3 rounded-circle"  src="{{url($display->photo)}}" />
                    <div class="media-body">
                        <div class="row">
                            <div class="col-8 d-flex">
                                <h5>{{$comment->user->name}}</h5> <span> {{$comment->created_at->diffForhumans()}}</span>
                            </div>
                            
                        </div>
                        {{$comment->description}}
                            
                            @if($comment->replies == true)
                                @foreach ($comment->replies as $reply)
                                    <div class="media mt-4"> <a class="pr-3" href="#"><img class="rounded-circle"  src="{{url($display->photo)}}" /></a>
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-12 d-flex">
                                                    <h5>{{$reply->user->name}}</h5> <span>{{$comment->created_at->diffForhumans()}}</span>
                                                </div>
                                            </div>{{$reply->description}}
                                        </div>
                                    </div>
                                @endforeach     
                                    <div class="bg-light p-2">
                                        <form  action="{{ route('comments.store') }}" method="POST">
                                            @csrf
                                            <div class="d-flex flex-row align-items-start">
                                                {{Auth::user()->name}}
                                                <textarea class="form-control ml-1 shadow-none textarea" name ="description"></textarea>
                                            </div>
                                            <input type="hidden" name="post_id" value="{{ $display->id }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                                            <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none" type="submit">Reply</button></div>
                                        </form>
                                    </div>
                            @endif
                    </div>
                </div>
            @endforeach
        
        </div>
  </div> 
  <div class="d-flex justify-content-center">
</div>
  <!-- end comment -->
    <div><a href="{{route('posts.index')}}">Back</a></div>
</div>
@endsection