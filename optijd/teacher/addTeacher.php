<?php
session_start();
require '../includes/Settings.php';
require '../includes/classes/DataBase/DataBase.php';
require '../includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require '../includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require '../includes/classes/DataBase/Teacher/Teacher.php';

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);

$teacher = $teacherDAO->checkTeacherLoggedIn();

$error = "";
$message = "";

//check if the formdata have been sent
if(isset($_POST['add']))
{
    if(empty($_POST['firstName']))
    {
        $error = "Het veld voornaam is niet ingevoerd.";
    }
    elseif(empty($_POST['lastName']))
    {
        $error = "Het veld achternaam is niet ingevoerd.";
    }
    elseif(empty($_POST['password']))
    {
        $error = "Het veld wachtwoord is niet ingevoerd.";
    }
    elseif(empty($_POST['email']))
    {
        $error = "Het veld emailadres is niet ingevoerd.";
    }
    else
    {
        //add teacher to the db
        $teacher = new Teacher($_POST['id'], $_POST['firstName'], $_POST['insertion'], $_POST['lastName'], $_POST['password'], $_POST['email']);

        $teacherDAO->add($teacher);
        
        //message the user that it has succeeded
        $message = "De docent is toegevoegd.";
    }
    
}
elseif(isset($_POST['back']))
{
    header('location: admin.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="../images/logo.png" />
        <link rel="stylesheet" type="text/css" href="../css/style.css"  />
        <title>Docent toevoegen</title>
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <div class="backButton">
                    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <fieldset>
                        <input type="submit" name="back" value="Terug" />
                    </fieldset>
                    </form>
                </div>
                
                <h1 class="floatLeft centerH1"><a href="index.php">Docent toevoegen</a></h1>

                <form class="form3 clearFix" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <fieldset>
                        <div class="inputField">
                            <label class="floatLeft" for="firstName">Voornaam*</label>
                            <input class="floatLeft" id="firstName" type="text" name="firstName" value="" /><br />
                        </div>
                        
                        <div class="inputField">
                            <label class="floatLeft" for="insertion">Tussenvoegsel</label>
                            <input class="floatLeft" id="insertion" type="text" name="insertion" value="" /><br />
                        </div>
                        
                        <div class="inputField">
                            <label class="floatLeft" for="lastName">Achternaam*</label>
                            <input class="floatLeft" id="lastName" type="text" name="lastName" value="" /><br />
                        </div>
                        
                        <div class="inputField">
                            <label class="floatLeft" for="password">Wachtwoord*</label>
                            <input class="floatLeft" id="password" type="password" name="password" value="" /><br />
                        </div>
                        
                        <div class="inputField">
                            <label class="floatLeft" for="email">Emailadres*</label>
                            <input class="floatLeft" id="email" type="text" name="email" value="" /><br />
                        </div>
                        
                        <input type="hidden" id="id" name="id" value="" />
                        
                        <div class="submitButton2 clearFix">
                            <input type="submit" name="add" value="Docent toevoegen" />
                        </div>
                        
                        <br />
                    </fieldset>
                </form>
                <p class="required textCenter">Velden met een * zijn verplicht</p>
                <br />
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
            </div>    
        </div>
    </body>
</html>