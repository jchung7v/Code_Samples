<?php include('../include_db.php'); ?>

<?php
$dataPoints = [];
$sql = "SELECT School as school, COUNT(*) as count";
$sql .= " FROM Students GROUP BY School";
$res = $db->query($sql);

array_push($dataPoints, ['name', 'count']);
while ($row = $res->fetchArray()) {
    $arrayItem = array($row['school'], $row['count']);
    array_push($dataPoints, $arrayItem);
}

$db->close();
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
<div id="pie_chart_div"></div>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Students count by school', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('pie_chart_div'));
  chart.draw(data, options);
}
</script>

<hr /><a href="/" >&lt;&lt; BACK</a>

