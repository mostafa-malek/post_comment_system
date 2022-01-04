@extends('../layout')
@section('content')

<!--تجميع كل الايررور الخاصة بالفورم وعرضها تحت بعضها-->
@if(count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li class="alert alert-warning">{{$error}}</li>
        @endforeach
    </ul>
@endif                                                      <!--لاتاحة استقبال ملفات-->
<form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
    <div class="form-group">
        @csrf
        <label for="title">post title</label>
        <input type="text" class="form-control"  name="title" id="title" placeholder="post title">
               <!-- عمل فالديت باك ايند في حالة الاخلال بتعليمات كل فورم-->
        @if ($errors->has('title'))
        <span class="text-danger">{{ $errors->first('title') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="description">description</label>
        <input type="text" class="form-control"  name="description" id="description" placeholder="post description">
        @if ($errors->has('description'))
        <span class="text-danger">{{ $errors->first('description') }}</span>
        @endif
    </div>

    
    <div class="form-group">
        @foreach ($tags as $tag)
        <input type="checkbox" name="tags[]" class="form_control" value="{{$tag->id}}">
        <label>{{$tag->tag}}</label>
        @endforeach
    </div>
          

        
    <div class="form-group">
        <label for="photo">photo</label>
        <input type="file" class="form-control"  name="photo" >
        @if ($errors->has('photo'))
        <span class="text-danger">{{ $errors->first('photo') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="is_approved">approved ?</label>
        <input type="text"  class="form-control" name="is_approved" id="is_approved" placeholder="post approved ?">
        @if ($errors->has('is_approved'))
        <span class="text-danger">{{ $errors->first('is_approved') }}</span>
        @endif
    </div>


    <button type="submit" class="btn btn-primary">Save Post</button>
</form>
@endsection