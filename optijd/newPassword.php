<?php
session_start();
require 'includes/Settings.php';
require 'includes/classes/DataBase/DataBase.php';
require 'includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require 'includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require 'includes/classes/DataBase/Teacher/Teacher.php';

if(isset($_GET["email"]))
{
    $email = $_GET["email"];
}
else
{
    $email = "";
}

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);

$error = "";
$message = "";

$emailExist = $teacherDAO->checkEmailExist($email);

//check if the formdata have been sent
if($emailExist == true && isset($_POST['recover']))
{
   if(empty($_POST['password']))
   {
       $error = "Het wachtwoord veld is leeg";
   }
   elseif(empty($_POST['rePassword']))
   {
       $error = "Het wachtwoord herhalen veld is leeg";
   }
   else
   {
       if($_POST['password'] != $_POST['rePassword'])
       {
           $error = "De twee ingevoerde wachtwoorden komen niet overeen";
       }
       else
       {
           $password = $_POST['password'];

           $teacherDAO->editPassword($email, $password);

           $message = "Uw wachtwoord is veranderd. <br />
                      <a href='login.php'>Klik hier om terug te keren naar het login scherm.</a>";
       }
   }
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="images/logo.png" />
        <link rel="stylesheet" type="text/css" href="css/style.css"  />
        <title>Wachtwoord herstellen</title>
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <h1 class="textCenter"><a href="login.php">Wachtwoord herstellen</a></h1>
                
                <?php
                if($error != "")
                {
                ?>
                 <div class="error">
                    <?php
                        echo $error;
                    ?>
                 </div>
                <?php
                }
                elseif($message != "")
                {
                ?>
                <div class="messageForm">
                    <?php
                        echo $message;
                    ?>
                </div>
                <?php
                }
                ?>
                
                <form class="form3" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <fieldset>
                        <div class="inputField">
                            <label for="password">Wachtwoord *</label>
                            <input id="password" type="password" name="password" value="" /><br />
                        </div>
                        <br />
                        <div class="inputField">
                            <label for="rePassword">Wachtwoord herhalen *</label>
                            <input id="rePassword" type="password" name="rePassword" value="" /><br />
                        </div>
                        
                        <div class="submitButton2">
                            <input type="submit" name="recover" value="Versturen" />
                        </div>
                        
                        <br />
                    </fieldset>
                </form>
                <p class="required textCenter">Velden met een * zijn verplicht</p>
            </div>
        </div>
    </body>
</html>