    @extends('admin.admin_master')
    @section('admin')
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">catagory id</th>
                        <th scope="col">catagory Name</th>
                        <th scope="col">catagory Image</th>




                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($catagory_all as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->catagory_name }}</td>
                            <td><img class=""
                                    src="{{ !empty($item->catagory_image) ? Url('upload/user_images/' . $item->catagory_image) : Url('upload/user_images/noImage.png') }}"
                                    width="80" height="80"></td>



                            <td><a href="{{ route('editCatagory', $item->id) }}">edit</a></td>
                            <td><a href="{{ route('deleteCatagory', $item->id) }}">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endsection
