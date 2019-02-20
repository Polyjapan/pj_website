<?php
/**
* Template Name: Programme Generation HTML-PDF
*/
include("settings.php");
?>

<style>

* {
  font-size: 50px;
  font-family: arial;
  margin:0;
  padding:0;
}

.name, .hours-1 {
  display:inline-block;
  /* border:1px solid black; */
  vertical-align: middle;

}

.hours-1 {
  font-weight: bold;
  width:35%;
  font-size: 1.6em;
}

.name {
  width:57%;
  font-size: 1.9em;
}

.logo{
  display:block;
  margin:auto;
  width:750px;
}

.page {
  height:2160px;
  border:1px solid white;
}

.underline {
  height:20px;
}

.room {
  text-transform: capitalize;
}

.entry {
  padding: 15px 0;
  padding-left:100px;
}



h2 {
  font-size: 3em;
  display:inline-block;
  padding-left:100px;
}

h3 {
  font-size: 1.7em;
  color:#555;
  display:inline-block;
  padding-left: 100px;
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

  $planning_pdf = array();

  if ( $arr_posts->have_posts() ) : while ( $arr_posts->have_posts() ) : $arr_posts->the_post();



  $str = get_the_content();
  $name = ucwords(strtolower(get_the_title()));
  $id = get_the_ID();


  // var_dump(get_the_category($id));
  if(get_the_category()[0]->name != "forbidden" && get_the_category()[0]->name != "interdit"):

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

        array_push($planning_pdf, array($plan, $room, $day, $name, $from, $to));

      }
    }
  endif;
endwhile; endif;
?>

<?php
function sortByOrder($a, $b) {
  return $a[4] - $b[4];
}


$result = array();
$planning_pdf_1 = array();
$planning_pdf_2 = array();
foreach ($planning_pdf as $k=>$element) {
  $result[$element[0]][] = $element;
}
foreach ($result as $k=>$element) {
  foreach ($element as $k1=>$v) {
    $planning_pdf_1[$k][$v[1]][] = $v;
  }
}
foreach ($planning_pdf_1 as $k=>$element) {
  foreach ($element as $k1=>$v1) {
    foreach ($v1 as $k2=>$v) {

      $planning_pdf_2[$k][$k1][$v[2]][] = $v;
    }
  }
}

foreach ($planning_pdf_2 as $k=>$element) {
  foreach ($element as $k1=>$v1) {
    foreach ($v1 as $k2=>$v) {
      usort($v, 'sortByOrder');
      $planning_pdf_2[$k][$k1][$k2] = $v;
    }
  }
}

$planning_pdf = $planning_pdf_2;
// var_dump($planning_pdf);

?>

<div id="plannings">

  <?php


  foreach($planning_pdf as $color => $day) {
    $color = $zone_colors[$color];

    foreach($day as $room => $v) {

      foreach ($v as $k1 => $v1) {

        echo '<div class="page">';
        echo '<img class="logo" src="https://upload.wikimedia.org/wikipedia/fr/5/52/Japan_Impact_Logo.png"/>';

        $day_title = $translation[$k1][pll_current_language()];



        echo '<h2 class="room">'. $room . '</h2>';
        echo '<h3>'.  $day_title.'</h3>';

        echo '<div class="underline" style="background:'.$color .'"></div>';


        foreach ($v1 as $k2 => $entry) {

          $name = $entry[3];
          $from = $entry[4];
          $to = $entry[5];
          $hours = '<span class="hours-1">'.$from . "-" . $to.'</span>';

          echo '<div class="entry">';
          echo $hours . '<span class="name">' . $name . "</span><br>";
          echo '</div>';

        }
        echo '</div>';
      }


    }
    ?>

  </table>

  <?php


} ?>

</div>
