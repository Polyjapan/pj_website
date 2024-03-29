<br>
<br>
<br>
 <a target="_blank" id="download_link" href="https://japan-impact.ch/wp-content/uploads/2019/02/program_sa_a4-merged-2.pdf">
  <h3 style="text-align:center">>> <?php echo $translation["sa"][pll_current_language()]. " : ".$translation["download"][pll_current_language()] ; ?> <<
  </h3>
</a>
<a target="_blank" id="download_link" href="https://japan-impact.ch/wp-content/uploads/2019/02/program_di_a4-merged-2.pdf">
  <h3 style="text-align:center">
    >> <?php echo $translation["di"][pll_current_language()]." : ".  $translation["download"][pll_current_language()] ; ?> <<
  </h3>
</a> 
<br>

<h3 style="color:red;text-transform:uppercase;text-align:center;">Sous réserve de modifications !! // Subject to change!!</h3>

<br>

<div id="plannings">

  <?php

  // obtain all necessary posts and get their slot time
  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'lang' => pll_current_language(),
    'category_name' => $categories_all .",". $interdit_category,
    // 'date_query' => array(
    //   array(
    //     'after'     => array(
    //       'year'  => 2018,
    //       'month' => 6,
    //       'day'   => 1,
    //     ),
    //     'before'    => array(
    //       'year'  => 2019,
    //       'month' => 5,
    //       'day'   => 2,
    //     ),
    //     'inclusive' => true,
    //   ),
    // ),
  );

  $arr_posts = new WP_Query( $args );

  if ( $arr_posts->have_posts() ) : while ( $arr_posts->have_posts() ) : $arr_posts->the_post();
  $str = get_the_content();
  $name = get_the_title();
  $id = get_the_ID();

  $color = "black";
  $i=0;
  do  {
    $color = $colors[get_the_category()[$i]->slug];
    $i++;
  } while(empty($color) || $i > sizeof(get_the_category())) ;

  $meta = get_post_custom();

  $plan_array = array_map('trim', explode(",",$meta['class'][0]));
  $day_array =  array_map('trim', explode(",",$meta['day'][0]));
  $from_array =  array_map('trim', explode(",",$meta['from'][0]));
  $to_array =  array_map('trim', explode(",",$meta['to'][0]));
  $room_array =  array_map('trim', explode(",",$meta['room'][0]));


  $is_complete = (strlen($plan_array[0])!=0) && (strlen($day_array[0])!=0) && (strlen($from_array[0])!=0) && (strlen($to_array[0])!=0) && (strlen($room_array[0])!=0);

  if(!empty($plan_array) && $is_complete) {

    for ($p=0; $p < sizeof($plan_array); $p++) {
      $plan = strtolower($plan_array[$p]);
      $day = strtolower($day_array[$p]);
      $from = $from_array[$p];
      $to = $to_array[$p];
      $room = strtolower($room_array[$p]);


      $date_to = strtotime($to);
      $date_from = strtotime($from);
      $int1 = $date_to - $date_from;
      $h = (int)date('H',$int1);
      $m = (int)date('i',$int1);
      $duration = $m/15 + 4*$h;

      $curr = $date_from;

      for($i = 0; $i < $duration-1; $i++){ // cancel rowspan -->  too much td
        $curr = date("H:i", strtotime("+15 minutes",$curr));

        array_push($planning[$day][$plan][$curr][$room], array(0, $name, $color, $id));
        $curr = strtotime($curr);
      }

      array_push($planning[$day][$plan][$from][$room], array($duration, $name, $color, $id));

    }
  }

endwhile; endif;
?>

<div id="plannings">

  <?php

  $i = 0;
  foreach($planning as $day => $p) {

    $day_title = $translation[$day][pll_current_language()];

    foreach($p as $name => $plan) {

      $color = $zone_colors[$name];

      $maximum = array();


      // get max of activity in the same time in the same room

      foreach($plan as $k=>$v){
        foreach($v as $k1=>$v1){
          $maximum[$k1] = 1;
        }
      }

      foreach($plan as $k=>$v){
        foreach($v as $k1=>$v1){
          $size = sizeof($v1);
          // var_dump($size);
          if($maximum[$k1] < $size){
            $maximum[$k1]=$size;
          }
        }
      }

      ?>

      <table class="table" id="planning-<?php echo $i; ?>">

        <tr>
          <td class="offset"></td>
          <th class="table-day" scope="col" colspan="<?php echo array_sum($maximum); ?>"><?php echo  $day_title ?></th>
        </tr>
        <tr>
          <td class="offset"></td>
          <?php


          foreach(reset($plan) as $room=>$k){
            echo '<th class="room" style="background:'.$color.'" scope="col" colspan="'. $maximum[$room] .'">'. $room . '</th>';
          } ?>
        </tr>

        <?php
        foreach($plan as $k=>$v){ // for each 15min
          echo '<tr>';

          $k1 = date("H:i",strtotime("+30 minutes", strtotime($k)));

          $k2 = date('i',strtotime($k));
          if($k2==30 || $k2==00){
            echo '<th class="table-hour" scope="row" rowspan="2">'. $k . " - " . $k1 .'</th>';
          }


          foreach($v as $k1=>$room){ // for each room
            for ($a=0; $a < $maximum[$k1]; $a++) {
              if(empty($room[$a])){ // for each empty activity
                echo '<td></td>';
              }
              else {

                if($room[$a][0] != 0) { // condition on canceled td, otherwise display activity ---> display only on first td

                  echo '<td style="background:'.$room[$a][2].'" rowspan="'.$room[$a][0].'">' . '<a href="#post-'.$room[$a][3].'">' . $room[$a][1] .'</a></td>';
                }
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

<p class="text-center"><strong><?php echo $translation["planning"][pll_current_language()] ?></strong> </p>

<div id="buttons-planning">


  <?php

  $num = 0;
  for ($d=0; $d < sizeof($planning); $d++) {
    $day = $translation[array_keys($planning)[$d]][pll_current_language()];
    echo '<div class="row justify-content-md-center mb-2 mt-2">';

    echo '<div class="col-sm-1">';
    echo '<span class="day">' . $day . '</span>' ;
    echo '</div>';
    for ($i=1; $i <= sizeof($rooms); $i++) {
      $zone = array_keys($rooms)[$i-1];
      $color = $zone_colors[$zone];

      echo '<div class="col-sm-1">';
      echo '<span style="background:'.$color.'" class="button-planning" id="planning-'.$num.'" onclick="buttonClick(this)">'. $translation[$zone][pll_current_language()] .'</span>';
      echo '</div>';
      $num++;
    }
    echo '</div>';
  }
  ?>

</div>

</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/planning.js' ?>"></script>
