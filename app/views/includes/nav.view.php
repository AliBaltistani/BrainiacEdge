<?php

use \Model\Auth;

$categories = get_categories();
// $categories = get_categories_have_course();
// array_unique($categories,SORT_REGULAR);
// $categories = array_map("unserialize", array_unique(array_map("serialize", $categories)));




?>

<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <a href="<?= ROOT ?>" class="logo d-flex align-items-center">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="<?= ROOT ?>/zenblog/assets/img/logo.png" alt=""> -->
      <h1><?= APP_NAME ?></h1>
    </a>
    <nav id="navbar" class="navbar">
      <ul>
        <li class="dropdown mx-4 "><a href="#"><span>Courses</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
          <ul style="max-height:80vh; overflow-y:hidden; ">

            <?php if (!empty($categories)) : ?>
              <?php foreach ($categories as $cat) : ?>
                <li class="dropdown "><a href="<?= ROOT ?>/category/<?= $cat->slug ?>"><?= ucwords($cat->category) ?>  <i class="bi bi-chevron-right dropdown-indicator"></i></a>
               
                <ul style="max-height:80vh; overflow-y:hidden; margin-left:400px; ">
                  <li class="dropdown "><a href="">linl one</a></li>
                  <li class="dropdown "><a href="">linl two</a></li>
                </ul>
               </li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </li>

        <li>
          <div class="input-group">
            <div id="search-autocomplete" class="form-outline" data-mdb-input-init>
              <input type="search" id="form1" class="form-control" />
            </div>
          </div>
        <li>

        <li><a href="<?= ROOT ?>/competitions/all">Competitions</a></li>

      </ul>
    </nav><!-- .navbar -->

    <div class="position-relative">

      <nav id="navbar" class="navbar">
        <ul>

          <!-- <li  class="dropdown"> 
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 576 512"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
          </svg>
          <i class="bi bi-chevron-down dropdown-indicator"></i>
            <ul >
              <li><a href="/students/my-cart">my cart</a></li>
           </ul>
        </li> -->

          <?php if (!Auth::logged_in()) : ?>
            <li><a href="<?= ROOT ?>/login">Login</a></li>
            <li><a href="<?= ROOT ?>/signup">Signup</a></li>
          <?php else : ?>

            <li class="dropdown"><a href="#"><span>Hi, <?= Auth::getFirstname() ?></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                <?php if (Auth::is_admin()) { ?>
                  <li><a href="<?= ROOT ?>/admin/dashboard">Dashboard</a></li>
                  <li><a href="<?= ROOT ?>/admin/profile">Profile</a></li>
                  <li><a href="<?= ROOT ?>/logout">Logout</a></li>
                <?php } else if ((strtolower(Auth::getRole_name()) == 'student')) { ?>
                  <li><a href="<?= ROOT ?>/students/profile">Profile</a></li>
                  <li><a href="<?= ROOT ?>/logout">Logout</a></li>
                <?php } else if ((strtolower(Auth::getRole_name()) == 'instructor')) { ?>
                  <li><a href="<?= ROOT ?>/instructors/dashboard">Dashboard</a></li>
                  <li><a href="<?= ROOT ?>/instructors/profile">Profile</a></li>
                  <li><a href="<?= ROOT ?>/logout">Logout</a></li>
                <?php } else { ?>
                  <li><a href="<?= ROOT ?>/admin/profile">Profile</a></li>
                  <li><a href="<?= ROOT ?>/logout">Logout</a></li>
                <?php } ?>
              </ul>
            </li>
          <?php endif ?>
        </ul>
      </nav>


    </div>

  </div>



</header><!-- End Header -->

<main id="main">