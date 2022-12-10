    @extends('admin.adminUser_master')
    @section('admin')
      
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Image Id</th>
                        <th scope="col">Image</th>

                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($multi_images as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><img class=""
                                    src="{{ !empty($item->multi_image) ? Url('upload/user_images/' . $item->multi_image) : Url('upload/user_images/noImage.png') }}"
                                    width="80" height="80"></td>
                            <td><a href="{{ route('deleteMultiImage', $item->id) }}">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endsection
