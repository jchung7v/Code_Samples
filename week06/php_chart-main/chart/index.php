<?php include('../include_db.php'); ?>

<?php
$dataPoints = [];
$sql = "SELECT School as school, COUNT(*) as count";
$sql .= " FROM Students GROUP BY School";
$res = $db->query($sql);

while ($row = $res->fetchArray()) {
    $arrayItem = array("label" => $row['school'], "y" => $row['count']);
    array_push($dataPoints, $arrayItem);
}

$db->close();
?>

<script>
     window.onload = function() {

          var chart = new CanvasJS.Chart("chartContainer", {
               animationEnabled: true,
               title: {
                    text: "Students by school"
               },
               data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
               }]
          });
          chart.render();

     }
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<hr /><a href="/" >&lt;&lt; BACK</a>

