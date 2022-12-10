    @extends('admin.admin_master')
    @section('admin')
        <script src="{{ asset('admin/asset/vendor/jquery/jquery.min.js') }}"></script>



        @foreach ($multi_image as $item)
            <img src="{{ asset($item->multi_image) }}" class="rounded float" alt="...">
        @endforeach
    @endsection
