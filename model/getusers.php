<?php
function db_get_user($link, $value, $case = "email"){
	switch ($case) {
		case 'email':
				$req = $link -> prepare("SELECT CASE WHEN EXISTS ( SELECT ".$case." FROM utilisateur WHERE email = :value )THEN 1 ELSE 0 END ");
				$req->execute(array(
					':value' => $value
				));
			break;
		case 'pseudo':
				$req = $link -> prepare("SELECT CASE WHEN EXISTS ( SELECT ".$case." FROM utilisateur WHERE pseudo = :value )THEN 1 ELSE 0 END ");
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

function db_create_user($link, $genre, $name, $firstname, $email, $password, $pseudo, $date){
	try{
		$req = $link -> prepare("INSERT INTO utilisateur 
			(genre, nom, prenom, email, pseudo, mdp, date_naissance, statut)
			VALUES( :genre,
					:nom,
					:prenom,
					:email,
					:pseudo,
					:mdp,
					:date_naissance,
					:statut)");
		$success = $req->execute(array(
					':genre' => $genre,
					':nom' => $name,
					':prenom' => $firstname,
					':email' => $email,
					':pseudo' => $pseudo,
					':mdp' => $password,
					':date_naissance' => $date,
					':statut' => 1
				));
		return $success;
	}
	catch( PDOException $e ){
		
		debug($e);
		die();
	}
}