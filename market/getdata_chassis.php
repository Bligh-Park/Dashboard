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

  $sql_query = "SELECT Section, RunningModel, Chassis, ProductionDate, SUM(`201601`) `201601`, SUM(`201602`) `201602`, SUM(`201603`) `201603`, SUM(`201604`) `201604`, SUM(`201605`) `201605`, SUM(`201606`) `201606`, SUM(`201607`) `201607`, SUM(`201608`) `201608`, SUM(`201609`) `201609`, SUM(`201610`) `201610`, SUM(`201601`) + SUM(`201602`) + SUM(`201603`) + SUM(`201604`) + SUM(`201605`) + SUM(`201606`) + SUM(`201607`) + SUM(`201608`) + SUM(`201608`) + SUM(`201609`) + SUM(`201610`) SUM
          FROM mq201610 WHERE Plant = 'SESK' and ProductionMonth = '201601' GROUP BY Chassis ORDER BY SUM DESC;";
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
    array('label'=> 'ProductionDate', 'type'=>'string'),
    array('label'=> '201601', 'type'=>'string'),
    array('label'=> '201602', 'type'=>'string'),
    array('label'=> '201603', 'type'=>'string'),
    array('label'=> '201604', 'type'=>'string'),
    array('label'=> '201605', 'type'=>'string'),
    array('label'=> '201606', 'type'=>'string'),
    array('label'=> '201607', 'type'=>'string'),
    array('label'=> '201608', 'type'=>'string'),
    array('label'=> '201609', 'type'=>'string'),
    array('label'=> '201610', 'type'=>'string'),
    array('label'=> 'SUM', 'type'=>'string')
  );

  $rows = array();
  while($r = mysqli_fetch_assoc($result)) {
    $temp = array();
    $temp[] = array('v' =>(string) $r['Section']);
    $temp[] = array('v' =>(string) $r['RunningModel']);
    $temp[] = array('v' =>(string) $r['Chassis']);
    $temp[] = array('v' =>(string) $r['ProductionDate']);
    $temp[] = array('v' =>(int) $r['201601']);
    $temp[] = array('v' =>(int) $r['201602']);
    $temp[] = array('v' =>(int) $r['201603']);
    $temp[] = array('v' =>(int) $r['201604']);
    $temp[] = array('v' =>(int) $r['201605']);
    $temp[] = array('v' =>(int) $r['201606']);
    $temp[] = array('v' =>(int) $r['201607']);
    $temp[] = array('v' =>(int) $r['201608']);
    $temp[] = array('v' =>(int) $r['201609']);
    $temp[] = array('v' =>(int) $r['201610']);
    $temp[] = array('v' =>(int) $r['SUM']);

    $rows[] = array('c' => $temp);
  }

  $table['rows']=$rows;
  $jsonTable = json_encode($table);
  print $jsonTable;

  mysqli_close($con);
  ?>
