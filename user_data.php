<?php
//a config fill in the ftp for db data like user,pass,db_name 
require_once("config.php");
global $pdo;


//allow access for post
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type');

$error 	= "";

		
		
	//inserts all the data to the server
		$stmt = $pdo->prepare("INSERT INTO user_data (institute,first,last,id,email,htele,mtele,birth,immigrate,gender,country,ethnic)
					 VALUES (:insti_v,:first_v,:last_v,:id_v,:email_v,:htele_v,:mtele_v,:birth_v,:immigrate_v,:gender_v,:country_v,:ethnic_v)");
		$stmt->bindValue(':insti_v', $_POST[institute]);
		$stmt->bindValue(':first_v', $_POST[first]);
		$stmt->bindValue(':first_v', $_POST[first]);
		$stmt->bindValue(':last_v', $_POST[last]);
		$stmt->bindValue(':id_v', $_POST[id]);
		$stmt->bindValue(':email_v', $_POST[email]);
		$stmt->bindValue(':htele_v', $_POST[htele]);
		$stmt->bindValue(':mtele_v', $_POST[mtele]);
		$stmt->bindValue(':birth_v', $_POST[birth]);
		$stmt->bindValue(':immigrate_v', $_POST[immigrate]);
		$stmt->bindValue(':gender_v', $_POST[gender]);
		$stmt->bindValue(':country_v', $_POST[country]);
		$stmt->bindValue(':ethnic_v', $_POST[ethnic]);	
		$stmt->execute();											

		//server failure or mismatch data
		if(!$stmt){												
			$error = $pdo->errorInfo();								
		}
	

$result = "";												

if($error == ""){											
    $result = array ('success'=>true);	
}
else{														
    $result = array ('success'=>false, 'message'=>$error);	
}
	//response from post
    echo json_encode($result);								
?>