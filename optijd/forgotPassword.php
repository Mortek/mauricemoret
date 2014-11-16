<?php
session_start();
require 'includes/Settings.php';
require 'includes/classes/DataBase/DataBase.php';
require 'includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require 'includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require 'includes/classes/DataBase/Teacher/Teacher.php';

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);

$error = "";
$message = "";

//check if the formdata have been sent
if(isset($_POST['recover']))
{
    $teacherEmail = $_POST['email'];
    
    //check if the required fields are not empty, otherwise request a error
    if(empty($_POST['email']))
    {
        $error = "Voer uw emailadres in";
    }
    else 
    {

        $emailExist = $teacherDAO->checkEmailExist($teacherEmail);
        
        if($emailExist == false)
        {

           $error = "Dit emailadres is niet correct";

        }
        else
        {
            // get the teacher by looking at its email address
            $teacherByEmail = $teacherDAO->selectTeacherByEmail($teacherEmail);
            // puts the username into a variable
            $teacherName = $teacherByEmail->getFirstName();

            //give message to teacher
            $message = "Er is een email gestuurd naar " . $teacherEmail;
            // the message that will be added to the email
            
            $messageTeacher = $teacherDAO->passwordRecovery($teacherEmail, $teacherName);

            //send email to user
            $teacherDAO->sendEmail($teacherEmail, "Nieuw wachtwoord", $messageTeacher);
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
                
                <p class="textCenter">Voer een geldig emailadres in</p>
                
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
                
                <form class="form3" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <fieldset>
                        <div class="inputField">
                            <label for="email">Email *</label>
                            <input id="email" type="text" name="email" value="" /><br />
                        </div>
                        
                        <div class="submitButton2">
                            <input type="submit" name="recover" value="Versturen" />
                        </div>
                        
                        <br />
                    </fieldset>
                </form>
                <p class="required textCenter">Het veld met een * is verplicht</p>
            </div>
        </div>
    </body>
</html>