<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>OpenAI Dalle3 Image Generator</title>
    <style>
        body {
            padding: 20px;
        }
        .back-button {
            margin-bottom: 20px;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h3>OpenAI Dalle3 Image Generator</h3>

    <div class="container">
        <form role ="form" method="post">
            <label for="prompt">Describe the image:</label>
            <input class="form-control form-control-lg custom-height" type="text" name="prompt" style="height: 100px;" />
            <br>
            <input class="btn btn-success" type="submit" name="generate" value="Generate Image" />
            <input class="btn btn-primary" type="submit" name="save" value="Save Image" />
            <input class="btn btn-warning" type="reset" value="Clear" />
            <a href="./saved_images.php"><button type="button" class="btn btn-primary">View Saved Images</button></a>
        </form>
    </div>
    <br>

    <div class="container">

    <!-- Go through the tutorial at https://blog.medhat.ca/2024/01/php-meets-openai-with-image-generation.html
    Using the base-64 option, develop a PHP web app that behaves similar to https://aipanorama.azurewebsites.net/
    Everytime the user requests an image, the description (prompt) and base-64 representation of the image are saved in the database.
    Add another page to your app that displays all the contents. When user clicks on a line item then the image is displayed. -->

    <?php
        session_start();

        require_once __DIR__ . '/vendor/autoload.php';

        include('database.php');

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        
        $client = OpenAI::client($_ENV['OPENAI_API_KEY']);

        $base64Image = isset($_SESSION['base64Image']) ? $_SESSION['base64Image'] : null;
        $prompt = isset($_POST['prompt']) ? $_POST['prompt'] : null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['generate']) && $prompt) {
                $_SESSION['prompt'] = $prompt;
                $response = $client->images()->create([
                    'model' => 'dall-e-3',
                    'prompt' => $prompt,
                    'n' => 1,
                    'size' => '1024x1024',
                    'response_format' => 'b64_json',
                ]);
                foreach ($response->data as $data) {
                    $base64Image = $data->b64_json;
                    $_SESSION['base64Image'] = $base64Image;
                }
            } else {
                echo "<br>";
                echo "Prompt can't be left empty. Please try again.";
            }

            if(isset($_POST["save"])) {
                $prompt = $_SESSION['prompt'];
                $base64Image = $_SESSION['base64Image'];
                $SavedDate = date("Y-m-d");
                $SQLstring = "INSERT INTO $TableName " .
                "(prompts, saved_date, base64) VALUES " .
                "('$prompt', '$SavedDate', '$base64Image')";
                $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                if ($QueryResult === FALSE) {
                    echo "<p>Unable to insert the values into the $TableName table.</p>"
                    . "<p>Error code " . mysqli_errno($DBConnect)
                    . ": " . mysqli_error($DBConnect) . "</p>";
                } else {
                        echo '<script>alert("Image is saved.")</script>';
                }
            }
        }

        if (!empty($base64Image)) {
            echo '<img src="data:image/jpeg;base64,' . $base64Image. '"/>';
        }
        
        // echo "<p>MySQL connection: " . mysqli_get_host_info($DBConnect) . "</p>\n";
        // echo "<p>MySQL protocol version: " . mysqli_get_proto_info($DBConnect) . "</p>\n";
        // echo "<p>MySQL server version: " . mysqli_get_server_info($DBConnect) . "</p>\n";

        $DBConnect->close();
    ?>

    </div>

</body>
</html>