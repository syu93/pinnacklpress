<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__."\controller\common.php");
require_once(__ROOT__."\model\dbconnect.php");
require_once(__ROOT__."\model\getusers.php");
$arrayErr="";
function signin($POST){
	$erreur = 0;
	$messageErreur="";
	/*****************/
	/*****CodeErr*****/
	/*****************/
	// 0 -> All required field not filled
	// 1 -> Un-valid email address given
	// 2 -> Email giver already exit
	// 3 -> Both email given are not the same
	// 4 -> Password given do not respect requirement
	// 5 -> Both password given are not the same
	// 6 -> Pseudo given do not respect requirement 
	// 7 -> 
	$arrayErr = array(
		'0' => "", 
		'1' => "", 
		'2' => "", 
		'3' => "", 
		'4' => "", 
		'5' => "", 
		'6' => "", 
		'7' => ""
	);

	$pseudo		  = "";
	$nom 		  = "";
	$prenom 	  = "";
	$genre  	  = "";
	$email  	  = "";
	$confirmEmail = "";
	$mdp = "";
	$confirmMdp	 = "";
	if(isset($POST["valider"])){ // AJAX later on

		/*******************************************************************/
		/****************************NOT REQUIRE****************************/
		/*******************************************************************/
		// On regarde si il n'y a pas de champs vides
		if( !empty($POST["genre"]) ){
			$genre  	  = variable_control($POST["genre"]);
		}
		if( !empty($POST["nom"]) ){
			$nom 		  = variable_control($POST["nom"]);
		}
		if( !empty($POST["prenom"]) ){
			$prenom 	  = variable_control($POST["prenom"]);
		}

		/*******************************************************************/
		/****************************REQUIRE********************************/
		/*******************************************************************/
		// On regarde si il n'y a pas de champs vides
		if( !empty($POST["dateNaissance"]) ){
		/*******************************************************************/
		/********************************DATE*******************************/
		/*******************************************************************/
			// FIXME : Check the date format
		}
		if( !empty($POST["mdp"]) && !empty($POST["confirmMdp"]) ){
			// FIXME : Check for password
		}
		if( !empty($POST["email"]) ){
			$email  	  = variable_control_full($POST["email"]);

				$messageErreur .= get_error("validemail", $email, null, $erreur);
				$messageErreur .= get_error("existemail", $email, null, $erreur);
		}
		if( !empty($POST["email"]) && !empty($POST["confirmEmail"]) ){
		/*******************************************************************/
		/********************************EMAIL******************************/
		/*******************************************************************/
			$email  	  = variable_control_full($POST["email"]);
			$confirmEmail = variable_control_full($POST["confirmEmail"]);

				$messageErreur .= get_error("email", $email, $confirmEmail, $erreur);
				$messageErreur .= get_error("validemail", $email, null, $erreur);
				$messageErreur .= get_error("existemail", $email, null, $erreur);
		}
		if(!empty($POST["pseudo"])){
			/*******************************************************************/
			/********************************PSEUDO*****************************/
			/*******************************************************************/
			$pseudo 	  = variable_control($POST["pseudo"]);

				$messageErreur .= get_error("existpseudo", $pseudo, null, $erreur);
		}
		// Database register
		// if nb error = 0 -> Register
	}	
	return $messageErreur;
}

function get_error($item, $parm1, $parm2 = null, $erreur, $error = $arrayErr){
	$msg = "";
	switch ($item) {
		case 'email':
			if($parm1 != $parm2){
				$codeErr = 3;
				$msg = "Les champs ".$item." doivent être identique.\r\n";
				$erreur++;

			}
			break;

		case 'validemail':
			if(!filter_var($parm1, FILTER_VALIDATE_EMAIL)){
				$codeErr = 1;
				$msg = "Vous devez saisir une adresse email valide.\r\n";
				$erreur++;
			}
			break;

		case 'existemail':
			$link = db_connect();
			$result = db_get_user($link, $parm1);
			if( $result->fetch()[0] == "1"){
				$codeErr = 2;
				$msg = "Cette adresse email est déjà utilisé.\r\n";
				$erreur++;
			}
			break;

		case 'existpseudo':
			$link = db_connect();
			$result = db_get_user($link, $parm1, "pseudo");
			if( $result->fetch()[0] == "1"){
				$codeErr = 6;
				$msg = "Ce pseudo est déjà utilisé.\r\n";
				$erreur++;
			}
			break;

		case 'password':
			if($parm1 != $parm2){
				$codeErr = 5;
				$msg = "Les champs ".$item." doivent être identique.\r\n";
				$erreur++;
			}
			break;
		
		default:
				$codeErr = 0;
				$msg = "Vous n'avez pas rempli tous les champs obligatoires(*).\r\n";
				$erreur++;
			break;
	}
	return $msg;
}