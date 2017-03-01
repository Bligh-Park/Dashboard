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
          url: "getdata3.php",
          dataType: "json",
          async: false
        }).responseText;

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Create a dashboard.
      var dashboard = new google.visualization.Dashboard(
        document.getElementById('dashboard_div'));
      
        // Define a category picker control for the Gender column
        var Picker = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'picker',
          'options': {
            'filterColumnLabel': 'Section',
            'ui': {
            'labelStacking': 'vertical',
            'label': 'Section Selection:',
            'allowTyping': false
            }
          }
        })

    		// Define a category picker control for the Gender column
        var Picker2 = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'picker2',
          'options': {
            'filterColumnLabel': 'Chassis',
            'ui': {
            'labelStacking': 'vertical',
            'label': 'Chassis Selection:',
            'allowTyping': false
            }
          }
        })

        // Create a range slider, passing some options
        var donutRangeSlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'filter_div',
          'options': {
            'filterColumnLabel': '201601'
          }
        });

      	// Create a range slider, passing some options
        var table = new google.visualization.ChartWrapper({
          'chartType': 'Table',
          'containerId': 'table_div',
          'options': {
            'width': '1000px'
          }
        });

        // Create a pie chart, passing some options
        var chart = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart_div',
          'options': {
            'width': 800,
            'height': 800,
	           // 'curveType': 'function', // for line chart
             'legend': 'right'
           },
           'view': {'columns': [2, 4]}
         });
         /*

        // Create a pie chart, passing some options
        var chart2 = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart_div2',
          'options': {
            'width': 800,
            'height': 800,
             // 'curveType': 'function', // for line chart
             'legend': 'right'
           },
           'view': {'columns': [3, 4]}
         });
*/
        dashboard.bind([Picker, Picker2], [chart, table]);
        //dashboard.bind([Picker, Picker2, donutRangeSlider], [table, chart, chart2]);
        // dashboard.bind([Picker, Picker2], [table, chart]);

        // Show only some columns
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1, 2, 3, 4]); //here you set the columns you want to display

        // Draw the dashboard.
        dashboard.draw(data);
        // dashboard.draw(view);

      }
    </script>
  </head>

  <body>
    <!--Div that will hold the dashboard-->
    <!-- <form id="form1" runat="server"> -->
      <div id="dashboard_div">
      <!-- <div id="filter_div"></div> -->
        <table>
        <tr>
          <th>Seciton</th>
          <th>Chassis</th>
        </tr>
            
          <tr style='vertical-align: top'>
            <td>
              <div id="picker"></div>
            </td>
            <td>
               <div id="picker2"></div>
            </td>
          </tr>
          <tr>
            <td >
              <div style="float: top" id="chart_div"></div>            
            </td>
            <td>
              <!-- <div style="float: left;" id="chart_div2"></div>             -->
            </td>
          </tr>
          <tr>
            <td>
              <div style="float: right;" id="table_div"></div>    
            </td>
          </tr>
        </table>

      </div> <!-- Dashboard -->
    <!-- </form> -->


  </div>
</body>
</html>
