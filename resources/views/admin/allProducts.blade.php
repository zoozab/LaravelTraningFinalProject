    @extends('admin.admin_master')
    @section('admin')
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">product Id</th>
                    <th scope="col">Salesperson Id</th>
                    <th scope="col">Product Previous Id</th>
                    <th scope="col">Catagory Name</th>
                    <th scope="col">product name</th>

                    <th scope="col">Product price</th>
                    <th scope="col">Product description</th>

                    <th scope="col">Images</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Reject</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->salesperson_id }}</td>
                        <td>{{ $item->productPrevious_id }}</td>
                        <td>{{ $item->catagories->catagory_name }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->product_price }}</td>
                        <td>{{ $item->product_description }}</td>


                        <td><a href="{{ route('adminProductImages', $item->productPrevious_id) }}">Images</a></td>
                        <td><a href="{{ route('adminCommentsShow', $item->id) }}">Comments</a></td>
                        <td>
                            <form action="{{ route('rejectProduct') }}" method="POST">
                                @csrf
                                @method('post')
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="salesperson_id" value="{{ $item->salesperson_id }}">
                                <input type="hidden" name="catagory_id" value="{{ $item->catagories->id }}">
                                <input type="hidden" name="product_name" value="{{ $item->product_name }}">
                                <input type="hidden" name="product_price" value="{{ $item->product_price }}">
                                <input type="hidden" name="product_description" value="{{ $item->product_description }}">

                                <button type="submit" class="btn btn-danger">Reject</button>



                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <div class="row">{{ $products->links() }}</div>
        </table>
    @endsection
