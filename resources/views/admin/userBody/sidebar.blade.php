       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

           <!-- Sidebar - Brand -->
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('homeUser') }}">
               <div class="sidebar-brand-icon rotate-n-15">

               </div>
               <div class="sidebar-brand-text mx-3">Sell Center </div>
           </a>


           <hr class="sidebar-divider">


           <!-- Nav Item - Pages Collapse Menu -->
           <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                   aria-expanded="true" aria-controls="collapsePages">

                   <span>My Products</span>
               </a>
               <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                   <div class="bg-white py-2 collapse-inner rounded">

                       <a class="collapse-item" href="{{ route('userAllProducts') }}">All My products</a>
                       <a class="collapse-item" href="{{ route('addProduct') }}">Add New Product</a>

                   </div>
               </div>
           </li>


           <!-- Divider -->
           <hr class="sidebar-divider d-none d-md-block">

           <!-- Sidebar Toggler (Sidebar) -->
           <div class="text-center d-none d-md-inline">
               <button class="rounded-circle border-0" id="sidebarToggle"></button>
           </div>

           <!-- Sidebar Message -->


       </ul>
