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

    <div class="container">


      <?php


      foreach ($category_slugs as $c) {

        $args = array(
          'post_type' => 'post',
          'post_status' => 'publish',
          'lang' => pll_current_language(),
          'category_name' => $c,
        );


        $arr_posts = new WP_Query( $args );


        $category_name = get_category_by_slug( $c )->name;


        ?>

        <h2 class="category-title" style="color:<?php echo $colors[$c]; ?>"><?php echo $category_name; ?></h2>

        <div class="category" style="border-color:<?php echo $colors[$c]; ?>">


          <?php

          if ( $arr_posts->have_posts() ) :

            ?>

            <div class="row article align-items-center" <?php post_class(); ?>  style="border-color:<?php echo $colors[$c]; ?>">

              <?php

              while ( $arr_posts->have_posts() ) :
                $arr_posts->the_post();

                $meta = get_post_custom();
                ?>


                <?php
                if ( has_post_thumbnail() ) :
                  the_post_thumbnail();
                endif;
                ?>

                <div class="col-md-4"  id="post-<?php the_ID(); ?>">

                    <img src="  <?php echo $meta['img'][0]; ?>   " alt=""/>

                  <h3 class="entry-title"  style="color:<?php echo $colors[$c]; ?>"><?php the_title(); ?></h3>


                  <span class="dates">
                    <?php

                    $day = $day_translation[$meta['day'][0]][pll_current_language()];
                    $at = (pll_current_language() == "en") ? " at " : " en ";

                    echo $day . "," . $meta['from'][0] . " - " . $meta['to'][0] . $at . $meta["room"][0];

                    ?>
                  </span>

                  <div class="entry-content">
                    <?php echo wp_trim_words( get_the_content(), 10, '...' ); ?>
                    <a href="<?php the_permalink(); ?>">Read More</a>
                  </div>


                </div>
                <!--
              </div> -->
              <?php
            endwhile;
            ?>
          </div>
          <?php
        endif;
        ?>

      </div>



      <?php
    }
    ?>

  </div>

</section>

<?php include("footer.php") ?>
