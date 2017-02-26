<?php

/*
 * JSON Format
  {
    "cols": [
    {"id":"","label":"Topping","pattern":"","type":"string"},
    {"id":"","label":"Slices","pattern":"","type":"number"}
        ],
    "rows": [
    {"c":[{"v":"Mushrooms","f":null},{"v":3,"f":null}]},
    {"c":[{"v":"Onions","f":null},{"v":1,"f":null}]},
    {"c":[{"v":"Olives","f":null},{"v":1,"f":null}]},
    {"c":[{"v":"Zucchini","f":null},{"v":1,"f":null}]},
    {"c":[{"v":"Pepperoni","f":null},{"v":2,"f":null}]}
        ]
  }
 */

  //$q=$_GET["q"];
  $dbuser="root";
  $dbname="ctk";
  $dbpass="";
  $dbserver="localhost";

  $sql_query = "SELECT Plant, PDR FROM pdr;";
  $con = mysqli_connect($dbserver,$dbuser,$dbpass);
  if (!$con){ die('Could not connect: ' . mysql_error()); }
  
  // DB Select
  mysqli_select_db($con, $dbname);
  $result = mysqli_query($con, $sql_query);
  
  $rows = array();
  while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }
  print json_encode($rows);

  mysqli_close($con);
  ?>
