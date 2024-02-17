<?php
$endpoint = 'https://apipool.azurewebsites.net/api/toons';
$response = file_get_contents($endpoint);

$json = json_decode($response);

//var_dump($json)

?>

<html>
<h3>Consuming toons API at:</h3>
<h4><?php echo $endpoint?></h4>
<table>
    <tbody>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Occupation</th>
            <th>Gender</th>
            <th>Picture</th>
            <th>Votes</th>
        </tr>
        <?php foreach ($json as $item) { ?>
        <tr>
            <td> <?php echo $item->id; ?> </td>
            <td> <?php echo "$item->firstName $item->lastName"; ?> </td>
            <td> <?php echo $item->occupation; ?> </td>
            <td> <?php echo $item->gender; ?> </td>
            <td> <img style="width:30px" src="<?php echo $item->pictureUrl; ?>" alt="" /> </td>
            <td> <?php echo $item->votes; ?> </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<hr />
<?php
show_source("toons.php");
?>
</html>