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


          <div class="row mb-2 mt-12">
            <div class="col-sm-12">

              <img class="article_img" src="  <?php echo get_post_custom()['img'][0]; ?>   " alt=""/>

            </div>
          </div>

          <h2><?php the_title('<h1 class="entry-title">', '</h1>'); ?></h2>
          
          <span class="date"><?php the_date(); ?></span>

          <div class="row mb-2 mt-12">
            <div class="col-sm-12">
              <?php the_content(); ?>
            </div>
          </div>

          <?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>


          <?php

        endwhile;

        ?>

      </div>
    </div>


  </section>

  <?php include("footer.php") ?>
