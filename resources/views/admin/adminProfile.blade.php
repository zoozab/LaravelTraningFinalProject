    @extends('admin.admin_master')
    @section('admin')
    
                    <div class="card" style="width: 20rem;"><center>
 <br>
  <img class="img-profile rounded avatar-lg " src="{{ (!empty($adminData->profile_image))?Url('upload/admin_images/'.$adminData->profile_image):Url('admin/asset/img/undraw_profile.svg')}} "   width="200" height="200"  >
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Name : {{ $adminData->name }}</li>
    <li class="list-group-item">Email : {{ $adminData->email }}</li>
    
  </ul>
 
  <hr>
    
    <button type="button" class="btn btn-info"><a href="{{ route('adminProfileEdit') }}" class="card-link">Edit</a></button>
   
  
   </center>
</div>

                   
            @endsection