    @extends('admin.adminUser_master')
    @section('admin')
        <script src="{{ asset('admin/asset/vendor/jquery/jquery.min.js') }}"></script>
        <div>
            <form method="POST" action="{{ route('userProductUpdate') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $userAllProduct->id }}">


                <div class="mb-3">

                    <select class="form-select" aria-label="Default select example" name="catagory_id">

                        {{-- <option selected>{{ $item->catagory_id }}</option> --}}
                        @foreach ($catagory as $item)
                            <option
                                value="{{ $item->id }}"{{ $item->id == $userAllProduct->catagory_id ? 'selected' : '' }}>
                                {{ $item->catagory_name }}</option>
                        @endforeach
                    </select>

                </div>


                <div class="mb-3">

                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="productName"
                        value="{{ $userAllProduct->product_name }}">

                </div>
                <div class="mb-3">

                    <label for="productPrice" class="form-label">Product Price</label>
                    <input type="number" class="form-control" id="productPrice" name="productPrice"
                        value="{{ $userAllProduct->product_price }}">

                </div>

                <div class="mb-3">

                    <label for="productDescription" class="form-label">Product Description </label>
                    <br>
                    <textarea name="productDescription" id="productDescription" cols="140" rows="10">{{ $userAllProduct->product_description }}</textarea>
                </div>

                <hr>
                <div>
                    <table class="table">
                        <thead>
                            <tr>

                                <th scope="col">Images</th>

                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($multi_images as $item)
                                <tr>

                                    <td><img class="" src="{{ asset($item->multi_image) }}" width="80"
                                            height="80"></td>
                                    <td><a href="{{ route('multiImageDelete', $item->id) }}">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mb-3">
                        <label for="imageFile" class="form-label">Image</form-control-smlabel>
                            <input name="multi_image[]" class="form-control " type="file" id="image" multiple="">
                    </div>

                    <div class="mb-3">
                        <label for="showimageFile" class="form-label"></label>
                        <img id="showimage" class="img-profile rounded avatar-lg"
                            src=" {{ Url('upload/user_images/noImage.png') }} " width="200" height="250">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
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
