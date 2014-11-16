<?php
session_start();
require '../includes/Settings.php';
require '../includes/classes/DataBase/DataBase.php';
require '../includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require '../includes/classes/DataBase/DataAccessObject/StudentDAO.php';
require '../includes/classes/DataBase/Student/Student.php';
require '../includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require '../includes/classes/DataBase/Teacher/Teacher.php';

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);
$studentDAO = new StudentDAO($dataBase);

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
    elseif(empty($_POST['mail']))
    {
        $error = "Het veld email is niet ingevoerd.";
    }
    elseif(empty($_POST['group']))
    {
        $error = "Het veld groepsnummer is niet ingevoerd.";
    }
    elseif(empty($_POST['character']))
    {
        $error = "Het veld groepskarakter is niet ingevoerd.";
    }
    elseif(preg_match("/^[c-zC-Z]+$/i", $_POST['character']))
    {
        $error = "Voer een A of B in bij groepskarakter.";
    }
    elseif($_POST['group'] > 8 || $_POST['group'] <= 0)
    {
        $error = "Voer een getal 1-8 in bij groepsnummer";
    }
    elseif(!is_numeric($_POST['group']))
    {
        $error = "U mag geen tekst invoeren bij groepsnummer";
    }
    elseif(is_numeric($_POST['character']))
    {
        $error = "U mag geen getal invoeren bij groepskarakter";
    }
    else
    {
        $mailActive = 0;
        $smsActive = 0;
        $phoneActive = 0;

        if(!empty($_POST['mail']))
        {
            $mailActive = 1;
        }
        if(!empty($_POST['sms']))
        {
            $smsActive = 1;
        }
        if(!empty($_POST['phone']))
        {
            $phoneActive = 1;
        }

        //add teacher to the db
        $student = new Student($_POST['id'], $_POST['firstName'], $_POST['insertion'], $_POST['lastName'],
                               $_POST['mail'], $mailActive, $_POST['sms'], $smsActive, $_POST['phone'], $phoneActive, $_POST['group'].strtoupper($_POST['character']), $_POST['fileId']);

        $studentDAO->add($student);
        
        //message the user that it has succeeded
        $message = "De leerling is toegevoegd.";
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
        <title>Leerling toevoegen</title>
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
                
                <h1 class="floatLeft centerH1"><a href="index.php">Leerling toevoegen</a></h1>
                
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
                            <label class="floatLeft" for="mail">Emailadres*</label>
                            <input class="floatLeft" id="mail" type="text" name="mail" value="" /><br />
                        </div>
                        
                        <div class="inputField">
                            <label class="floatLeft" for="sms">SMS</label>
                            <input class="floatLeft" id="sms" type="text" name="sms" value="" /><br />
                        </div>
                        
                        <div class="inputField">
                            <label class="floatLeft" for="phone">Telefoonnummer</label>
                            <input class="floatLeft" id="phone" type="text" name="phone" value="" /><br />
                        </div>
                        
                        <div class="inputField">
                            <label class="floatLeft" for="group">Groepsnummer (1-8)*</label>
                            <input class="floatLeft" id="group" type="text" name="group" value="" /><br />
                        </div>
                        
                        <div class="inputField">
                            <label class="floatLeft" for="character">Groepskarakter (A of B)*</label>
                            <input class="floatLeft" id="character" type="text" name="character" value="" /><br />
                        </div>
                        
                        <input type="hidden" id="id" name="id" value="" />
                        <input type="hidden" id="fileId" name="fileId" value="" />
                        
                        <div class="submitButton2 clearFix">
                            <input type="submit" name="add" value="Leerling toevoegen" />
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