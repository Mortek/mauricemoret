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

//check if the formdata have been sent
if(isset($_POST['login']))
{
    //check if the required fields are not empty, otherwise request a error
    if(empty($_POST['password']))
    {
        $error = "Voer een wachtwoord in";
    }
    //try to log in
    else 
    {
        $teacher = $teacherDAO->checkTeacher($_POST['password']);

        if ($teacher != null)
        {
            $_SESSION['logged_in'] = true;
            $_SESSION['teacher_id'] = $teacher->getId();

            header('location: teacher/index.php');
        }
        else 
        {
            // let the teacher wait 0.3 seconds before he can have another login attempt
            usleep(300000);

            $error = "Wachtwoord is niet correct";
        }
    }
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <link rel="shortcut icon" href="images/logo.png" />
        <link rel="stylesheet" type="text/css" href="css/style.css"  />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/touch-icon-ipad.png" />
        <title>Inloggen</title>
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <h1 class="textCenter">Wachtwoord</h1>
                <br />
                <img class="profilePic" src="images/profile_picture.png" alt="login pic" />
                
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
                ?>
                
                <form class="form3" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <fieldset>
                        <div class="inputField">
                            <input id="password" type="password" name="password" value="" /><br />
                        </div>
                        
                        <div class="submitButton2">
                            <input type="submit" name="login" value="Inloggen" />
                        </div>
                        <br />
                    </fieldset>
                </form>
                <p class="textCenter goRightPls"><a href="forgotPassword.php">Wachtwoord vergeten?</a></p>
            </div>
        </div>
    </body>
</html>