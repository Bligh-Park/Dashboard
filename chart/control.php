<html>
<head>
  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript">

      // Load the Visualization API and the controls package.
      google.charts.load('current', {'packages':['corechart', 'table', 'controls']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawDashboard);

      // Callback that creates and populates a data table,
      // instantiates a dashboard, a range slider and a pie chart,
      // passes in the data and draws it.
      function drawDashboard() {
      
        var jsonData = $.ajax({
        url: "getchartdata.php",
        dataType: "json",
        async: false
      }).responseText;

        // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

        // Create our data table.
        // var data = google.visualization.arrayToDataTable([
        //   ['Plant', 'PDR'],
        //   ['SAMEX' , 1.3],
        //   ['SESK', 2.4],
        //   ['SERK', 1.7],
        //   ['TSEC', 2.3],
        //   ['SEHC', 1.2],
        //   ['SEEG', 0.4],
        //   ['SSAP', 1.5]
        //   ]);

        // Create a dashboard.
        var dashboard = new google.visualization.Dashboard(
          document.getElementById('dashboard_div'));

        // Create a range slider, passing some options
        var donutRangeSlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'filter_div',
          'options': {
            'filterColumnLabel': 'PDR'
          }
        });

	       // Create a range slider, passing some options
        var table = new google.visualization.ChartWrapper({
          'chartType': 'Table',
          'containerId': 'table_div',
          'options': {
            'width': 200,
            'height': 200
          }
        });

        // Create a pie chart, passing some options
        var chart = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart_div',
          'options': {
            'width': 600,
            'height': 600,
            'pieSliceText': 'value',
            'legend': 'right'
          }
        });

        // Establish dependencies, declaring that 'filter' drives 'pieChart',
        // so that the pie chart will only display entries that are let through
        // given the chosen slider range.
        dashboard.bind(donutRangeSlider, [table, chart]);
        // dashboard.bind(donutRangeSlider, table);

        // Draw the dashboard.
        dashboard.draw(data);

      }
    </script>
  </head>

  <body>
    <!--Div that will hold the dashboard-->
    <div id="dashboard_div"></div>
    <div id="filter_div"></div>

    <!--Divs that will hold each control and chart-->
    <table class="columns" style="border: 0px solid black" >
      <tr>
        <td><div id="chart_div"></div><td>
        <td><div id="table_div"></div><td>
      </tr>
    </table>

  </body>
</html>
