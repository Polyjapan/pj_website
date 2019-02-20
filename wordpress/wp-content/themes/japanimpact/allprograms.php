<?php
include("settings.php");
?>

<style>

@font-face {
  font-family: primaryFont;
  src: url(fonts/FRABK.TTF); }
  *{
    font-family: arial;
    font-size: 40px;
  }
  #plannings {
    display: block;
    width:99%;

  }
  #plannings #buttons-planning {
    text-align: center;
    font-size: 1.2em;
  }

  #plannings #buttons-planning .day {
    font-weight: bold;
    text-transform: capitalize;
  }

  #plannings .table-div{
    height:3072px;
      /* height:3072px; */
    padding-top:100px;
    border:1px solid red;
    /* width:100%; */
  }

  #plannings table {
    text-align: center;
    width:100%;
    margin-bottom:50px;
  }
  #plannings td {
    padding: 20px 50px;
    border: 1px solid black;
    font-size: 20px;
    height:55px;
    vertical-align: middle;
  }
  #plannings td.red {
    height:30px;
  }
  #plannings td a {
    color: white;
    text-transform: lowercase;
    font-family: primaryFont, arial, sans-serif;
    font-size: 4.3em;
    text-decoration: none;
  }
  #plannings td.offset {
    border: none;
  }

  #plannings th {
    font-size: 2.2em;
    background: lightgrey;
    border: 1px solid black;
    font-weight: bold;
    color: black;
    text-transform: uppercase;
    vertical-align: middle;
    height:60px;
  }

#plannings th.red, #plannings th.red.table-hour {
  font-size: 1.5em;
}

  #plannings th.table-hour {
    font-size: 2.0em;
    width:12%;
    padding:10px 0;
  }
  #plannings th.room {
    color: white;
    text-shadow: black 1px 1px 0px,black -1px 1px 0px,black 1px -1px 0px,black -1px -1px 0px;
  }

  </style>

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

    $new_name = "";
    $name = explode(" ",$name);
    for ($w=0; $w < sizeof($name); $w++) {
      $new_name .= $name[$w] . " ";
      if($w!=0 && $w%3==0 && $w+1 != sizeof($name)){
        $new_name .= "<br>";
      }
    }
    $name = $new_name;


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

                $duration_max = (20-11) * 4;
                        $duration_max_1 = (18-11) * 4;

        if($duration == $duration_max || $duration == $duration_max_1){
          continue;
        }

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

        <div class="table-div">

        <table class="table" id="planning-<?php echo $i; ?>">

          <tr>
            <td class="offset"></td>
            <th class="table-day" scope="col" colspan="<?php echo array_sum($maximum); ?>"><?php echo  $day_title ?></th>
          </tr>
          <tr>
            <td class="offset"></td>
            <?php


            foreach(reset($plan) as $room=>$k){
              echo '<th class="room '.$name.'" style="background:'.$color.'" scope="col" colspan="'. $maximum[$room] .'">'. $room . '</th>';
            } ?>
          </tr>

          <?php
          foreach($plan as $k=>$v){ // for each 15min
            echo '<tr>';

            $k1 = date("H:i",strtotime("+30 minutes", strtotime($k)));

            $k2 = date('i',strtotime($k));
            if($k2==30 || $k2==00){
              echo '<th class="table-hour '.$name.'" scope="row" rowspan="2">'. $k . " - " . $k1 .'</th>';
            }


            foreach($v as $k1=>$room){ // for each room
              for ($a=0; $a < $maximum[$k1]; $a++) {
                if(empty($room[$a])){ // for each empty activity
                  echo '<td class="'.$name.'"> </td>';
                }
                else {

                  if($room[$a][0] != 0) { // condition on canceled td, otherwise display activity ---> display only on first td

                    echo '<td class="'.$name.'" style="background:'.$room[$a][2].'" rowspan="'.$room[$a][0].'">' . '<a href="#post-'.$room[$a][3].'">' . $room[$a][1] .'</a></td>';
                  }
                }
              }
            }
            echo '</tr>';
          }
          ?>

        </table>
      </div>

        <?php
        $i++;
      }
    } ?>

  </div>


</div>
