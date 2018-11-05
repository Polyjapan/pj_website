<?php


// CATEGORIES SELECTION
if(pll_current_language() == "fr") {
  $categories_all = "martial-arts,projections,conferences,animations";
  $category_slugs = preg_split("/\,/",$categories_all);
}
else {
  $categories_all = "martial-arts-en,projections-en,conferences-en,animations-en";
  $category_slugs = preg_split("/\,/",$categories_all);
}

$colors = array( // can put in categories description and then retrieve
  "martial-arts" => "cyan",
  "martial-arts-en" => "cyan",
  "projections" => "blue",
  "projections-en" => "blue",
  "conferences" => "green",
  "conferences-en" => "green",
  "animations" => "orange",
  "animations-en" => "orange"
);


$a = array("room1" => array(),"room2" => array(),"room3" => array(),"room4" => array());
$b = array("room5" => array(),"room6" => array(),"room7" => array(),"room8" => array(),"room9" => array());
$slots_a = array("10:00"=>$a, "10:30"=>$a, "11:00"=>$a, "11:30"=>$a, "12:00"=>$a, "12:30"=>$a, "13:00"=>$a, "13:30"=>$a);
$slots_b = array("10:00"=>$b, "10:30"=>$b, "11:00"=>$b, "11:30"=>$b, "12:00"=>$b, "12:30"=>$b, "13:00"=>$b, "13:30"=>$b);
$p = array("scenes" => $slots_a, "auditoires"=>$slots_b);
$planning = array("sa" => $p, "di"=>$p);

// filter dates
