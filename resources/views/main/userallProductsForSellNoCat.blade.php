     @extends('main.main_master_user')
     @section('main')
         <p></p>
         <br>
         <br>
         <br>

         <div class="album py-5 bg-light">

             <div class="container">

                 <div class="row">
                     @foreach ($product as $item)
                         <div class="col-md-4">
                             <div class="card mb-4 box-shadow">
                                 <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                     <div class="carousel-inner">
                                         {{-- @php
                                             $p_id = $item->id;
                                             $image = $multi_image->where('product_id', $p_id);
                                             
                                         @endphp --}}
                                         @foreach ($multi_image->where('product_id', $item->id) as $key => $ss)
                                             <div class="carousel-item">
                                                 <img style="height: 225px; width: 100%; display: block;"
                                                     src="{{ $ss->multi_image }}"
                                                     class="d-block w-100{{ $key == 0 ? 'active' : '' }} "
                                                     data-holder-rendered="true">
                                             </div>
                                         @endforeach
                                     </div>

                                     <button class="carousel-control-prev" type="button"
                                         data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                         <span class="visually-hidden">Previous</span>
                                     </button>
                                     <button class="carousel-control-next" type="button"
                                         data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                         <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                         <span class="visually-hidden">Next</span>
                                     </button>
                                 </div>

                                 <div class="card-body">
                                     <h4>Category : {{ $item->catagories->catagory_name }}</h4>
                                     <hr>
                                     <h4>Name : {{ $item->product_name }}</h4>
                                     <hr>
                                     <p class="card-text">Description : {{ $item->product_description }}</p>
                                     <br>
                                     <h4>Price : {{ $item->product_price }}</h4>
                                     <hr>

                                     <div class="d-flex justify-content-between align-items-center">
                                         <div class="btn-group">
                                             <form action="{{ route('buyProduct') }}" method="post">
                                                 @csrf
                                                 <input type="hidden" name="id" value="{{ $item->id }}">
                                                 <input type="hidden" name="salesperson_id"
                                                     value="{{ $item->salesperson_id }}">
                                                 <input type="hidden" name="productPrevious_id"
                                                     value="{{ $item->productPrevious_id }}">
                                                 <input type="hidden" name="catagory_id" value="{{ $item->catagory_id }}">
                                                 <input type="hidden" name="product_name"
                                                     value="{{ $item->product_name }}">
                                                 <input type="hidden" name="product_price"
                                                     value="{{ $item->product_price }}">
                                                 <input type="hidden" name="product_description"
                                                     value="{{ $item->product_description }}">
                                                 <button type="submit" class="btn btn-l btn-warning">Buy This
                                                     Product</button>
                                             </form>
                                         </div>
                                         <div class="btn-group"><a
                                                 href="{{ route('userProductShowAllComments', $item->id) }}">
                                                 <button type="button" class="btn btn-l btn-secondary">Comments</button>
                                             </a>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
                 <div class="row">{{ $product->links() }}</div>
             </div>

         </div>
     @endsection
