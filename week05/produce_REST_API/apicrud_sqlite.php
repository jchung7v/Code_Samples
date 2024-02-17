<?php
# https://www.leaseweb.com/labs/2015/10/creating-a-simple-rest-api-in-php/

# URL components should look like this: http://localhost/api.php/{$table}/{$id}

# it is assumed that the first column in the table is the primary key

# USAGE: 
#   http://localhost:8888/apicrud_sqlite.php/Students
#   http://localhost:8888/apicrud_sqlite.php/Students/3

define("DEBUG", 0);

#===============================================
# get the HTTP method, path and body of the request
#===============================================
$method = $_SERVER['REQUEST_METHOD'];
// Display a message if $_SERVER['PATH_INFO'] is not set
if (!isset($_SERVER['PATH_INFO'])) {
  echo "Proper usage is http://localhost:8888/apicrud_sqlite.php/Students/";
  exit;
}
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

#===============================================
# Create database or open if it already exists
#===============================================
$db = new SQLite3('school.sqlite');

#===============================================
# Create Students table IF NO EXIST
#===============================================
$SQL_create_table = "CREATE TABLE IF NOT EXISTS Students (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  FirstName VARCHAR(80),
  LastName VARCHAR(80),
  School VARCHAR(50)
);";
$db->exec($SQL_create_table);

#===============================================
# Insert data if table is empty
#===============================================
$rows = $db->query("SELECT COUNT(*) as count FROM Students");
$row = $rows->fetchArray();
$numRows = $row['count'];

if ($row['count'] === 0) {
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

  $db->exec($SQL_insert_data);
}

if (DEBUG === 1) {
  echo "<h3>request</h3>";
  var_dump($request);
}

#===============================================
# retrieve the table from the path
#===============================================
if (isset($request[0])) {
  $table = $request[0];

  if (DEBUG === 1) {
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
  if (DEBUG === 1) {
    echo "<h3>key</h3>";
    var_dump($key);
  }
} else {
  $key = NULL;
}

if (DEBUG === 1) {
  echo "<h3>input</h3>";
  var_dump($input);
}

#===============================================
# get columns & values then construct insert & update
#===============================================
if (isset($input)) {
  // escape the columns and values from the input object
  $columns = preg_replace('/[^a-z0-9_]+/i', '', array_keys($input));
  $values = array_map(function ($value) {
    if ($value === null) return null;
    return SQLite3::escapeString((string)$value);
  }, array_values($input));

  // build the SET part of the SQL command
  $insertSet = '';
  $insertVal = '';
  $updateSet = '';
  for ($i = 0; $i < count($columns); $i++) {
    $insertSet .= ($i > 0 ? ',' : '') . '`' . $columns[$i] . '`';
    $insertVal .= ($values[$i] === null ? 'NULL' : '"' . $values[$i] . '",');

    $updateSet .= ($i > 0 ? ',' : '') . '`' . $columns[$i] . '`=';
    $updateSet .= ($values[$i] === null ? 'NULL' : '"' . $values[$i] . '"');
  }

  $insertVal = str_replace("\"", "'", $insertVal);
  $insertVal = substr_replace($insertVal, "", -1);

  if (DEBUG === 1) {
    echo "<h3>set</h3>";
    echo "*" . $insertSet . "*";
    echo "<h3>val</h3>";
    echo "*" . $insertVal . "*";
  }
}

#===============================================
# Get first column name and assume it is PK
#===============================================
$result = $db->query("SELECT * FROM `$table`");
$pk = $result->columnName(0);

#===============================================
# create SQL based on HTTP method
#===============================================
switch ($method) {
  case 'GET':
    $sql = "SELECT * FROM `$table`" . ($key ? " WHERE $pk=$key" : '');
    break;
  case 'PUT':
    $sql = "UPDATE `$table` SET $updateSet WHERE $pk=$key";
    break;
  case 'POST':
    $sql = "INSERT INTO `$table` ($insertSet) VALUES ($insertVal)";
    break;
  case 'DELETE':
    $sql = "DELETE FROM `$table` WHERE $pk=$key";
    break;
}

if (DEBUG === 1) {
  echo "<h3>SQL</h3>";
  echo $sql;
}

#===============================================
# excecute SQL statement
#===============================================
$result = $db->query($sql);

#===============================================
# die if SQL statement failed
#===============================================
if (!$result) {
  http_response_code(404);
  die("Error in fetch " . $db->lastErrorMsg());
}

if (DEBUG === 1) {
  echo "<h3>JSON</h3>";
}

#===============================================
# print results, insert id or affected row count
#===============================================
if ($method == 'GET') {
  header('Content-type:application/json;charset=utf-8');
  $collection = [];
  while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $collection[] = $row;
  }
  if (count($collection) > 1)
    echo json_encode($collection);
  else {
    if (isset($collection[0]))
      echo json_encode($collection[0]);
    else
      http_response_code(404);
  }
} elseif ($method == 'POST') {
  echo $db->lastInsertRowid();
} else {
  echo $db->changes();
}

#===============================================
# close SQLite connection
#===============================================
$db->close();
