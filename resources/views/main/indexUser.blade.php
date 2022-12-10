     @extends('main.main_master_user')
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
                     <h2 class="section-heading text-uppercase">Categories</h2>
                     <hr>
                 </div>

                 <div class="row">
                     @foreach ($catagory_all as $item)
                         <div class="col-lg-4 col-sm-6 mb-4">

                             <!-- Portfolio item 1-->
                             <div class="portfolio-item">
                                 <a class="portfolio-link" href="{{ route('userallProductsForSell', $item->id) }}">
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

         <!-- About-->
         <section class="page-section" id="about">
             <div class="container">
                 <div class="text-center">
                     <h2 class="section-heading text-uppercase">About</h2>
                     <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                 </div>
                 <ul class="timeline">
                     <li>
                         <div class="timeline-image"><img class="rounded-circle img-fluid"
                                 src="{{ asset('main/assets/img/about/1.jpg') }}" alt="..." /></div>
                         <div class="timeline-panel">
                             <div class="timeline-heading">
                                 <h4>2009-2011</h4>
                                 <h4 class="subheading">Our Humble Beginnings</h4>
                             </div>
                             <div class="timeline-body">
                                 <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut
                                     voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit
                                     vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                             </div>
                         </div>
                     </li>
                     <li class="timeline-inverted">
                         <div class="timeline-image"><img class="rounded-circle img-fluid"
                                 src="{{ asset('main/assets/img/about/2.jpg') }}" alt="..." /></div>
                         <div class="timeline-panel">
                             <div class="timeline-heading">
                                 <h4>March 2011</h4>
                                 <h4 class="subheading">An Agency is Born</h4>
                             </div>
                             <div class="timeline-body">
                                 <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut
                                     voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit
                                     vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                             </div>
                         </div>
                     </li>
                     <li>
                         <div class="timeline-image"><img class="rounded-circle img-fluid"
                                 src="{{ asset('main/assets/img/about/3.jpg') }}" alt="..." /></div>
                         <div class="timeline-panel">
                             <div class="timeline-heading">
                                 <h4>December 2015</h4>
                                 <h4 class="subheading">Transition to Full Service</h4>
                             </div>
                             <div class="timeline-body">
                                 <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut
                                     voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit
                                     vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                             </div>
                         </div>
                     </li>
                     <li class="timeline-inverted">
                         <div class="timeline-image"><img class="rounded-circle img-fluid"
                                 src="{{ asset('main/assets/img/about/4.jpg') }}" alt="..." /></div>
                         <div class="timeline-panel">
                             <div class="timeline-heading">
                                 <h4>July 2020</h4>
                                 <h4 class="subheading">Phase Two Expansion</h4>
                             </div>
                             <div class="timeline-body">
                                 <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut
                                     voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit
                                     vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                             </div>
                         </div>
                     </li>
                     <li class="timeline-inverted">
                         <div class="timeline-image">
                             <h4>
                                 Be Part
                                 <br />
                                 Of Our
                                 <br />
                                 Story!
                             </h4>
                         </div>
                     </li>
                 </ul>
             </div>
         </section>
     @endsection
