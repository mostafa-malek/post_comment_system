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
<form method="post" action="{{route('users.store')}}" >
    <div class="form-group">
        @csrf
        <label for="title">User Name</label>
        <input type="text" class="form-control"  name="name" id="name" placeholder="User name">
               <!-- عمل فالديت باك ايند في حالة الاخلال بتعليمات كل فورم-->
        @if ($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control"  name="email" id="email" placeholder="email">
        @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control"  name="password" id="password" placeholder="password">
        @if ($errors->has('password'))
        <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Add User</button>
</form>
@endsection