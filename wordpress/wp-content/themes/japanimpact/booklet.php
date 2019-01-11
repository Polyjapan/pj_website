<?php
/**
* Template Name: Booklet
*/

require __DIR__.'/vendor/autoload.php';
include("settings.php");
use Spipu\Html2Pdf\Html2Pdf;

https://drive.google.com/file/d/1TUypwb0stCPbjWHzzaZNMQz1K9S-qnvT/view?usp=sharing

// CSS
$html = '

<style>

body {
  font-family:arial;
  width:700px;
  padding:20px;
}

.dates {
  font-size:14px;
}

img {
  width:100%;
  height:200px;
  object-fit:cover;

}

.grid {
  font-size:15px;
  text-align:justify;
}

.room {
  color:white;
  padding:3px 5px;
}

</style>
';

$html .= "<body>";

// $html .= '<img class="logo" src="https://japan-impact.ch/wp-content/uploads/2018/09/jilogo_nohead-small.png"/>';

// $html .= '<h2>'.date ('Y').'</h2>';


foreach ($category_slugs as $c) {

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'lang' => 'fr',
    'category_name' => $c,
  );


  $arr_posts = new WP_Query( $args );


  $category_name = get_category_by_slug( $c )->name;


  $html .= '<h2 class="category-title" style="color:'. $colors[$c] . '">' . $category_name . '</h2>

  <div class="category" style="border-color:' . $colors[$c] . '">';

  if ( $arr_posts->have_posts() ) :


    $html .=  '<div class="row article align-items-center"' . get_post_class(). ' style="border-color:' . $colors[$c] . '>">';

    while ( $arr_posts->have_posts() ) :
      $arr_posts->the_post();

      $meta = get_post_custom();


      $html .=  '<div class="col-lg-4"  id="post-'.get_the_ID().'">';


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

      $html .= '<div class="grid">';

      if($meta['img'][0]){
        $html .= '<img src="' . $meta['img'][0] . '" alt="' . get_the_title() . '"/>';
      }

      $html .= '<h2>'.get_the_title() .'</h2>'.

      '<span class="dates">' . $dates . '</span><br>'.

      get_the_content() .

      '</div>
      </div>
      <br>';

    endwhile;

    $html .= '</div>';

  endif;

  $html .= '</div>';

}



// $html2pdf = new Html2Pdf('P', 'A5');
// $html2pdf->writeHTML($html);
// $html2pdf->output("planning.pdf");
echo $html;


?>
