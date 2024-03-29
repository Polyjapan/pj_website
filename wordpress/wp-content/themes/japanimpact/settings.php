<?php
// header link
$HEADER_LINK = "https://i.imgur.com/Njy4LV7.png"; // header image link
//$HEADER_LINK = "https://i.imgur.com/AURHTat.png"; // old header image link
$PLANNING_IMG = "https://japan-impact.ch/wp-content/uploads/2019/01/planning_complet-4.jpg"; // planning plan image link
$LOGO_URL = "https://upload.wikimedia.org/wikipedia/fr/5/52/Japan_Impact_Logo.png"; // logo link

// link to download plannings
$download_sa = custom_get_page_link("Download planning Saturday"); // name of download planning saturday
$download_di = custom_get_page_link("Download planning Dimanche"); // name of download planning sunday


// $download_sa = custom_get_page_link("ddl planning samedi"); // name of download planning saturday
// $download_di = custom_get_page_link("ddl planning dimanche"); // name of download planning sunday



// CATEGORIES SELECTION
if(pll_current_language() == "fr") {
  //$categories_all = "martial-arts,projections,conferences,animations,concerts,ateliers,activites-continues"; // slugs of the categories in the program FR
  $categories_all = "activites-continues,animations,martial-arts,ateliers,concerts-fr,conferences,jeux-video,projections"; // slugs of the categories in the program FR
  $category_slugs = preg_split("/\,/",$categories_all);
  $interdit_category = "interdit"; // forbidden category slug FR
  $notshown = "hidden-fr"; // forbidden category slug FR
}
else {
  $categories_all = "continuous-activities,animations-en,concerts-en,conferences-en,ateliers-en,martial-arts-en,projections-en,video-games"; // slugs of the categories in the program EN
  $category_slugs = preg_split("/\,/",$categories_all);
  $interdit_category = "forbidden"; // forbidden category slug EN
  $notshown = "index-hidden"; // forbidden category slug EN
}

$interdit_id = get_category_by_slug($interdit_category)->term_id;
$notshown_id = get_category_by_slug($notshown)->term_id;

$colors = array(
  // categories colors
  // if colors change, need to change it in the css as well
  "martial-arts" => "#00aeef",
  "martial-arts-en" => "#00aeef",
  "projections" => "#8178ca",
  "projections-en" => "#8178ca",
  "conferences" => "#39b54a",
  "conferences-en" => "#39b54a",
  "animations" => "#cf2afc",
  "animations-en" => "#cf2afc",
  "concerts-fr" => "#820606",
  "concerts-en" => "#820606",
  "ateliers" => "#136448",
  "ateliers-en" => "#136448",
  "continuous-activities" => "#ec008c",
  "activites-continues" => "#ec008c",
  "interdit" => "#464646",
  "forbidden" => "#464646",
  "jeux-video" => "#ffa92e",
  "video-games" => "#ffa92e"
);

// zone colors
$zone_colors = array(
  "green" => "#0b8140",
  "blue" => "#3953a4",
  "yellow" => "#ffcd21",
  "purple" => "#7c277d",
  "red" => "#ed2024",
  "orange" => "#f08821",
  "pink" => "#f497c0",
  "rolex" => "grey"
);


$rooms = array(
  // zones, rooms
  "green" => array("aki" => array(),"natsu" => array(),"haru" => array(),"uki" => array()),
  "yellow" => array("matcha" => array(),"mochi" => array()), // yellow
  "pink" => array("myôga" => array(),"momiji" => array(), "gingko"=>array(), "sakura"=>array()), // pink
  "orange" => array("meiji" => array(),"edo" => array(), "maid café"=>array(), "edo"=>array(), "sengoku"=>array()), // orange
  "red" => array("tokyo" => array(),"kyoto" => array(), "osaka"=>array(), "nara"=>array(), "nagoya"=>array(), "nagano"=>array(), "sapporo"=>array(), "okinawa"=>array()), // rouge
  "blue" => array("matsuri" => array()), // blue
  "purple" => array("usagi" => array(),"kitsune" => array(), "tanuki"=>array(), "shika"=>array()), // purple
  "rolex" => array("rolex" => array())
);

$planning = array("sa" => array(), "di"=> array()); // days

