 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="../../index3.html" class="brand-link">
         <img src="{{ URL::asset("assets/img/qw.png") }}" alt="Qwords" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">SOP Qwords</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ URL::asset("assets/img/qw.png") }}" class="img-circle elevation-2" alt="Qwords">
             </div>
             <div class="info">
                 <a href="#" class="d-block">Qwords</a>
             </div>
         </div>
         
        <?php
            $url=Request::segment(2);
            $urlDua=Request::segment(3);
        ?>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                    <a href="{{ url('admin/') }}" class="nav-link <?= ($url =='' )?'active':''; ?> ">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/sop') }}" class="nav-link <?= ($url =='sop' && $urlDua =='' )?'active':''; ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Manage SOP</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/sop/read/') }}" class="nav-link <?= ($url =='sop' && $urlDua =='read' )?'active':''; ?>">
                        <i class="fas fa-retweet"></i>
                        <p> SOP</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('logout') }}" class="nav-link">
                         <i class="fas fa-sign-out-alt"></i>
                        <p> Log Out</p>
                    </a>
                </li>



               
                
                
                
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>