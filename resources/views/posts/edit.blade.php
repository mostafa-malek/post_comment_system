@extends('../layout')
@section('content')
@if(count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li class="alert alert-warning">{{$error}}</li>
        @endforeach
    </ul>
@endif
<form method="post" action="{{route('posts.update',$get_data->id)}}" enctype="multipart/form-data">
    <div class="form-group">
        @csrf
        @method('PUT')
        <label for="title">post title</label>
        <input type="text" class="form-control" name="title" value="{{$get_data->title}}" placeholder="post title">
    </div>
    <div class="form-group">
        <label for="description">description</label>
        <input type="text" class="form-control" name="description" value="{{$get_data->description}}" placeholder="post description">
    </div>

    <div class="form-group">
        @foreach ($tags as $item)
        <input type="checkbox" name="tags[]" class="form_control" value="{{$item->id}}"
        @foreach ($get_data->tag as $tags)
        @if($item->id == $tags->id )
        checked
        @endif
        @endforeach
        >
        <label>{{$item->tag}}</label>
        @endforeach
    </div>

    <div class="form-group">
        <label for="photo">photo</label>
        <input type="file" class="form-control"  name="photo" value="{{$get_data->photo}}" >
        @if ($errors->has('photo'))
        <span class="text-danger">{{ $errors->first('photo') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="auther">approved ?</label>
        <input type="text" class="form-control" name="is_approved" value="{{$get_data->is_approved}}" placeholder="post approved ?">
    </div>


    <button type="submit" class="btn btn-primary">Update Post</button>
</form>
@endsection