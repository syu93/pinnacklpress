<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pinnackl</title>
        <meta name="description" content="description de ma page">


        <link href="assets/css/header.css" rel="stylesheet" media="all"/>
        <link href="assets/css/footer.css" rel="stylesheet" media="all"/>
        <link href="assets/css/form.css" rel="stylesheet" media="all"/>
        <link href="assets/css/main.css" rel="stylesheet" media="all"/>

        <script type="text/javascript" src="assets/js/libs/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="assets/js/coreAjax.js"></script>

    </head>
    <body>

        <?php
            $requestURI = explode('/', $_SERVER['REQUEST_URI']);
            $scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
             
            for($i= 0;$i < sizeof($scriptName);$i++)
                    {
                  if ($requestURI[$i] == $scriptName[$i])
                          {
                            unset($requestURI[$i]);
                        }
                  }
             
            $command = array_values($requestURI);
        ?>
        
        <?php include("header.tpl"); ?>


        <div  class="content">
            <section >
                <div>
                    <form method="post" action="controller/formControle.php" class="login">
                        <label>Login</label>
                        <input type="text" name="pseudo"><br>
                        <label>Password*</label>
                        <input type="password" name="mdp"><br>
                        <input type="submit" value="Connexion" name="signin">
                    </form>
                    <a href="">S'inscrire</a>

                    <form method="POST" action="corePHP.php" class="">
                        <div id="error"><?php //echo $displayErr ?></div>
                        <input type="radio" name="genre" value="homme" checked required> Monsieur
                        <input type="radio" name="genre" value="femme" required> Madame
                        <span id="msgErr_gender"><?php if(!empty($msgErr_gender))echo $msgErr_gender ?></span>
                            </br></br>
                        Nom <input type="text" name="nom" required>
                        <span id="msgErr_name"><?php if(!empty($msgErr_name))echo $msgErr_name ?></span>
                            </br></br>
                        Prenom <input type="text" name="prenom" required>
                        <span id="msgErr_fistName"><?php if(!empty($msgErr_fistName))echo $msgErr_fistName ?></span>
                            </br></br>
                        Email <input type="email" name="email" required>
                        <span id="msgErr_mail_1">
                            <?php if(!empty($msgErr_mail_1)){
                                echo $msgErr_mail_1;
                            }if(!empty($msgErr_mail_2)){
                                echo $msgErr_mail_2;
                            }if(!empty($msgErr_mail_3)){
                                echo $msgErr_mail_3;
                            } ?>
                        </span>
                            </br></br>
                        Confirmation Email <input type="email" name="confirmEmail" required>
                        <span id="msgErr_mail_2"><?php //if(!empty($))echo  ?></span>
                            </br></br>
                        Pseudo <input type="login" name="pseudo" required>
                        <span id="msgErr_pseudo"><?php //if(!empty($))echo  ?></span>
                            </br></br>
                        Mot de passe <input type="password" name="mdp" maxlength="8" required>
                        <span id="msgErr_psw_1"><?php //if(!empty($))echo  ?></span>
                            </br></br>
                        Confirmation Mdp<input type="password" name="confirmMdp" maxlength="8" required>
                        <span id="msgErr_psw_2"><?php //if(!empty($))echo  ?></span>
                            </br></br>
                        Date de naissance <input type="date" name="dateNaissance" placeholder="JJ/MM/AAAA" required>
                        <span id="msgErr_date"><?php //if(!empty($))echo  ?></span>
                            </br></br>
                        <input type="submit" name="valider" value="valider"></br></br>
                    </form>
                </div>

            </section>

            <section class="">
                <div>

                </div>

            </section>
        </div>

        <aside>
        </aside>

        <?php include("footer.tpl"); ?>
    </body>
</html>
