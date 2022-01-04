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
<form method="post" action="{{route('tags.store')}}" enctype="multipart/form-data">
    <div class="form-group">
        @csrf
        <label for="tag">tag title</label>
        <input type="text" class="form-control"  name="tag" id="tag" placeholder="tag title">
               <!-- عمل فالديت باك ايند في حالة الاخلال بتعليمات كل فورم-->
        @if ($errors->has('tag'))
        <span class="text-danger">{{ $errors->first('tag') }}</span>
        @endif
    </div>
    


    <button type="submit" class="btn btn-primary">Save tag</button>
</form>
@endsection