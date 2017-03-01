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

      chart.draw(data, {width: 400, height: 600});

      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, {width: 600, height: 600});
    }

  </script>
</head>

<body>
 <!--Div that will hold the pie chart-->
 <table>
 <tr>
  <td><div id="chart_div"></div></td>
  <td><div id="table_div"></div></td>
  </tr>
 </table>
</body>
</html>
