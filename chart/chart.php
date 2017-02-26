<html>
<head>
  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart', 'table']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var jsonData = $.ajax({
        url: "getchartdata.php",
        dataType: "json",
        async: false
      }).responseText;

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      //var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      var chart = new google.visualization.Table(document.getElementById('table_div'));

      chart.draw(data, {width: 200, height: 200});

      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, {width: 600, height: 600});
    }

  </script>
</head>

<body>
  <form>
    <select name="users" onchange="drawItems(this.value)">
      <option value="">Select a Plant:</option>
      <?php
    // option 내용을 채우기 위한 Query
      $dbuser="root";
      $dbname="ctk";
      $dbpass="";
      $dbserver="localhost";

    // Make a MySQL Connection
      $con = mysqli_connect($dbserver, $dbuser, $dbpass) or die(mysql_error());
      mysqli_select_db($con, $dbname) or die(mysql_error());

    // Create a Query
      $sql_query = "SELECT Plant Week FROM PDR";

    // Execute query
      $result = mysqli_query($con, $sql_query) or die(mysql_error());
      while ($row = mysqli_fetch_array($result)){
       echo '<option value='. $row['Plant'] . '>'. $row['Week'] .'</option>';
     }

     mysqli_close($con);
     ?>
   </select>
 </form>


 <!--Div that will hold the pie chart-->
 <table>
 <tr>
  <td><div id="chart_div"></div></td>
  <td><div id="table_div"></div></td>
  </tr>
 </table>
</body>
</html>
