<?php
/**
 * Template Name: Program Page
 */

 include("settings.php");
 ?>

 <?php include("head.php"); ?>
 <body>



   <?php include("header.php"); ?>

<section>

<?php include("planning.php") ?>


 <?php


foreach ($category_slugs as $c) {

 $args = array(
     'post_type' => 'post',
     'post_status' => 'publish',
     'lang' => pll_current_language(),
     'category_name' => $c,
   );

 $arr_posts = new WP_Query( $args );

?>

<div class="category">

<?php

 if ( $arr_posts->have_posts() ) :

     while ( $arr_posts->have_posts() ) :
         $arr_posts->the_post();
         ?>
         <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
             <?php
             if ( has_post_thumbnail() ) :
                 the_post_thumbnail();
             endif;
             ?>
             <header class="entry-header">
                 <h1 class="entry-title"><?php the_title(); ?></h1>
             </header>
             <div class="entry-content">
                 <?php the_content(); ?>
                 <a href="<?php the_permalink(); ?>">Read More</a>
             </div>
         </article>
         <?php
     endwhile;
 endif;

?>

</div>

<?php
}
 ?>

</section>

  <?php include("footer.php") ?>
