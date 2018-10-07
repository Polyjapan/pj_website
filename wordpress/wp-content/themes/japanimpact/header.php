
<header>

  <div class="poster">


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Japan Impact</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <!-- <?php include("menu-example.php") ?> -->
          <?php

          wp_nav_menu( array(
          'theme_location' => 'header-menu',
          // 'container-class'=> 'collapse navbar-collapse',
          // 'items_wrap' => '<ul id="%1$s" class="navbar-nav">%3$s</ul>',
          // 'before'=>'<li class="nav-item">',
          // 'after'=>'</li>',
         ) );


        ?>

        <script type="text/javascript">
          // $(".sub-menu").hide();
          // $("li").on("mouseover", function(e){
          //   e.preventDefault();
          //   $(this).find("ul").toggle();
          // });
        </script>
    </div>
  </nav>
  <div id="ji_header">

    <img alt="header" src="<?php header_image(); ?>"/>

  </div>
</div>
<div id="logo">
  <img src="https://japan-impact.ch/wp-content/uploads/2018/09/jilogo_nohead-small.png" alt="logo"/>
</div>

</header>
