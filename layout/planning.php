<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Japan Impact</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <style media="screen">
  table{
    text-align: center;

  }

  td {padding:15px;
    border:1px solid black;
    font-size:20px;
    min-width: 100px;
    max-width: 150px;
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



    <?php
    $a = array("room1" => array(),"room2" => array(),"room3" => array(),"room4" => array());
    $slots = array("10:00"=>$a, "10:30"=>$a, "11:00"=>$a, "11:30"=>$a, "12:00"=>$a);

    $str = '<span data-planning="name,scenes,10:30,12:30,room1"></span>
    <span data-planning="12,scenes,11:30,12:30,room2"></span><span data-planning="ergdfv,scenes,11:30,12:30,room3"></span><span data-planning="ergdfv,scenes,10:30,12:30,room4"></span>';
    preg_match_all('/(?<=data\-planning\=\")[^\"]+(?=\")/', $str, $matches, PREG_OFFSET_CAPTURE);


    foreach($matches[0] as $m){
      list($name, $plan, $from, $to, $room) = preg_split ('/\,/', $m[0]);

      $date_to = strtotime($to);
      $date_from = strtotime($from);
      $int1 = $date_to - $date_from;
      $h = (int)date('H',$int1);
      $m = (int)date('i',$int1);
      $duration = $m/30 + 2*$h;

      $curr = $date_from;
      for($i = 0; $i < $duration-1; $i++){ // cancel rowspan -->  too much td
        $curr = date("H:i", strtotime("+30 minutes",$curr));
        array_push($slots[$curr][$room], array(0, $name));
        $curr = strtotime($curr);
      }

      array_push($slots[$from][$room], array($duration, $name));
    }



    ?>

    <section>
      <table>

        <tr>
          <td class="offset"></td>
          <th scope="col" colspan="4">Scenes</th>
        </tr>
        <tr>
          <td class="offset"></td>
          <th scope="col">Room1</th>
          <th scope="col">Room2</th>
          <th scope="col">Room3</th>
          <th scope="col">Room4</th>
        </tr>

        <?php
        foreach($slots as $k=>$v){ // for each 30min
          echo '<tr>';

          $k1 = date("H:i",strtotime("+30 minutes", strtotime($k)));

          echo '<th scope="row">'. $k . " - " . $k1 .'</th>';
          foreach($v as $room){ // for each room
            if(empty($room)){ // for each non-empty activity
              echo '<td></td>';
            }
            else {
              if($room[0][0] != 0) { // condition on canceled td, otherwise display activity
                echo '<td rowspan="'.$room[0][0].'">'. $room[0][1] .'</td>';
              }
            }
          }
          echo '</tr>';
        }
        ?>

      </table>

    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
  </html>
