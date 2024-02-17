<!DOCTYPE html>
<html lang="en">

<head>
  <title>Connect and show databases</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container">
    <h1>Connect and show databases</h1>
    <?php
    # MySQL running on the metal (host computer)
    // $servername = "localhost";
    // $username = "root";
    // $password = "";

    # MySQL running in a Container
    $servername = "127.0.0.1:3333";
    $username = "root";
    $password = "secret";

    # Create connection
    $conn = new mysqli($servername, $username, $password);

    # Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    # SAhow all the databases in the server
    if (!($result = mysqli_query($conn, 'SHOW DATABASES')))
      die("Error: %s\n" . mysqli_error($conn));
    ?>

    <h3>Databases</h3>

    <?php
    while ($row = mysqli_fetch_row($result))
      echo $row[0] . "<br />";

    $conn->close();
    ?>
    <hr />
    <a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
  </div>
</body>

</html>