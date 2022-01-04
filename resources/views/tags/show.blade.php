@extends('../layout')
@section('content')
<div class="container">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name : {{$display->title}}  language</h5>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">tag Title</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            {{$i=1;}}
            @endphp
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$display->tag}}</td>
                <td>
                    <div class="row">
                        <div class="col-sm">
                            <a href="{{route('tags.edit',$display->id)}}" class="btn btn-primary">Edit</a>
                        </div>
                        <div class="col-sm">
                            <form action="{{route('tags.destroy',$display->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>
    <div><a href="{{route('tags.index')}}">Back</a></div>
</div>
@endsection