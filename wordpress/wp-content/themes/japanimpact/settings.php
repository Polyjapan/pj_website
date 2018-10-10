<?php


// CATEGORIES SELECTION
if(pll_current_language() == "fr") {
  $categories_all = "martial-arts,projections";
  $category_slugs = preg_split("/\,/",$categories_all);
}
else {
  $categories_all = "martial-arts-en,projections-en";
  $category_slugs = preg_split("/\,/",$categories_all);
}

$colors = array( // can put in categories description and then retrieve
  "martial-arts" => "cyan",
  "martial-arts-en" => "cyan",
  "projections" => "blue",
  "projections-en" => "blue"
);


$a = array("room1" => array(),"room2" => array(),"room3" => array(),"room4" => array());
$slots = array("10:00"=>$a, "10:30"=>$a, "11:00"=>$a, "11:30"=>$a, "12:00"=>$a, "12:30"=>$a, "13:00"=>$a, "13:30"=>$a);
$p = array("scenes" => $slots, "auditoires"=>$slots);
$planning = array("sa" => $p, "di"=>$p);
