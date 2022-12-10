    @extends('admin.admin_master')
    @section('admin')
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
        <script src="{{ asset('admin/asset/vendor/jquery/jquery.min.js') }}"></script>
        <div>
            <form method="POST" action="{{ route('addCatagory') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Catagory Name</label>
                    <input type="text" class="form-control" id="catagory_name" name="catagory_name" value="">
                </div>
                <div class="mb-3">
                    <label for="imageFile" class="form-label">Image</form-control-smlabel>
                        <input name="catagory_image" class="form-control " type="file" id="image">
                </div>

                <div class="mb-3">
                    <label for="showimageFile" class="form-label"></label>
                    <img id="showimage" class="img-profile rounded avatar-lg"
                        src=" {{ !empty($catagory->catagory_image) ? Url('upload/user_images/' . $catagory->catagory_image) : Url('upload/user_images/noImage.png') }} "
                        width="200" height="250">
                </div>




                <hr>

                <button type="submit" class="btn btn-primary">Add Catagory</button>
        </div>
        </form>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#image').change(function(e) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#showimage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>
    @endsection
