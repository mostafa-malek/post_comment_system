@extends('../layout')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-body">
        <h5 class="card-title">Name : {{$resaults->tag}}  language</h5>
    </div>
</div>
  @foreach ($resaults->post as $post)
   
    <div class="card"  style="width: 18rem;">
        <img class="card-img-top" src="{{url($post->photo)}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text">{{$post->description}}</p>
        </div>
    </div>
    
  @endforeach  
    <div><a href="{{route('posts.index')}}">Back</a></div>
</div>
@endsection