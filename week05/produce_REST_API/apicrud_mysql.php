<?php
# https://www.leaseweb.com/labs/2015/10/creating-a-simple-rest-api-in-php/

# URL components should look like this: http://localhost/api.php/{$table}/{$id}

# it is assumed that the first column in the table is the primary key

define("DEBUG", 0);
define("DATABASE", "school");

#===============================================
# get the HTTP method, path and body of the request
#===============================================
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
 
#===============================================
# Create database or open if it already exists
#===============================================
// connect to the mysql server
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysqli_error($link));
}
// Make the current database
$db_selected = mysqli_select_db($link, DATABASE);
if (!$db_selected) {
  // If we couldn't, then it either doesn't exist, or we can't see it.
  $sql = 'CREATE DATABASE ' . DATABASE;

  if (!mysqli_query($link, $sql)) {
      echo 'Error creating database: ' . mysqli_error($link) . "\n";
  }
}

mysqli_set_charset($link,'utf8');

#===============================================
# Create Students table IF NO EXIST
#===============================================
$SQL_create_table = "CREATE TABLE IF NOT EXISTS Students (
  id int(11) NOT NULL auto_increment,
  FirstName VARCHAR(80),
  LastName VARCHAR(80),
  School VARCHAR(50),
  PRIMARY KEY  (`id`)
);";
if (!mysqli_query($link, $SQL_create_table)) {
    echo 'Error creating database: ' . mysqli_error($link) . "\n";
}

#===============================================
# Insert data if table is empty
#===============================================
$result = mysqli_query($link,"SELECT COUNT(*) as count FROM Students");
$row = $result->fetch_assoc();
if ($row['count'] == 0) {
    $SQL_insert_data = "INSERT INTO Students (FirstName, LastName, School) 
    VALUES 
    ('Tom', 'Max', 'Science'),
    ('Ann', 'Fay', 'Mining'),
    ('Joe', 'Sun', 'Nursing'),
    ('Sue', 'Fox', 'Computing'),
    ('Mia', 'Day', 'Science'),
    ('Tim', 'Doe', 'Computing'),
    ('Jan', 'Lee', 'Nursing'),
    ('Ben', 'Ray', 'Mining')
    ";

    if (!mysqli_query($link, $SQL_insert_data)) {
      echo 'Error creating database: ' . mysqli_error($link) . "\n";
    }
}

if (DEBUG == 1) {
    echo "<h3>request</h3>";
    var_dump($request);
}

#===============================================
# retrieve the table from the path
#===============================================
if (isset($request[0])) {
    $table = $request[0];

    if (DEBUG == 1) {
        echo "<h3>table</h3>";
        var_dump($table);
    }
} else {
    $table = NULL;
}

#===============================================
# retrieve the key from the path
#===============================================
if (isset($request[1])) {
    $key = $request[1];
    if (DEBUG == 1) {
        echo "<h3>key</h3>";
        var_dump($key);
    }
} else {
    $key = NULL;
}

if (DEBUG == 1) {
    echo "<h3>input</h3>";
    var_dump($input);
}
 
#===============================================
# get columns & values then construct insert & update
#===============================================
if (isset($input)) {
    // escape the columns and values from the input object
    $columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
    $values = array_map(function ($value) use ($link) {
    if ($value===null) return null;
    return mysqli_real_escape_string($link,(string)$value);
    },array_values($input));
    
    // build the SET part of the SQL command
    $set = '';
    for ($i=0;$i<count($columns);$i++) {
    $set.=($i>0?',':'').'`'.$columns[$i].'`=';
    $set.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
    }
}
#===============================================
# Get first column name and assume it is PK
#===============================================
$sqlMeta = "SELECT * FROM `$table` LIMIT 1";
$ref = mysqli_query($link, $sqlMeta);
$row = mysqli_fetch_assoc($ref);
$keys = array_keys($row);
$pk = $keys[0];
 
#===============================================
# create SQL based on HTTP method
#===============================================
switch ($method) {
  case 'GET':
    $sql = "SELECT * FROM `$table`".($key?" WHERE $pk=$key":''); break;
  case 'PUT':
    $sql = "UPDATE `$table` SET $set WHERE $pk=$key"; break;
  case 'POST':
    $sql = "INSERT INTO `$table` SET $set"; break;
  case 'DELETE':

    $sql = "DELETE FROM `$table` WHERE $pk=$key"; 
    if (DEBUG == 1) {
        echo "<h3>SQL</h3>";
        var_dump($sql);
    }
    break;
}
 
#===============================================
# excecute SQL statement
#===============================================
$result = mysqli_query($link,$sql);
 
#===============================================
# die if SQL statement failed
#===============================================
if (!$result) {
  http_response_code(404);
  die(mysqli_error($link));
}

if (DEBUG == 1) {
    echo "<h3>JSON</h3>";
}

#===============================================
# print results, insert id or affected row count
#===============================================
if ($method == 'GET') {
  header('Content-type:application/json;charset=utf-8');
  if (!$key) echo '[';
  for ($i=0;$i<mysqli_num_rows($result);$i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
  }
  if (!$key) echo ']';
} elseif ($method == 'POST') {
  echo mysqli_insert_id($link);
} else {
  echo mysqli_affected_rows($link);
}
 
#===============================================
# close SQLite connection
#===============================================
mysqli_close($link);

?>