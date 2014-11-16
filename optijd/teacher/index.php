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
if(isset($_POST['choosePresence']))
{
    header('location: choosePresence.php');
}
elseif(isset($_POST['presence']))
{
    header('location: presenceList.php');
}
elseif(isset($_POST['teacher']))
{
    header('location: teacher.php');
}
elseif(isset($_POST['admin']))
{
    header('location: admin.php');
}
elseif(isset($_POST['logout']))
{
    header('location: ../logout.php');
} 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="../images/logo.png" />
        <link rel="stylesheet" type="text/css" href="../css/style.css"  />
        <title>Welkom <?php echo $teacher->getFirstName() . " " . $teacher->getInsertion() . " " . $teacher->getLastName(); ?></title>
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <div class="logoutButton">
                    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                       <fieldset>
                           <input type="submit" name="logout" value="Log uit" />
                       </fieldset>
                    </form>
                </div>
                
                <h1 class="floatLeft centerH1">Welkom <br /><?php echo $teacher->getFirstName() . " " . $teacher->getInsertion() . " " . $teacher->getLastName(); ?></h1>
                
                <div class="clearFix" />
                
                <div class="index">
                    <form class="floatLeft form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                       <fieldset>
                           <div class="submitButton marginSubmitButton">
                              <input type="submit" name="choosePresence" value="Aan en afmelden" />
                           </div>
                       </fieldset>
                    </form>

                    <form class="floatLeft form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                       <fieldset>
                           <div class="submitButton marginSubmitButton2">
                              <input type="submit" name="presence" value="Afwezigheidslijst" />
                           </div>
                       </fieldset>
                    </form>

                    <div class="clearFix"></div>
                   
                    <form class="floatLeft form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <fieldset>
                            <div class="submitButton marginSubmitButton">
                                <input type="submit" name="teacher" value="Groepen beheren" />
                            </div>
                        </fieldset>
                    </form>

                    <form class="floatLeft form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <fieldset>
                            <div class="submitButton marginSubmitButton2">
                                <input type="submit" name="admin" value="Administratie" />
                            </div>
                        </fieldset>
                    </form>

                    <div class="clearFix"></div>
                </div>
            </div>    
        </div>
    </body>
</html>