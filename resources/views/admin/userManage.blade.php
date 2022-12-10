    @extends('admin.admin_master')
    @section('admin')
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                        <th scope="col">Delete</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td><img src="{{ !empty($item->profile_image) ? Url('upload/admin_images/' . $item->profile_image) : Url('admin/asset/img/undraw_profile.svg') }}"
                                    width="100" height="100"></td>
                            <td><a href="{{ route('userDelete', $item->id) }}">Delete</a></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        @endsection
