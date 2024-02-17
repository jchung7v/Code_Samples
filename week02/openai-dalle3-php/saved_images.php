<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Saved Images</title>
    <style>
        body {
            padding: 20px;
        }
        button {
            margin-bottom: 20px;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h3>Saved Images</h3>
    <a href="/" class="btn btn-small btn-primary back-button">&lt;&lt; BACK</a>
    <?php
    include('database.php');

    if ($DBConnect !== FALSE) {
        $TableName = "images";
        $SQLstring = "SELECT imageID, prompts, saved_date FROM $TableName";
        if ($QueryResult = mysqli_query($DBConnect, $SQLstring)) {
            echo "<table width='100%' class='table table-striped'>\n";
            echo "<tr><th>Image ID</th><th>Prompt</th><th>Saved Date</th></tr>\n";
            while ($Row = mysqli_fetch_array($QueryResult, MYSQLI_ASSOC)) {
                echo "<tr><td>{$Row['imageID']}</td>";
                echo "<td><a href='?image_id={$Row['imageID']}'>{$Row['prompts']}</a></td>";
                echo "<td>{$Row['saved_date']}</td></tr>\n";
            }
            echo "</table>\n";
            mysqli_free_result($QueryResult);
        }
    }

    if(isset($_GET['image_id'])) {
        $imageId = $_GET['image_id'];
        $TableName = "images";
        $SQLstring = "SELECT base64 FROM $TableName WHERE imageID = ?";

        if ($stmt = mysqli_prepare($DBConnect, $SQLstring)) {
            mysqli_stmt_bind_param($stmt, "i", $imageId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                if ($row['base64'] != null) {
                    echo '<img src="data:image/jpeg;base64,' . $row['base64'] . '"/>';
                } else {
                    echo "<p>Image data is not available.</p>";
                }
            } else {
                echo "<p>No image found for this ID.</p>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<p>Error preparing statement: " . mysqli_error($DBConnect) . "</p>";
        }
    }

    mysqli_close($DBConnect);
    ?>
</body>
</html>

