<?php
/**
* Template Name: Program Page
*/

include("settings.php");
?>

<?php include("head.php"); ?>
<body>



  <?php include("header.php"); ?>

  <section id="article">

          <div class="container">

    <div class="category">

      <?php
      while ( have_posts() ) :
        the_post();

        ?>
        <h2><?php the_title('<h1 class="entry-title">', '</h1>'); ?></h2>
        <?php
        the_content();

      endwhile;

      ?>

          </div>
              </div>


  </section>

  <?php include("footer.php") ?>
