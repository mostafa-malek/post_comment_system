@extends('../layout')
@section('content')
<div class="container">

    <div class="card">
        <div class="card-body">
            <h5 class="display-4">All Users</h5>
            <a href="{{route('users.create')}}" class="btn btn-primary">Add New User</a>
        </div>
    </div>
    @if($message = Session::get('success'))
    <div class="alert alert-success">{{$message}}</div>
    @endif
    @if($message = Session::get('delete'))
    <div class="alert alert-danger">{{$message}}</div>
    @endif
    @if(count($users) != 0)

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            {{$i=1;}}
            @endphp

            @foreach($users as $user)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <!--diffForhumans() فانكشن لاظهار المدة الزمنية المنقضية من نشأة البوست-->
                <td>{{$user->created_at->diffForhumans()}}</td>
                <td>
                    <div class="row">
                        <div class="col-sm">
                            <form action="{{route('users.destroy',$user->id)}}" method="post">
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
      {!! $users->links('pagination::bootstrap-4')!!}
    @else
    <div class="alert alert-danger">
       there is no user exist
    </div>
    @endif
  

</div>
@endsection