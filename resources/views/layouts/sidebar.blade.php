 <!-- /.header -->
 <div class="content margin-top-60">

     <div class="navigation">
         <h5 class="title">Navigation</h5>
         <!-- /.title -->
         <ul class="menu js__accordion">
             <li @if (Request::is('dashboard')) class="current" @endif>
                 <a class="waves-effect" href="{{ route('dashboard') }}">
                     <i class="menu-icon fa fa-home"></i>
                     <span>Dashboard</span>
                 </a>
             </li>
             <li @if (Request::is('branch')) class="current" @endif>
                 <a class="waves-effect" href="{{ route('branch.index') }}">
                     <i class="menu-icon fa fa-building"></i>
                     <span>Branches</span>
                 </a>
             </li>
             <li>
                 <a class="waves-effect" href="#">
                     <i class="menu-icon fa fa-puzzle-piece"></i>
                     <span>Project</span>
                 </a>
             </li>
         </ul>
     </div>
     <!-- /.navigation -->
 </div>
 <!-- /.content -->
