<?php
$endpoint = 'http://localhost:8888/apicrud_sqlite.php/students';
$response = file_get_contents($endpoint);

$json = json_decode($response);

//var_dump($json)

?>

<html>
<h3>Consuming students API at:</h3>
<h4><?php echo $endpoint?></h4>
<table>
    <tbody>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>School</th>
        </tr>
        <?php foreach ($json as $item) { ?>
        <tr>
            <td> <?php echo $item->id; ?> </td>
            <td> <?php echo "$item->FirstName $item->LastName"; ?> </td>
            <td> <?php echo $item->School; ?> </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<hr />
<?php
show_source("students.php");
?>
</html>