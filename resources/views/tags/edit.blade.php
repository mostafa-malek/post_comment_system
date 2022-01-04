@extends('../layout')
@section('content')
@if(count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li class="alert alert-warning">{{$error}}</li>
        @endforeach
    </ul>
@endif
<form method="post" action="{{route('tags.update',$get_data->id)}}">
    <div class="form-group">
        @csrf
        @method('PUT')
        <label for="title">tag title</label>
        <input type="text" class="form-control" name="title" value="{{$get_data->tag}}" placeholder="tag title">
    </div>
    
    <button type="submit" class="btn btn-primary">Update Post</button>
</form>
@endsection