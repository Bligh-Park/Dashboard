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
  $dbname="market";
  $dbpass="";
  $dbserver="localhost";

  $sql_query = "SELECT Section, Count(*) Defect FROM mq201610 WHERE Plant = 'SEEG' GROUP BY Section ORDER BY Defect DESC LIMIT 10;";
  $con = mysqli_connect($dbserver,$dbuser,$dbpass);
  if (!$con){ die('Could not connect: ' . mysql_error()); }

  // DB Select
  mysqli_select_db($con, $dbname);
  $result = mysqli_query($con, $sql_query);
  echo "{ \"cols\": [ {\"id\":\"\",\"label\":\"Section\",\"pattern\":\"\",\"type\":\"string\"}, {\"id\":\"\",\"label\":\"Defect\",\"pattern\":\"\",\"type\":\"number\"} ], \"rows\": [ ";


  $total_rows = mysqli_num_rows($result);
  $row_num = 0;  
  while($row = mysqli_fetch_array($result)){
    $row_num++;
    if ($row_num == $total_rows){
      echo "{\"c\":[{\"v\":\"" . $row['Section'] . "\",\"f\":null},{\"v\":" . $row['Defect'] . ",\"f\":null}]}";
    } else {
      echo "{\"c\":[{\"v\":\"" . $row['Section'] . "\",\"f\":null},{\"v\":" . $row['Defect'] . ",\"f\":null}]}, ";
    }
  }
  echo " ] }";

  mysqli_close($con);
  ?>
