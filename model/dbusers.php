<?php
function db_get_user($link, $value, $case = "email"){
	switch ($case) {
		case 'email':
				$req = $link -> prepare("SELECT CASE WHEN EXISTS ( SELECT ".$case." FROM pp_users WHERE email = :value )THEN 1 ELSE 0 END ");
				$req->execute(array(
					':value' => $value
				));
			break;
		case 'pseudo':
				$req = $link -> prepare("SELECT CASE WHEN EXISTS ( SELECT ".$case." FROM pp_users WHERE pseudo = :value )THEN 1 ELSE 0 END ");
				$req->execute(array(
					':value' => $value
				));
			break;

		case 'connexion':
				$req = $link -> prepare("SELECT pseudo, email, password, status, role FROM pp_users WHERE email = :value");
				$req->execute(array(
					':value' => $value
				));
			break;
		
		default:
			# code...
			break;
	}
	return $req;
}

function db_create_user($link, $gender, $name, $firstname, $email, $password, $pseudo, $date){
	try{
		$req = $link -> prepare("INSERT INTO pp_users 
			(gender, firstname, name, pseudo, email, password, birth_date)
			VALUES( :gender,
					:firstname,
					:name,
					:pseudo,
					:email,
					:password,
					:birth_date) ");
		$success = $req->execute(array(
					':gender' => $gender,
					':firstname' => $firstname,
					':name' => $name,
					':pseudo' => $pseudo,
					':email' => $email,
					':password' => $password,
					':birth_date' => $date
				));
		return $success;
	}
	catch( PDOException $e ){
		
		debug($e);
		die();
	}
}