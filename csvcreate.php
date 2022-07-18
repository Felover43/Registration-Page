<?php

require_once("config.php");
global $pdo;


$error = "";

// get all user_data that hasn't been shown yet (shown=0)
$stmt = $pdo->prepare("SELECT institute,first,last,id,email,htele,mtele,birth,immigrate,gender,country,ethnic 
				FROM user_data WHERE shown=0");
$stmt->execute();									
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);


 if(!$stmt){													
        $error = $pdo->errorInfo();								
    }
  else{
	//all data used will be considered shown (shown=1) so we wont use again
	$stmt = $pdo->prepare("UPDATE user_data SET shown=1");
	$stmt->execute();									

$delimiter=";";
//export file
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=export.csv');

$f = fopen('php://output', 'w');
//loops on all lines of data of all the students, seperates them via commas and adds then to the file
foreach ($res as $line) {  
    fputcsv($f, $line, $delimiter);   
}
}





?>
