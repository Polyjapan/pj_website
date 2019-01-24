<?php
include("settings.php");
include("head.php");
?>

<body>

  <?php get_header(); ?>

  <section id="home">

    <div id="date" class="">

            <div class="bandeau">
              <?php echo $translation["dates"][pll_current_language()] ?>
              <span class="date_h"><?php echo $translation["dates_sa"][pll_current_language()] ?><span class="space"></span><?php echo $translation["dates_di"][pll_current_language()] ?></span>
            </div>

      <div id="countdown">

        <div>
          <span class="nb" id="days">123</span>
          <span class="word"><?php echo $translation["countdown-d"][pll_current_language()] ?></span>
        </div>
        <div>
          <span class="nb" id="hours">123</span>
          <span class="word"><?php echo $translation["countdown-h"][pll_current_language()] ?></span>
        </div>
        <div>
          <span class="nb" id="minutes">123</span>
          <span class="word"><?php echo $translation["countdown-m"][pll_current_language()] ?></span>
        </div>
        <div>
          <span class="nb" id="seconds">123</span>
          <span class="word"><?php echo $translation["countdown-s"][pll_current_language()] ?></span>
        </div>
      </div>
    </div>

<div class="container">


  <?php

  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'lang' => pll_current_language(),
    'posts_per_page' => 6,
    'paged' => $paged,
    'category__not_in' => $interdit_id
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
    <?php $arr_posts->the_posts_pagination( array( 'mid_size'  => 2 ) ); ?>

    <?php
  endif;

  ?>


  </div>

  </section>
<script type="text/javascript">
// Set the date we're counting down to

if(document.getElementById("days") != undefined){
  var countDownDate = new Date(<?php echo $saturday_date ?>).getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("days").innerHTML = days;
    document.getElementById("hours").innerHTML = hours;
    document.getElementById("minutes").innerHTML = minutes;
    document.getElementById("seconds").innerHTML = seconds;

    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
    }
  }, 1000);
}

</script>

  <?php get_footer(); ?>
