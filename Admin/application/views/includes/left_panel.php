 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">Admin
        </div>
        <div class="pull-left info">
          <p> <?php echo ucwords($_SESSION[session_name]['user_id']); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">

      	<!-- DASHBOARD -->
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i><span>&nbsp;Dashboard</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-th-list"></i>
            <span>Manage Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('Categories/index');?>"><i class="fa fa-circle-o"></i>Category</a></li>
            <!-- <li><a href="<?= site_url('Roles/index');?>"><i class="fa fa-circle-o"></i>Role</a></li>
            <li><a href="<?= site_url('Functionalities/index');?>"><i class="fa fa-circle-o"></i><span>Functionalities</span></a></li>
            <li><a href="<?= site_url('Organizations/index');?>"><i class="fa fa-circle-o"></i>Organization</a></li> -->
             <li><a href="<?= site_url('Faqs/index');?>"><i class="fa fa-circle-o"></i>FAQ</a></li>
             <li><a href="<?= site_url('Settings/index');?>"><i class="fa fa-circle-o"></i>Setting</a></li>
             <li><a href="<?= site_url('SpMasters/index');?>"><i class="fa fa-circle-o"></i>Species Master</a></li>
             <li><a href="<?= site_url('SpTypes/index');?>"><i class="fa fa-circle-o"></i>Species Mapping</a></li>
             <li><a href="<?= site_url('CommonName/index');?>"><i class="fa fa-circle-o"></i>Species Common Name</a></li>
             <li><a href="<?= site_url('Teams/index');?>"><i class="fa fa-circle-o"></i>Team</a></li>
             <li><a href="<?= site_url('Licenses/index');?>"><i class="fa fa-circle-o"></i>Manage License</a></li>
             <li><a href="<?= site_url('DynamicRewards/index');?>"><i class="fa fa-circle-o"></i>Dynamic Reward System</a></li>
             <li><a href="<?= site_url('DynamicRWeightage/index');?>"><i class="fa fa-circle-o"></i>Dynamic Reward Weightage</a></li>
             <li><a href="<?= site_url('ProjectCMaster/index');?>"><i class="fa fa-circle-o"></i>Project Column Master</a></li>
          </ul>
        </li> 
        <li><a href="<?= site_url('Layers/index');?>"><i class="glyphicon glyphicon-collapse-up"></i>
<span>Layer Configuration</span></a></li>   
        <li><a href="<?= site_url('Users/index');?>"><i class="glyphicon glyphicon-user"></i><span>User Managment System</span></a></li>
        <li><a href="<?= site_url('Duploads/index');?>"><i class="glyphicon glyphicon-user"></i><span>Data Upload Taxonomy</span></a></li>
        <li><a href="<?= site_url('Cexperts/index');?>"><i class="glyphicon glyphicon-plus"></i><span>Consortium of Experts</span></a></li>
        <li><a href="<?= site_url('Feedbacks/index');?>"><i class="glyphicon glyphicon-cog"></i><span>Feedback System</span></a></li>
         <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-th-list"></i>
            <span>Manage Project</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('Projects/index');?>"><i class="fa fa-folder"></i>Project Detail</a></li>
            <li><a href="<?= site_url('ProjectMappings/index');?>"><i class="fa fa-map-o"></i>Project Mapping</a></li>
            <li><a href="<?= site_url('ProjectColumns/index');?>"><i class="fa fa-map-signs"></i><span>Project Column</span></a></li>
            <li><a href="<?= site_url('ProjectValues/index');?>"><i class="fa fa-minus-circle"></i>Project Value</a></li>
             
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-th-list"></i>
            <span>Manage Blog System</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('Blogs/index');?>"><i class="glyphicon glyphicon-asterisk"></i><span></span>Blog</a></li>
            <li><a href="<?= site_url('BlogReplies/index');?>"><i class="fa fa-reply-all"></i>Blog Reply</a></li>
            <li><a href="<?= site_url('BlogResourses/index');?>"><i class="fa fa-external-link-square"></i><span>Blog Resourses</span></a></li>
            <li><a href="<?= site_url('Likes/index');?>"><i class="fa fa-thumbs-up"></i><span>Blog Like</span></a></li>
            <li><a href="<?= site_url('Tags/index');?>"><i class="fa fa-exchange"></i><span>Blog Tag</span></a></li>
            </ul>
        </li> 
      
         <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-th-list"></i>
            <span>Manage Discussion forum</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('Dforums/index');?>"><i class="fa fa-circle-o"></i>Discussion forum</a></li>
            <li><a href="<?= site_url('DResponses/index');?>"><i class="fa fa-circle-o"></i>Discussion Response</a></li>                  
          </ul>
        </li> 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>