foreach ($rooms as $key => $value) { // hours
  $satursday = array(
    "10:00"=>$value,"10:15"=>$value, "10:30"=>$value,"10:45"=>$value, "11:00"=>$value, "11:15"=>$value, "11:30"=>$value, "11:45"=>$value,
    "12:00"=>$value,"12:15"=>$value, "12:30"=>$value, "12:45"=>$value,"13:00"=>$value,"13:15"=>$value, "13:30"=>$value,"13:45"=>$value,
    "14:00"=>$value,"14:15"=>$value, "14:30"=>$value, "14:45"=>$value,"15:00"=>$value,"15:15"=>$value, "15:30"=>$value,"15:45"=>$value,
    "16:00"=>$value,"16:15"=>$value, "16:30"=>$value, "16:45"=>$value,"17:00"=>$value,"17:15"=>$value, "17:30"=>$value,"17:45"=>$value,
    "18:00"=>$value,"18:15"=>$value, "18:30"=>$value, "18:45"=>$value,"19:00"=>$value, "19:15"=>$value, "19:30"=>$value,"19:45"=>$value,
    "20:00"=>$value,"20:15"=>$value, "20:30"=>$value, "20:45"=>$value
  );

  $sunday = array(
    "10:00"=>$value,"10:15"=>$value, "10:30"=>$value,"10:45"=>$value, "11:00"=>$value, "11:15"=>$value, "11:30"=>$value, "11:45"=>$value,
    "12:00"=>$value,"12:15"=>$value, "12:30"=>$value, "12:45"=>$value,"13:00"=>$value,"13:15"=>$value, "13:30"=>$value,"13:45"=>$value,
    "14:00"=>$value,"14:15"=>$value, "14:30"=>$value, "14:45"=>$value,"15:00"=>$value,"15:15"=>$value, "15:30"=>$value,"15:45"=>$value,
    "16:00"=>$value,"16:15"=>$value, "16:30"=>$value, "16:45"=>$value,"17:00"=>$value,"17:15"=>$value, "17:30"=>$value,"17:45"=>$value,
  );

  $planning["sa"][$key] = $satursday; // saturday
  $planning["di"][$key] = $sunday; // sunday
}

// countdown goal
// example: 'Feb 15, 2020 10:00:00' // WARNING: it is important to keep the quote marks!
$saturday_date = "'Aug 20, 2022 10:00:00'";

// manual translations
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
  ),
  "follow" => array(
    "fr" => "Suivez-nous !",
    "en" => "Follow us!"
  ),
  "partners" => array(
    "fr" => "Partenaires",
    "en" => "Partners"
  ),
  "location" => array(
    "fr" => "Lieu",
    "en" => "Location"
  ),
  "at" => array(
    "fr" => "à",
    "en" => "at"
  ),
  "download" => array(
    "fr" => "Télécharger les horaires",
    "en" => "Download plannings"
  ),
  "dates" => array(
    "fr" => "20 et 21 Août 2022", // DATES
    "en" => "August 20th and 21st 2022"
  ),
  "dates_sa" => array(
    "fr" => "samedi: 10h - 20h", // DATES
    "en" => "saturday: 10AM - 8PM"
  ),
  "dates_di" => array(
    "fr" => "dimanche: 10h - 18h", // DATES
    "en" => "sunday: 10AM - 6PM"
  ),
  "countdown-d" => array(
    "fr" => "jours",
    "en" => "days"
  ),
  "countdown-h" => array(
    "fr" => "heures",
    "en" => "hours"
  ),
  "countdown-m" => array(
    "fr" => "minutes",
    "en" => "minutes"
  ),
  "countdown-s" => array(
    "fr" => "secondes",
    "en" => "seconds"
  ),
  "green" => array(
    "fr" => "verte",
    "en" => "green"
  ),
  "red" => array(
    "fr" => "rouge",
    "en" => "red"
  ),
  "purple" => array(
    "fr" => "violette",
    "en" => "purple"
  ),
  "rolex" => array(
    "fr" => "rolex",
    "en" => "rolex"
  ),
  "pink" => array(
    "fr" => "rose",
    "en" => "pink"
  ),
  "orange" => array(
    "fr" => "orange",
    "en" => "orange"
  ),
  "blue" => array(
    "fr" => "bleue",
    "en" => "blue"
  ),
  "yellow" => array(
    "fr" => "jaune",
    "en" => "yellow"
  ),
  "planning" => array(
    "fr" => "Cliquez sur la couleur de la zone désirée pour découvrir les horaires des activités pour chaque jour !",
    "en" => "Click on the wanted area color to discover the activities schedule for each day!"
  )
);
