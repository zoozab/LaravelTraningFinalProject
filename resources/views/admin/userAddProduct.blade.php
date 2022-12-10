    @extends('admin.adminUser_master')
    @section('admin')
        <script src="{{ asset('admin/asset/vendor/jquery/jquery.min.js') }}"></script>
        @if (count($errors))
            @foreach ($errors->all() as $error)
                <p class="alert alert-danger alert-dismissble fade show">{{ $error }}</p>
            @endforeach
        @endif
        <div>
            <form method="POST" action="{{ route('productStore') }}" enctype="multipart/form-data">
                @csrf




                <div class="mb-3">
                    <label for="cat_id">Select Catagory</label>
                    <br>
                    <select name="catagoryName" class="form-select" aria-label="Default select example" id="cat_id">

                        <option selected=""></option>
                        @foreach ($catagory as $item)
                            <option value="{{ $item->id }}">{{ $item->catagory_name }}</option>
                        @endforeach
                    </select>

                </div>


                <div class="mb-3">

                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="productName"
                        placeholder="Enter The Product Name">

                </div>

                <div class="mb-3">

                    <label for="productPrice" class="form-label">Product Price</label>
                    <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="Price">

                </div>
                <div class="mb-3">

                    <label for="productDescription" class="form-label">Product Description </label>
                    <br>
                    <textarea name="productDescription" id="productDescription" cols="140" rows="10"
                        placeholder="Write Description About The Product Here"></textarea>
                </div>
                <div class="mb-3">
                    <label for="imageFile" class="form-label">Image</form-control-smlabel>
                        <input name="multi_image[]" class="form-control " type="file" id="image" multiple="">
                </div>

                <div class="mb-3">
                    <label for="showimageFile" class="form-label"></label>
                    <img id="showimage" class="img-profile rounded avatar-lg"
                        src=" {{ Url('upload/user_images/noImage.png') }} " width="200" height="250">
                </div>

                <hr>

                <button type="submit" class="btn btn-primary">Add Product</button>
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
