<?php
/**
* Template Name: Program Page Copy
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

        <h1 class="category-title" style="color:<?php echo $colors[$c]; ?>"><?php echo $category_name; ?></h1>

        <div class="row category" style="border-color:<?php echo $colors[$c]; ?>">


          <?php

          if ( $arr_posts->have_posts() ) :

            while ( $arr_posts->have_posts() ) :
              $arr_posts->the_post();

              $meta = get_post_custom();
              ?>

              <div class="row article align-items-center" id="post-<?php the_ID(); ?>" <?php post_class(); ?>  style="border-color:<?php echo $colors[$c]; ?>">

                <?php
                if ( has_post_thumbnail() ) :
                  the_post_thumbnail();
                endif;
                ?>

                <div class="col-md-4">
                  <img src="  <?php echo $meta['img'][0]; ?>   " alt=""/>
                </div>

                <div class="col-md-8">

                  <h2 class="entry-title"  style="color:<?php echo $colors[$c]; ?>"><?php the_title(); ?></h2>


                  <span class="dates">
                    <?php

                    $day = $day_translation[$meta['day'][0]][pll_current_language()];
                    $at = (pll_current_language() == "en") ? " at " : " en ";

                    echo $day . "," . $meta['from'][0] . " - " . $meta['to'][0] . $at . $meta["room"][0];

                    ?>
                  </span>

                  <div class="entry-content">
                    <?php the_content(); ?>
                    <a href="<?php the_permalink(); ?>">Read More</a>
                  </div>


                </div>
              </div>
              <!--
            </div> -->
            <?php
          endwhile;
        endif;

        ?>

      </div>



      <?php
    }
    ?>
  </div>

</section>

<?php include("footer.php") ?>
