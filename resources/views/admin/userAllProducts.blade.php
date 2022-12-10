    @extends('admin.adminUser_master')
    @section('admin')
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product Id</th>
                        <th scope="col">Catagory Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Product Description</th>
                        <th scope="col">Images</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Sell</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userAllProducts as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->catagories->catagory_name }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->product_price }}</td>
                            <td>{{ $item->product_description }}</td>
                            <td><a href="{{ route('userProductImages', $item->id) }}">Images</a></td>
                            <td><a href="{{ route('userEditProduct', $item->id) }}">edit</a></td>
                            <td><a href="{{ route('deleteProduct', $item->id) }}">Delete</a></td>

                            <td>

                                <form action="{{ route('sellProduct') }}" method="post">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="pid" value="{{ $item->id }}">
                                    <input type="hidden" name="userId" value="{{ $item->user_id }}">
                                    <input type="hidden" name="catagory_id" value="{{ $item->catagories->id }}">
                                    <input type="hidden" name="product_name" value="{{ $item->product_name }}">
                                    <input type="hidden" name="product_price" value="{{ $item->product_price }}">
                                    <input type="hidden" name="product_description"
                                        value="{{ $item->product_description }}">

                                    <button type="submit" class="btn btn-primary">Sell</button>
                                </form>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
                {{ $userAllProducts->links() }}
            </table>
        @endsection
