    @extends('admin.adminUser_master')
    @section('admin')
        <div>
            <h3>Change Password</h3>
            <p></p>


            @if (count($errors))
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger alert-dismissble fade show">{{ $error }}</p>
                @endforeach
            @endif

            <form method="POST" action="{{ route('UserUpdatePassword') }}">
                @csrf

                <div class="mb-3">
                    <label for="oldpassword" class="form-label">Old Password</label>
                    <input type="password" class="form-control" id="oldpassword" name="oldpassword" value="">
                </div>

                <div class="mb-3">
                    <label for="newpassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newpassword" name="newpassword" value="">
                </div>

                <div class="mb-3">
                    <label for="confirmpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" value="">
                </div>






                <hr>

                <button type="submit" class="btn btn-primary" value="Change Password">Change Password</button>
        </div>
        </form>
        </div>
    @endsection
