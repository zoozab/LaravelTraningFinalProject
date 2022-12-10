     @extends('main.main_master')
     @section('main')
         <div class="end">
             <div class="collapse navbar-collapse" id="navbarColor02">
                 <ul class="navbar-nav">
                     <li class="nav-item"> <a class="nav-link" href="#" data-abc="true">Work</a> </li>
                     <li class="nav-item"> <a class="nav-link" href="#" data-abc="true">Capabilities</a> </li>
                     <li class="nav-item "> <a class="nav-link" href="#" data-abc="true">Articles</a> </li>
                     <li class="nav-item active"> <a class="nav-link mt-2" href="#" data-abc="true"
                             id="clicked">Contact<span class="sr-only">(current)</span></a> </li>
                 </ul>
             </div>
         </div>
         </nav>
         <!-- Main Body -->
         <section>
             <div class="container">
                 <div class="row">
                     <div class="col-sm-5 col-md-6 col-12 pb-4">
                         <h1>Comments</h1>
                         @foreach ($comments as $item)
                             <div class="comment mt-4 text-justify float-left">
                                 <hr>
                                 <br>

                                 <p>{{ $item->comment }}</p>

                             </div>
                         @endforeach



                     </div>
                     <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                         <form id="algin-form" method="post" action="{{ route('userpostComment') }}">
                             @csrf

                             <div class="form-group">
                                 <h4>Leave a comment</h4>
                                 @foreach ($product_id as $item)
                                     <input type="hidden" name="id" value="{{ $item->id }}">
                                 @endforeach
                                 <label for="message">Message</label>
                                 <textarea name="msg" id=""msg cols="30" rows="5" class="form-control"
                                     style="background-color: rgb(255, 255, 255);"></textarea>
                             </div>
                             <br>
                             <div class="form-group">
                                 <button type="submit" class="btn btn-primary">Post Comment</button>
                             </div>
                         </form>
                     </div>

                 </div>
                 <div class="row">{{ $comments->links() }}</div>
             </div>
         </section>
     @endsection
