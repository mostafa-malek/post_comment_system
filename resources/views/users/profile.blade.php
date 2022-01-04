@extends('../layout')

@section('content')
    <div class="container">
        <form method="POST" action="{{route('profile.update')}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="exampleFormControlInput1">Name</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}" >
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Password</label>
                <input type="password" class="form-control" name="password" value="{{$user->password}}" >
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Website</label>
                
                <!--جلب الداتا من خلال الفانكشن الموجودة في موديل اليوزر والتي تربطها بالبروفايل-->
                <input type="text" class="form-control" name="website" value="{{$user->profile->website}}" >
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Gender</label>
                <select class="form-control" name="gender">
                    @if ($user->profile->gender=="Male")
                        <option selected value="{{$user->profile->gender}}">{{$user->profile->gender}}</option>
                        <option  value="Female">Female</option>                        
                    @else
                        <option selected value="Female">Female</option>
                        <option value="Male">Male</option> 
                    @endif
                    
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Bio</label>
                <textarea class="form-control"  name="bio" rows="3">{{$user->profile->bio}}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection
