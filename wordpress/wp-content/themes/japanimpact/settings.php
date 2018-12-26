<?php


// CATEGORIES SELECTION
if(pll_current_language() == "fr") {
  $categories_all = "martial-arts,projections,conferences,animations,concerts,ateliers";
  $category_slugs = preg_split("/\,/",$categories_all);
}
else {
  $categories_all = "martial-arts-en,projections-en,conferences-en,animations-en,concerts-en,ateliers-en";
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
  "animations-en" => "orange",
  "concerts" => "red",
  "concerts-en" => "red",
  "ateliers" => "grey",
  "ateliers-en" => "grey"
);


$a = array("scenes" => array("room1" => array(),"room2" => array(),"room3" => array(),"room4" => array()));
$b = array("auditoires" => array("room5" => array(),"room6" => array(),"room7" => array(),"room8" => array(),"room9" => array()));

$rooms = array(
  "scenes" => array("room1" => array(),"room2" => array(),"room3" => array(),"room4" => array()),
  "auditoires" => array("room5" => array(),"room6" => array(),"room7" => array(),"room8" => array(),"room9" => array()),

  "green" => array("aki" => array(),"natsu" => array(),"haru" => array(),"uki" => array(),"fuyu" => array()),
  "yellow" => array("matcha" => array(),"mochi" => array()), // yellow
  "pink" => array("myôga" => array(),"momiji" => array(), "ginkgo"=>array(), "sakura"=>array()), // pink
  "orange" => array("meiji" => array(),"edo" => array(), "mad café"=>array(), "edo"=>array(), "sengoku"=>array()), // orange
  "red" => array("tokyo" => array(),"kyoto" => array(), "osaka"=>array(), "nara"=>array(), "nagoya"=>array(), "nagano"=>array(), "sapporo"=>array()), // rouge
  "purple" => array("usagi" => array(),"kistune" => array(), "tanuki"=>array(), "shika"=>array()), // purple
  "blue" => array("matsuri" => array()) // blue
);

$planning = array("sa" => array(), "di"=> array());

foreach ($rooms as $key => $value) {
  $satursday = array(
    "10:00"=>$value, "10:30"=>$value, "11:00"=>$value, "11:30"=>$value,
    "12:00"=>$value, "12:30"=>$value, "13:00"=>$value, "13:30"=>$value,
    "14:00"=>$value, "14:30"=>$value, "15:00"=>$value, "15:30"=>$value,
    "16:00"=>$value, "16:30"=>$value, "17:00"=>$value, "17:30"=>$value,
    "18:00"=>$value, "18:30"=>$value, "19:00"=>$value, "19:30"=>$value
  );
  $sunday = array(
    "10:00"=>$value, "10:30"=>$value, "11:00"=>$value, "11:30"=>$value,
    "12:00"=>$value, "12:30"=>$value, "13:00"=>$value, "13:30"=>$value,
    "14:00"=>$value, "14:30"=>$value, "15:00"=>$value, "15:30"=>$value,
    "16:00"=>$value, "16:30"=>$value, "17:00"=>$value, "17:30"=>$value,
    "18:00"=>$value
  );

  $planning["sa"][$key] = $satursday;
  $planning["di"][$key] = $sunday;
}

//https://drive.google.com/drive/u/2/folders/1Zui0knmCKMGOMmqI7-6H3d7kx03Uiqpv

// var_dump($plannings);

// $slots_a = array("10:00"=>$a, "10:30"=>$a, "11:00"=>$a, "11:30"=>$a, "12:00"=>$a, "12:30"=>$a, "13:00"=>$a, "13:30"=>$a);
// $slots_b = array("10:00"=>$b, "10:30"=>$b, "11:00"=>$b, "11:30"=>$b, "12:00"=>$b, "12:30"=>$b, "13:00"=>$b, "13:30"=>$b);
// $p = array("scenes" => $slots_a, "auditoires"=>$slots_b);
// $planning = array("sa" => $p, "di"=>$p);

$translation = array(
  "sa" => array(
    "fr" => "samedi",
    "en" => "saturday"
  ),
  "di" => array(
    "fr" => "dimanche",
    "en" => "sunday"
  ),
  "more" => array(
    "fr" => "Lire la suite",
    "en" => "Read More"
  )
);

$zone_colors = array(
  "green" => "#0b8140",
  "blue" => "#3953a4",
  "yellow" => "#fedb16",
  "purple" => "#7c277d",
  "red" => "#ed2024",
  "orange" => "#f08821",
  "pink" => "#f497c0"

);
// filter dates
