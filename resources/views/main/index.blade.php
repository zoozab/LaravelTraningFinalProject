     @extends('main.main_master')
     @section('main')
         <header>
             <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                 <div class="carousel-inner">

                     @foreach ($multi_images as $key => $item)
                         <div class="carousel-item{{ $key == 0 ? ' active' : '' }}">
                             <img src="{{ $item->multi_image }}" class="d-block w-100 " width="2150" height="600">
                         </div>
                     @endforeach




                 </div>
                 <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                     data-bs-slide="prev">
                     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                     <span class="visually-hidden">Previous</span>
                 </button>
                 <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                     data-bs-slide="next">
                     <span class="carousel-control-next-icon" aria-hidden="true"></span>
                     <span class="visually-hidden">Next</span>
                 </button>
             </div>





         </header>
         <!-- Services-->
         <!-- Portfolio Grid-->

         <section class="page-section bg-light" id="portfolio">

             <div class="container">
                 <div class="text-center">
                     <h2 class="section-heading text-uppercase">Choose Category To Shop</h2>
                     <hr>
                 </div>

                 <div class="row">
                     @foreach ($catagory_all as $item)
                         <div class="col-lg-4 col-sm-6 mb-4">

                             <!-- Portfolio item 1-->
                             <div class="portfolio-item">
                                 <a class="portfolio-link" href="{{ route('allProductsForSell', $item->id) }}">
                                     <div class="portfolio-hover">
                                         <div class="portfolio-hover-content">
                                             <h1>{{ $item->catagory_name }}</h1>

                                         </div>
                                     </div>
                                     <img class="img-fluid"
                                         src="{{ !empty($item->catagory_image) ? Url('upload/user_images/' . $item->catagory_image) : Url('upload/user_images/noImage.png') }}"
                                         alt="..." />
                                 </a>

                             </div>
                         </div>
                     @endforeach
                 </div>
                 <div class="row">{{ $catagory_all->links() }}</div>

             </div>

             </div>

         </section>
     @endsection
