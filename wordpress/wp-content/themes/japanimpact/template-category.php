<?php
/**
 * Template Name: Program Page
 */
 ?>

 <?php include("head.php"); ?>
 <body>



   <?php include("header.php"); ?>



 <?php
 // CATEGORIES SELECTION
if(pll_current_language() == "fr") $category_slugs = "martial-arts, projections";
else $category_slugs = "martial-arts-en, projections-en";

 $args = array(
     'post_type' => 'post',
     'post_status' => 'publish',
     'lang' => pll_current_language(),
     'category_name' => $category_slugs,
   );

 $arr_posts = new WP_Query( $args );


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
                 <?php the_excerpt(); ?>
                 <a href="<?php the_permalink(); ?>">Read More</a>
             </div>
         </article>
         <?php
     endwhile;
 endif;

?>


  <?php include("footer.php") ?>
