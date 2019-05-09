<?php
/**
* Template Name: Downlaod planning
*/

require __DIR__.'/vendor/autoload.php';
include("settings.php");
use Spipu\Html2Pdf\Html2Pdf;


$numberOfZonePerTable = 4;


// CSS
$html = '

<style>

body {
  font-family:arial;
}

a {
  text-decoration:none;
}


table{
  text-align: center;
  width: 100%;
  margin-bottom: 1rem;
  background-color: transparent;
  border-collapse: collapse;
}

td {
  vertical-align: middle;
  // border-top: 1px solid #dee2e6;
  padding:0 5px;
  border:1px solid black;
  font-size:20px;
  height:50px;
  min-width:100px;
}

td.offset {
  border:none !important;
}

//
// td a {
  //   color:white;
  //   text-transform: capitalize;
  //   font-size: 0.8em;
  // }

  th {
      vertical-align: middle;
      font-size:18px;
      background:lightgrey;
      border:1px solid black;
      font-weight: bold;
      color:black;
      text-transform: uppercase;
      // padding:5px;
    }

    th.hour div {
      min-width:130px;
      // display:block;
    }

    th.room {
        color:white;
        text-shadow:black 1px 1px 0px,black -1px 1px 0px,black 1px -1px 0px,black -1px -1px 0px;
      }
      //
      // .logo {
        //   display:block;
        //   width:100px;
        // }
        //
        // h1, h2 {
          //   text-align:center;
          //   text-transform:capitalize;
          // }
          // </style>
          ';

          $html .= "<body>";

          // $html .= '<img class="logo" src="https://japan-impact.ch/wp-content/uploads/2018/09/jilogo_nohead-small.png"/>';

          // $html .= '<h2>'.date ('Y').'</h2>';

          $html .= '<div id="plannings">';


          // obtain all necessary posts and get their slot time
          $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'lang' => pll_current_language(),
            'category_name' =>  $categories_all .",". $interdit_category,

            'posts_per_page' => 100,
            // 'date_query' => array(
            //   array(
            //     'after'     => array(
            //       'year'  => 2018,
            //       'month' => 6,
            //       'day'   => 1,
            //     ),
            //     'before'    => array(
            //       'year'  => 2019,
            //       'month' => 6,
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
          $color = $colors[get_the_category()[0]->slug];
          $meta = get_post_custom();

          $plan_array = array_map('trim', explode(",",$meta['class'][0]));
          $day_array =  array_map('trim', explode(",",$meta['day'][0]));
          $from_array =  array_map('trim', explode(",",$meta['from'][0]));
          $to_array =  array_map('trim', explode(",",$meta['to'][0]));
          $room_array =  array_map('trim', explode(",",$meta['room'][0]));

          $is_complete = (strlen($plan_array[0])!=0) && (strlen($day_array[0])!=0) && (strlen($from_array[0])!=0) && (strlen($to_array[0])!=0) && (strlen($room_array[0])!=0);

          if(!empty($plan_array) && $is_complete) {

            for ($p=0; $p < sizeof($plan_array); $p++) {
              $plan = $plan_array[$p];
              $day = $day_array[$p];
              $from = $from_array[$p];
              $to = $to_array[$p];
              $room = $room_array[$p];

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



        // clean exlcuded rooms
        foreach($planning as $day => $v1) {
          foreach($v1 as $zone => $v) {
            foreach ($v as $hour => $v2) {
              foreach ($v2 as $room => $entry) {
                if(in_array($room,$rooms_excluded)){
                  // var_dump('wef');
                  unset($planning[$day][$zone][$hour][$room]);
                }
              }
            }
          }
        }

        $i = 0;

        $p = $planning[$day_planning];
        // foreach($planning as $day => $p) {

        $day_title = $translation[$day_planning][pll_current_language()];
        // $html .= '<h1>'.$day_title.'</h1>';
        $counter = 0;

        // for ($i=0; $i < sizeof($p); $i++) {
        //
        // $name = current($keys);
        // $plan = $p[$name];
        // next($keys);
        //
        // $name1 = current($keys); // next zone
        //
        // if($name1) {
        //   $plan1 = $p[$name1];
        //   next($keys);
        //   $size1 = sizeof(reset($plan1));
        // }
        // else {
        //   $size1 = 0;
        //   $plan1 = array();
        //   $name1 = "";
        // }
        //
        // $color = $zone_colors[$name];
        // $color1 = $zone_colors[$name1];
        // $size = sizeof(reset($plan)) + $size1;

        $html .= '
        <table  class="table" id="planning-'. $i . '"><tr>
        <td class="offset"></td>
        <th  scope="col" colspan="' . $size. '">'.  $day_title .'</th>
        </tr>

        <tr>
        <td class="offset"></td>

        ';

        // append all rooms th
        $keys = array_keys($p);

        $maximum = array();
        while($name = current($keys)) {
          $plan = $p[$name];
          $color = $zone_colors[$name];

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


          foreach(reset($plan) as $room=>$k){
            $html .= '<th class="room" style="background:'.$color.'" colspan="'. $maximum[$room] .'" scope="col">'. $room . '</th>';
          }

          next($keys);

        }
        $html .= '</tr>';

        $first = true;

        $keys = array_keys($p);
        $thWritten = array();

        $name = current($keys);
        $plan = $p[$name];
        $color = $zone_colors[$name];

        // var_dump($plan);


        foreach($plan as $hour => $value){ //iterate over hour

          // write hours th only once
          if(!isset($thWritten[$hour])){// for each 30min
            $html .= '<tr>';

            $current_hour = strtotime($hour);

            $k1 = date("H:i",strtotime("+30 minutes", $current_hour));

            // do not display xx:15 and xx:45 rows
            $html .= (date('i', $current_hour)=='00' || date('i', $current_hour)=='30') ? '<th scope="row" class="hour" rowspan="2"><div>'. $hour . " - " . $k1 .'</div></th>' : '';

            $thWritten[$hour] = true;
          }

          while($zone = current($keys)) {

            // foreach($plan as $h => $rooms){

            foreach ($p[$zone][$hour] as $name=>$entries) {

              for ($a=0; $a < $maximum[$name]; $a++) {
                if(empty($entries[$a])){ // for each empty activity
                  $html .= '<td></td>';
                }
                else {
                  if($entries[$a][0] != 0) { // condition on canceled td, otherwise display activity ---> display only on first td
                    $html.= '<td style="background:'.$entries[$a][2].'" rowspan="'.$entries[$a][0].'">' . '<a href="#post-'.$entries[$a][3].'">' . $entries[$a][1] .'</a></td>';
                  }
                }
              }
            }

            next($keys);
          }
          $keys = array_keys($p);


          $html .= '</tr>';



          //
          // foreach($plan as $hour => $rooms){ // for each room
          //   // var_dump($rooms);
          //   foreach ($rooms as $room) {
          //     $html .= '<td></td>';
          //   }
          //
          // if(empty($room)){ // for each non-empty activity
          //   $html .= '<td></td>';
          // }
          // else {
          //   if($room[0][0] != 0) { // condition on canceled td, otherwise display activity
          //     $html .= '<td style="background:'.$room[0][2].'" rowspan="'.$room[0][0].'">' . '<a href="#post-'.$room[0][3].'">' . $room[0][1] .'</a></td>';
          //   }
          // }
          // }
          //  $html .= '</tr>';



        }

        $html .= '</table>';




        // }

        $html .= "</div>";

        // $html .= '<img src="'.$PLANNING_IMG.'"/>';

        $html .= "</body>";



        //
        // $html2pdf = new Html2Pdf('L', 'A4');
        // $html2pdf->writeHTML($html);
        // $html2pdf->output("planning.pdf");
        echo $html;


        ?>
