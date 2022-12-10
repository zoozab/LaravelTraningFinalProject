    @extends('admin.admin_master')
    @section('admin')
        <script src="{{ asset('admin/asset/vendor/jquery/jquery.min.js') }}"></script>
        <div>
            <form method="POST" action="{{ route('createMasterHead') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
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
                                            height="80">
                                    </td>
                                    <td><a href="{{ route('deletemasterhead', $item->id) }}">Delete</a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
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

                <button type="submit" class="btn btn-primary">Add Images</button>
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
