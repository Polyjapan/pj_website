<?php
/**
* Template Name: Program Page
*/

include("settings.php");
?>

<?php include("head.php"); ?>
<body>



  <?php include("header.php"); ?>


  <div class="container">
  <div class="row justify-content-md-center">
    <div class="col col-lg-2">
      1 of 3
    </div>
    <div class="col-md-auto">
      Variable width content
    </div>
    <div class="col col-lg-2">
      3 of 3
    </div>
  </div>
  <div class="row">
    <div class="col">
      1 of 3
    </div>
    <div class="col-md-auto">
      Variable width content
    </div>
    <div class="col col-lg-2">
      3 of 3
    </div>
  </div>
</div>


  <section>


    <div class="category">

      <?php
      while ( have_posts() ) :
        the_post();

        ?>
        <h2><?php the_title(); ?></h2>
        <?php
        the_content();

      endwhile;

      ?>

    </div>


  </section>

  <?php include("footer.php") ?>
