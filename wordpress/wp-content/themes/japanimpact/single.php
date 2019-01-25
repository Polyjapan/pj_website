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


          <span class="schedule">
            <?php
            $dates = array();
            $meta = get_post_custom();

            $plan_array = array_map('trim', explode(",",$meta['class'][0]));
            $day_array =  array_map('trim', explode(",",$meta['day'][0]));
            $from_array =  array_map('trim', explode(",",$meta['from'][0]));
            $to_array =  array_map('trim', explode(",",$meta['to'][0]));
            $room_array =  array_map('trim', explode(",",$meta['room'][0]));

            for ($i=0; $i < sizeof($day_array); $i++) {

              $day = ucfirst($translation[strtolower($day_array[$i])][pll_current_language()]);
              $at = $translation['at'][pll_current_language()];
              $room = '<span class="room" style="background-color:'.$zone_colors[strtolower($plan_array[$i])].'">'.ucfirst(strtolower($room_array[$i])).'</span>';
              $date = '<i class="fas fa-angle-double-right"></i> ' . $day . "," . $from_array[$i] . " - " . $to_array[$i] . " ". $at." " . $room;

              array_push($dates,$date);
            }

            $dates = implode("<br>", $dates);

            echo $dates . "<br/><br/>";


            ?>
          </span>


          <div class="row mb-2 mt-12">
            <div class="col-sm-12">
              <?php the_content(); ?>

              <br><br>
              <span class="date"><?php the_date(); ?></span>
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
