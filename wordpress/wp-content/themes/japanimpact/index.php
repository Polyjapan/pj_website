<?php include("settings.php") ?>
<?php include("head.php"); ?>
<body>

  <?php include("header.php"); ?>

  <section id="home">

    <div id="date" class="">

      <div class="bandeau">
        16 et 17 Février 2019
      </div>

      <script type="text/javascript">
      // Set the date we're counting down to
      var countDownDate = new Date("Feb 16, 2019 8:00:00").getTime();

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

      </script>

      <div id="countdown">

        <div>
          <span class="nb" id="days">123</span>
          <span class="word">days</span>
        </div>
        <div>
          <span class="nb" id="hours">123</span>
          <span class="word">hours</span>
        </div>
        <div>
          <span class="nb" id="minutes">123</span>
          <span class="word">minutes</span>
        </div>
        <div>
          <span class="nb" id="seconds">123</span>
          <span class="word">seconds</span>
        </div>
      </div>
    </div>

    <!--
    <h2>Mockup:
    https://drive.google.com/drive/u/2/folders/1C6q4jm98VGwKroqduDY2cOTpXdOi8tgx
  </h2>
-->

<div class="container">


  <?php




  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'lang' => pll_current_language()
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
            <div class="entry-content">
              <?php echo wp_trim_words( get_the_content(), 110, '...' ); ?>
              <a href="<?php the_permalink(); ?>"><?php echo $translation["more"][pll_current_language()] ?></a>
            </div>

          </div>
        </div>

      </article>
      <?php
    endwhile;
  endif;

  ?>


</div>

</section>

<br>
<br>

<?php include("footer.php") ?>
