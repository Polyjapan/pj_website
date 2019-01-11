<?php
include("settings.php");
include("head.php");
?>

<body>

  <?php get_header(); ?>

  <section id="category">

    <div class="container">

      <header class="entry-header">
        <?php echo '<h1 class="entry-title">' .get_queried_object()->name . '</h1>'; ?>
        <?php echo category_description( get_queried_object()->term_id ); ?>
      </header><!-- .entry-header -->

      <?php

      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

      $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'lang' => pll_current_language(),
        'posts_per_page' => 6,
        'paged' => $paged,
        'cat' => get_queried_object()->term_id,
        'orderby'=> 'title', 'order' => 'ASC'
      );

      $arr_posts = new WP_Query( $args );


      if ( $arr_posts->have_posts() ) :

        while ( $arr_posts->have_posts() ) :
          $arr_posts->the_post();
          $meta = get_post_custom();
          ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="row mt-25 mb-25">
              <div class="col-md-4">
                <img class="" src="  <?php echo $meta['img'][0]; ?>   " alt=""/>
              </div>

              <div class="col-md-8">
                <?php
                if ( has_post_thumbnail() ) :
                  the_post_thumbnail();
                endif;
                ?>
                <header class="entry-header">
                  <h2 class="entry-title"><?php the_title(); ?></h2>
                </header>
                <span class="date"><?php echo get_the_date(); ?></span>
                <div class="entry-content">
                  <?php echo wp_trim_words( get_the_content(), 110, '...' ); ?>
                  <a href="<?php the_permalink(); ?>"><?php echo $translation["more"][pll_current_language()] ?></a>
                </div>

              </div>
            </div>

          </article>
          <?php
        endwhile;
        ?>
        <?php the_posts_pagination( array( 'mid_size'  => 2 ) ); ?>

        <?php
      endif;

      ?>


    </div>

  </section>

  <br>
  <br>

  <?php get_footer(); ?>
