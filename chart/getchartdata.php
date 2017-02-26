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
  echo "{ \"cols\": [ {\"id\":\"\",\"label\":\"Plant\",\"pattern\":\"\",\"type\":\"string\"}, {\"id\":\"\",\"label\":\"PDR\",\"pattern\":\"\",\"type\":\"number\"} ], \"rows\": [ ";


  $total_rows = mysqli_num_rows($result);
  $row_num = 0;  
  while($row = mysqli_fetch_array($result)){
    $row_num++;
    if ($row_num == $total_rows){
      echo "{\"c\":[{\"v\":\"" . $row['Plant'] . "\",\"f\":null},{\"v\":" . $row['PDR'] . ",\"f\":null}]}";
    } else {
      echo "{\"c\":[{\"v\":\"" . $row['Plant'] . "\",\"f\":null},{\"v\":" . $row['PDR'] . ",\"f\":null}]}, ";
    }
  }
  echo " ] }";

  mysqli_close($con);
  ?>
