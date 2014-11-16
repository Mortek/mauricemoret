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

//check if the formdata have been sent
if(isset($_POST['group']))
{
    header('location: group.php');
}
elseif(isset($_POST['home']))
{
    header('location: home.php');
}
elseif(isset($_POST['back']))
{
    header('location: index.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="../images/logo.png" />
        <link rel="stylesheet" type="text/css" href="../css/style.css"  />
        <title>Aanmelden en afmelden</title>
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
                
                <h1 class="floatLeft centerH1"><a href="index.php">Aan of afmelden</a></h1>
                
                <div class="index">
                    <form class="floatLeft form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                       <fieldset>
                           <div class="submitButton marginSubmitButton">
                              <input type="submit" name="group" value="Aanwezigheid" />
                           </div>
                       </fieldset>
                    </form>

                    <form class="floatLeft form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                       <fieldset>
                           <div class="submitButton marginSubmitButton2">
                              <input type="submit" name="home" value="Naar huis" />
                           </div>
                       </fieldset>
                    </form>

                    <div class="clearFix"></div>
                </div>
            </div>    
        </div>
    </body>
</html>
