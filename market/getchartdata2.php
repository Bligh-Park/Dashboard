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

  $sql_query = "SELECT RunningModel, Chassis, Section, ProductionMonth, Count(*) Defect FROM mq201610 WHERE Plant = 'SESK' GROUP BY RunningModel ORDER BY Defect DESC LIMIT 10;";
  $con = mysqli_connect($dbserver,$dbuser,$dbpass);
  if (!$con){ die('Could not connect: ' . mysql_error()); }

  // DB Select
  mysqli_select_db($con, $dbname);
  $result = mysqli_query($con, $sql_query);

  $table = array();

  $table['cols']=array(
    array('label'=> 'Section', 'type'=>'string'),
    array('label'=> 'RunningModel', 'type'=>'string'),
    array('label'=> 'Chassis', 'type'=>'string'),
    array('label'=> 'ProductionMonth', 'type'=>'string'),
    array('label'=>'Defect', 'type'=>'number')
  );

  $rows = array();

  while($r = mysqli_fetch_assoc($result)) {
    $temp = array();
    $temp[] = array('v' =>(string) $r['Section']);
    $temp[] = array('v' =>(string) $r['RunningModel']);
    $temp[] = array('v' =>(string) $r['Chassis']);
    $temp[] = array('v' =>(int) $r['ProductionMonth']);
    $temp[] = array('v' =>(int) $r['Defect']);

    $rows[] = array('c' => $temp);
  }

  $table['rows']=$rows;
  $jsonTable = json_encode($table);
  print $jsonTable;

  mysqli_close($con);
  ?>
