<header>

  <?php include('settings.php') ?>

  <div class="poster">

    <!--
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Japan Impact</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown"> -->

  <nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">

    <!-- Brand and toggle get grouped for better mobile display -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <a class="navbar-brand" href="#">Japan Impact</a> -->

    <?php

    wp_nav_menu( array(
      'theme_location'  => 'header-menu',
      'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
      'container'       => 'div',
      'container_class' => 'collapse navbar-collapse',
      'container_id'    => 'bs-example-navbar-collapse-1',
      'menu_class'      => 'navbar-nav mr-auto',
      'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
      'walker'          => new WP_Bootstrap_Navwalker(),
    ) );


    ?>


  </nav>


  <div id="ji_header">

    <img alt="header" src="<?php echo $HEADER_LINK; ?>"/>

  </div>
</div>
<div id="logo">
  <img src="<?php echo $LOGO_URL ?>" alt="logo"/>
</div>

</header>
