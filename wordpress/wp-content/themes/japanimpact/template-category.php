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

                <div class="col-lg-4"  id="post-<?php the_ID(); ?>">

                  <?php

                  $dates = array();
                  $plan_array = array_map('trim', explode(",",$meta['class'][0]));
                  $day_array =  array_map('trim', explode(",",$meta['day'][0]));
                  $from_array =  array_map('trim', explode(",",$meta['from'][0]));
                  $to_array =  array_map('trim', explode(",",$meta['to'][0]));
                  $room_array =  array_map('trim', explode(",",$meta['room'][0]));

                  for ($i=0; $i < sizeof($day_array); $i++) {

                    $day = ucfirst($translation[$day_array[$i]][pll_current_language()]);
                    $at = $translation['at'][pll_current_language()];
                    $room = '<span class="room" style="background-color:'.$zone_colors[$plan_array[$i]].'">'.ucfirst($room_array[$i]).'</span>';
                    $date = $day . "," . $from_array[$i] . " - " . $to_array[$i] . " ". $at." " . $room;

                    array_push($dates,$date);
                  }

                  $dates = implode("<br>", $dates);

                  ?>

                  <div class="grid">
                    <figure class="effect-honey">
                      <img src="<?php echo $meta['img'][0]; ?>" alt="<?php the_title(); ?>"/>
                      <figcaption class="<?php echo $c ?>">
                        <h2><?php the_title(); ?> <i>
                          <?php

                            echo $dates;
                            ?>
                        </i></h2>
                        <a href="<?php the_permalink(); ?>">View more</a>
                      </figcaption>
                    </figure>
                  </div>


                </div>

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
