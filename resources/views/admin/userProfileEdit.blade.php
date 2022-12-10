    @extends('admin.adminUser_master')
    @section('admin')
 <script src="{{ asset('admin/asset/vendor/jquery/jquery.min.js') }}"></script>
<div>
<form method="POST" action="{{ route('userProfileUpdate') }}" enctype="multipart/form-data" >
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $adminData->name }}" >
  </div>
    <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ $adminData->email }}" >
  </div>

    <div class="mb-3">
  <label for="imageFile" class="form-label">Image</form-control-smlabel>
  <input name="profile_image" class="form-control " type="file" id="image">
</div>

 <div class="mb-3">
      <label for="showimageFile" class="form-label"></label>
    <img id="showimage" class="img-profile rounded avatar-lg" src="{{ (!empty($adminData->profile_image))?Url('upload/admin_images/'.$adminData->profile_image):Url('admin/asset/img/undraw_profile.svg')}} " width="200" height="250" >
  </div>


  
  <hr>

  <button type="submit" class="btn btn-primary">Update</button>
  </div>
</form>
</div>
<script type="text/javascript" >

    $(document).ready(function(){
      $('#image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
          $('#showimage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
      });
    });
</script> 
@endsection