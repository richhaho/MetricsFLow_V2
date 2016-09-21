<!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      @if (Session('user_role') == 'Admin')
        <ul class="sidebar-menu">
           <li class="treeview">
               <a href="/Portfolio">
                   <i class="fa fa-arrow-left" ></i> <span>Back</span>  
               </a>
           </li>
         </ul>
      @else
       <ul class="sidebar-menu">
       <!--  <li class="header">MAIN NAVIGATION</li> -->
           <?php	if (Session('Role') == 'Trial') : ?>
           <li class="treeview">
               <a href="/Reports">
                   <i class="fa fa-bar-chart" ></i> <span>Reports</span>
               </a>
           </li>
           <li class="treeview">
               <a href="/Tags">
                   <i class="fa fa-edit" ></i> <span>Tag Generator</span>
               </a>
           </li>
           @if (Session('user_role') != 'Admin_user_manage')
           <li class="treeview">
               <a href="/BacktoPortfolio">
                   <i class="fa fa-arrow-left" ></i> <span>Portfolio</span>
               </a>
           </li>
           @endif
           <?php else : ?>
           <li class="treeview">
               <a href="/Reports">
                   <i class="fa fa-bar-chart" ></i> <span>Reports</span>
               </a>
           </li>
           <li class="treeview">
               <a href="/Audience">
                   <i class="fa fa-pie-chart"></i> <span>Audience</span>
               </a>
           </li>
           <li class="treeview">
               <a href="/leads">
                   <i class="fa fa-fw fa-dot-circle-o"></i><span> Leads</span>
               </a>
           </li>
           <li class="treeview">
               <a href="/Content">
                   <i class="fa fa-list-alt"></i> <span> Contents </span>
               </a>
           </li>
           <li class="treeview">
               <a href="/Channels">
                   <i class="fa fa-share-alt"></i> <span>Channels</span>
               </a>
           </li>
           <li class="treeview">
               <a href="/Campaigns">
                   <i class="fa fa-volume-up" ></i> <span>Campaigns</span>
               </a>
           </li>
           <li class="treeview">
               <a href="#">
                   <i class="fa fa-edit" ></i> <span>Tag Generator</span>
                   <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                   </span>
               </a>
               <ul class="treeview-menu">
                   <li><a href="#"><i class="fa fa-filter"></i> Organic </a></li>
                   <li><a href="#"><i class="fa fa-search"></i> Search Engine </a></li>
                   <li><a href="#"><i class="fa fa-envelope"></i> Email </a></li>
                   <li class="treeview">
                       <a href="#">
                           <i class="fa fa-mouse-pointer" ></i> <span> PPC </span>
                           <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                   </span>
                       </a>
                       <ul class="treeview-menu">
                           <li><a href="{{route('tag',['id1'=>'PPC', 'id2' => 'fbook'])}}"><i class="fa fa-circle-o"></i> Facebook </a></li>
                           <li><a href="{{route('tag',['id1'=>'PPC', 'id2' => 'google'])}}"><i class="fa fa-circle-o"></i> Google </a></li>
                           <li><a href="{{route('tag',['id1'=>'PPC', 'id2' => 'bing'])}}"><i class="fa fa-circle-o"></i> Bing </a></li>
                           <li><a href="{{route('tag',['id1'=>'PPC', 'id2' => 'yahoo'])}}"><i class="fa fa-circle-o"></i> Yahoo </a></li>
                       </ul>
                   </li>
                   <li><a href="#"><i class="fa fa-circle-o"></i> Affiliate </a></li>
                   <li class="treeview">
                       <a href="#">
                           <i class="fa fa-comments" ></i> <span> Social </span>
                           <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                   </span>
                       </a>
                       <ul class="treeview-menu">
                           <li><a href="#"><i class="fa fa-circle-o"></i> Facebook </a></li>
                           <li><a href="#"><i class="fa fa-circle-o"></i> Twitter </a></li>
                           <li><a href="#"><i class="fa fa-circle-o"></i> Linkedin </a></li>
                           <li><a href="#"><i class="fa fa-circle-o"></i> Youtube </a></li>
                       </ul>
                   </li>

               </ul>
           </li>
           @if (Session('user_role') != 'Admin_user_manage')
           <li class="treeview">
               <a href="/BacktoPortfolio">
                   <i class="fa fa-arrow-left" ></i> <span>Portfolio</span>

               </a>
           </li>
           @endif
           <?php endif; ?>

           @if (Session('user_role') == 'Admin_user_manage')
           <li class="treeview">
               <a href="/userManagement">
                   <i class="fa fa-arrow-left" ></i> <span>Back Admin</span>  
               </a>
           </li>
           @endif
        

       </ul>
       @endif
    </section>
    <!-- /.sidebar -->
  </aside>
