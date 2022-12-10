    @extends('admin.admin_master')
    @section('admin')
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Comment Id</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->comment }}</td>
                        <td> <a href="{{ route('deleteComment', $item->id) }}">Delete</a> </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">{{ $comments->links() }}</div>
    @endsection
