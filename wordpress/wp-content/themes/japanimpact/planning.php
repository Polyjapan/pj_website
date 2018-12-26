


<style media="screen">

#plannings {

}

table{
  text-align: center;
}

td {
  padding:5px;
  border:1px solid black;
  font-size:20px;
  /* min-width: 100px;
  max-width: 150px; */
}

td.offset {
  border:none;
}



th {
  font-size:20px;
  background:lightgrey;
  border:1px solid black;
  font-weight: bold;
  text-shadow:white 1px 1px 0px,white -1px 1px 0px,white 1px -1px 0px,white -1px -1px 0px;
}
</style>


<div id="plannings">

  <?php


  // obtain all necessary posts and get their slot time
  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'lang' => pll_current_language(),
    'category_name' => $categories_all,
    'date_query' => array(
      array(
        'after'     => array(
          'year'  => 2018,
          'month' => 6,
          'day'   => 1,
        ),
        'before'    => array(
          'year'  => 2019,
          'month' => 6,
          'day'   => 2,
        ),
        'inclusive' => true,
      ),
    ),
  );

  $arr_posts = new WP_Query( $args );
  if ( $arr_posts->have_posts() ) : while ( $arr_posts->have_posts() ) : $arr_posts->the_post();
  $str = get_the_content();
  $name = get_the_title();
  $id = get_the_ID();
  $color = $colors[get_the_category()[0]->slug];
  $meta = get_post_custom();

  //preg_match_all('/(?<=data\-planning\=\")[^\"]+(?=\")/', $str, $matches, PREG_OFFSET_CAPTURE);

  // // CORNER CASE : DOUBLE DATES --> split and create arrays
  $plan = $meta['class'][0];
  $day =  $meta['day'][0];
  $from =  $meta['from'][0];
  $to =  $meta['to'][0];
  $room =  $meta['room'][0];

  if(!empty($plan)) {

    // create slot array
    //foreach($matches[0] as $m){
    // auditoires,di,10:00,12:00,room5
    //list($plan, $day, $from, $to, $room) = preg_split ('/\,/', $m[0]);

    $date_to = strtotime($to);
    $date_from = strtotime($from);
    $int1 = $date_to - $date_from;
    $h = (int)date('H',$int1);
    $m = (int)date('i',$int1);
    $duration = $m/30 + 2*$h;

    $curr = $date_from;
    for($i = 0; $i < $duration-1; $i++){ // cancel rowspan -->  too much td
      $curr = date("H:i", strtotime("+30 minutes",$curr));
      array_push($planning[$day][$plan][$curr][$room], array(0, $name, $color, $id));
      $curr = strtotime($curr);
    }

    array_push($planning[$day][$plan][$from][$room], array($duration, $name, $color, $id));
    //}
  }

endwhile; endif;


?>

<div id="plannings">


  <?php
  $i = 0;
  foreach($planning as $day => $p) {

    foreach($p as $name => $plan) {
      // echo "<h1>" . $day . "</h1>";

      $day_title = $translation[$day][pll_current_language()];
      $color = $zone_colors[$name];

      ?>


      <table class="table" id="planning-<?php echo $i; ?>">

        <tr>
          <td class="offset"></td>
          <th  scope="col" colspan="<?php echo sizeof(reset($plan)); ?>"><?php echo  $day_title ?></th>
        </tr>
        <tr>
          <td class="offset"></td>
          <?php foreach(reset($plan) as $room=>$k){
            echo '<th style="background:'.$color.'" scope="col">'. $room . '</th>';
          } ?>
        </tr>

        <?php
        foreach($plan as $k=>$v){ // for each 30min
          echo '<tr>';

          $k1 = date("H:i",strtotime("+30 minutes", strtotime($k)));

          echo '<th scope="row">'. $k . " - " . $k1 .'</th>';
          foreach($v as $room){ // for each room
            if(empty($room)){ // for each non-empty activity
              echo '<td></td>';
            }
            else {
              if($room[0][0] != 0) { // condition on canceled td, otherwise display activity
                echo '<td style="background:'.$room[0][2].'" rowspan="'.$room[0][0].'">' . '<a href="#post-'.$room[0][3].'">' . $room[0][1] .'</a></td>';
              }
            }
          }
          echo '</tr>';
        }
        ?>

      </table>

      <?php
      $i++;
    }
  } ?>

</div>

<div id="buttons-planning">
  <?php

  $num = 0;
  for ($d=0; $d < sizeof($planning); $d++) {
    for ($i=1; $i <= sizeof($rooms); $i++) {
      $day = $translation[array_keys($planning)[$d]][pll_current_language()];
      $zone = array_keys($rooms)[$i-1];
      $color = $zone_colors[$zone];

      echo '<span style="background:'.$color.'" class="button-planning" id="planning-'.$num.'">'. $day .' - '. $zone .'</span>';
      $num++;
    }
  }
  ?>
  <!-- <span class="button-planning" id="planning-0">SAMEDI - 1</span>
  <span class="button-planning" id="planning-1">SA - 2</span>
  <span class="button-planning" id="planning-2">SAMEDI - 3</span>
  <span class="button-planning" id="planning-3">SA - 4</span>
  <span class="button-planning" id="planning-4">SAMEDI - 5</span>
  <span class="button-planning" id="planning-5">SA - 6</span>
  <span class="button-planning" id="planning-6">SAMEDI - 1</span>
  <span class="button-planning" id="planning-7">SA - 2</span> -->
</div>

</div>

<script type="text/javascript">

$(document).ready(function(){
  $(".table#planning-0 ").show();

  $(".button-planning").click(function(){


    $(".table").each(function(){$(this).hide();});

    var id = $(this).attr("id");
    console.log(id);
    $(".table#"+id).show();
  });

});
</script>
