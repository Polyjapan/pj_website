


<style media="screen">

#plannings {

}

table{
  text-align: center;
  width:47%;
  display:inline-block;
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
);

$arr_posts = new WP_Query( $args );
if ( $arr_posts->have_posts() ) : while ( $arr_posts->have_posts() ) : $arr_posts->the_post();
$str = get_the_content();
$name = get_the_title();
$color = $colors[get_the_category()[0]->slug];

preg_match_all('/(?<=data\-planning\=\")[^\"]+(?=\")/', $str, $matches, PREG_OFFSET_CAPTURE);


// create slot array
foreach($matches[0] as $m){
  list($plan, $day, $from, $to, $room) = preg_split ('/\,/', $m[0]);

  $date_to = strtotime($to);
  $date_from = strtotime($from);
  $int1 = $date_to - $date_from;
  $h = (int)date('H',$int1);
  $m = (int)date('i',$int1);
  $duration = $m/30 + 2*$h;

  $curr = $date_from;
  for($i = 0; $i < $duration-1; $i++){ // cancel rowspan -->  too much td
    $curr = date("H:i", strtotime("+30 minutes",$curr));
    array_push($planning[$day][$plan][$curr][$room], array(0, $name, $color));
    $curr = strtotime($curr);
  }

  array_push($planning[$day][$plan][$from][$room], array($duration, $name, $color));
}


endwhile; endif;

?>



<?php
foreach($planning as $day => $p) {

echo "<h1>" . $day . "</h1>";

foreach($p as $name => $plan) {
?>


  <table>

    <tr>
      <td class="offset"></td>
      <th scope="col" colspan="4"><?php echo $name ?></th>
    </tr>
    <tr>
      <td class="offset"></td>
      <th scope="col">Room1</th>
      <th scope="col">Room2</th>
      <th scope="col">Room3</th>
      <th scope="col">Room4</th>
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
            echo '<td style="background:'.$room[0][2].'" rowspan="'.$room[0][0].'">'. $room[0][1] .'</td>';
          }
        }
      }
      echo '</tr>';
    }
    ?>

  </table>

<?php }
} ?>

</div>
