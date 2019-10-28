<template>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <!-- SEARCH FORM -->

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link btn-navbar" data-widget="pushmenu" href="#">
            <i class="fa fa-bars"></i>
          </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href></a>
          <router-link :to="{name:'Dhome'}" class="nav-link">
            <p>Home</p>
          </router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input
            class="form-control form-control-navbar"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <!-- Right navbar links -->

      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-comments-o"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src alt="User Avatar" class="img-size-50 mr-3 img-circle" />
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger">
                      <i class="fa fa-star"></i>
                    </span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted">
                    <i class="fa fa-clock-o mr-1"></i> 4 Hours Ago
                  </p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src alt="User Avatar" class="img-size-50 img-circle mr-3" />
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted">
                      <i class="fa fa-star"></i>
                    </span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted">
                    <i class="fa fa-clock-o mr-1"></i> 4 Hours Ago
                  </p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src alt="User Avatar" class="img-size-50 img-circle mr-3" />
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning">
                      <i class="fa fa-star"></i>
                    </span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted">
                    <i class="fa fa-clock-o mr-1"></i> 4 Hours Ago
                  </p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell-o"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fa fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <div id="app">
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img
            src
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8"
          />
          <span class="brand-text font-weight-light">MANAGE</span>
        </a>
        <!-- Sidebar -->

        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info"></div>
          </div>
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
              data-accordion="false"
            >
              <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library-->
              <li class="nav-item">
                <router-link to="/admin" class="nav-link">
                  <i class="nav-icon fa fa-tachometer-alt cyan"></i>
                  <p>Dashboard</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/profile" class="nav-link">
                  <i class="nav-icon fa fa-user orange"></i>
                  <p>Profile</p>
                </router-link>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-cogs red"></i>
                  <p>
                    Setting
                    <i class="right fa fa-angle-left btn-dropdown"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <router-link :to="{name:'Slide'}" class="nav-link">
                      <i class="fa fa-images blue"></i>
                      <p>Slide</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link :to="{name:'Coupon'}" class="nav-link">
                      <i class="fa fa-images blue"></i>
                      <p>Coupon</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link :to="{name:'SizeandColor'}" class="nav-link">
                      <i class="fa fa-images blue"></i>
                      <p>Size and Color</p>
                    </router-link>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-image green"></i>
                  <p>logo</p>
                </a>
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-cog red"></i>
                  <p>
                    Management
                    <i class="right fa fa-angle-left btn-dropdown"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <router-link :to="{name:'User'}" class="nav-link">
                      <i class="fa fa-users blue"></i>
                      <p>User</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link :to="{name:'Product'}" class="nav-link">
                      <i class="fa fa-users blue"></i>
                      <p>Product</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link :to="{name:'Category'}" class="nav-link">
                      <i class="fa fa-users blue"></i>
                      <p>Category</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link :to="{name:'RolePermision'}" class="nav-link">
                      <i class="fa fa-users blue"></i>
                      <p>Role Permission</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link :to="{name:'Order'}" class="nav-link">
                      <i class="fa fa-users blue"></i>
                      <p>Order</p>
                    </router-link>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a class="nav-link">
                  <i class="nav-icon fa fa-power-off teal"></i>
                </a>
                <form id="logout-form" action method="POST" style="display: none;"></form>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col col-12">
                <router-view></router-view>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
      </div>

      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
    </div>
    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">Anything you want</div>
      <strong>
        Copyright &copy;
        <a href>h</a>.
      </strong> All rights reserved.
    </footer>
  </div>
</template>

<script>
import $ from "jquery";
$(function() {
  $(".has-treeview").click(function() {
    if ($(this).hasClass("active")) {
      $(".btn-dropdown ").addClass("fa-angle-left");
      $(".btn-dropdown ").removeClass("fa-angle-down");
      $(".nav-treeview").fadeOut();
      $(this).removeClass("active");
    } else {
      $(this).addClass("active");
      $(".btn-dropdown ").removeClass("fa-angle-left");
      $(".btn-dropdown ").addClass("fa-angle-down");
      $(".nav-treeview").fadeIn();
    }
  });
  $(".btn-navbar").click(function() {
    $(".main-sidebar").toggle();
  });
});
export default {
  name: "Dashboard",
  data() {
    return {};
  },
  methods: {
    showMenuBar() {
      $("#menu-sidebar").toggle();
    }
  }
};
</script>

<style>
</style>
