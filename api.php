<?php

require("phpsqlajax_dbinfo.php");


error_reporting(E_ERROR | E_PARSE);

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

// connect to the mysql database
$link = mysqli_connect('localhost', $username, $password, $database);
mysqli_set_charset($link,'utf8');

if (!$link) { 
		die('Could not connect: ' . mysql_error());  
		echo $link->error;
	}

	if(isset($_GET['Message'])){
		popup($_GET['Message']);
	}

	if(isset($_POST['register'])){
		$stmt = $link->prepare('CALL add_user(?,?,?,?,?,?,?,?)');
		$stmt->bind_param('ssssssss', 
			$name, 	$password,  $mail
			);


		$name 		= $_POST["name"];
		$password 	= $_POST["password"];
		$passwordrep= $_POST["passwordrep"];
    $mail		= $_POST["mail"];

        	if($name == "" 
			or $mail == "" 
			or $name == "" 
			) { 
        	header('Location: signup.php?Message='.urlencode('All fields must be filled!'));
		}
		else if($password != $passwordrep){
			header('Location: signup.php?Message='.urlencode('password missmatch'));
		}
		else{ 

			$stmt->execute();
			
			#$sql = "CALL add_user('$username','$email', '$name','$address', $postalcode,'$country',$phone,'$password')"; 
			#mysqli_query($conn,$sql);             
			if($link->error){ 
				header('Location: signup.php?Message='.urlencode($conn->error));
			}       
			else{ 
				$_SESSION['A_C'] = "Account created!";
				header('Location: index.php');
			}

			//this had to be closed last
			$stmt->close();
		}
	}
// retrieve the table and key from the path
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$key = array_shift($request)+0;

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

// create SQL based on HTTP method
switch ($method) {
  case 'GET':
    $sql = "select * from `$table`".($key?" WHERE id=$key":''); break;
  case 'PUT':
    $sql = "update `$table` set $set where id=$key"; break;
  case 'POST':
    $sql = "insert into `$table` set $set"; break;
  case 'DELETE':
    $sql = "delete from `$table` where id=$key"; break;
}

// excecute SQL statement
$result = mysqli_query($link,$sql);

// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error());
}

// print results, insert id or affected row count
if ($method == 'GET') {
  if (!$key) echo '[';
  for ($i=0;$i<mysqli_num_rows($result);$i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
  }
  if (!$key) echo ']';
} elseif ($method == 'POST') {
  echo '{ "success":true, "data":[ { "id":'.mysqli_insert_id($link).' }]}';
} else {
  echo mysqli_affected_rows($link);
}

// close mysql connection
mysqli_close($link);
