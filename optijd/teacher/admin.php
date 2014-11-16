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

if(isset($_POST['addStudent']))
{
    header('location: addStudent.php');
}
elseif(isset($_POST['addTeacher']))
{
    header('location: addTeacher.php');
}
elseif(isset($_POST['editStudent']))
{
    header('location: editStudent.php');
}
elseif(isset($_POST['editTeacher']))
{
    header('location: editTeacher.php');
} 
elseif(isset($_POST['signStudentOut']))
{
    header('location: signStudentOut.php');
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
        <title>Administratie</title>
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
                
                <h1 class="floatLeft centerH1">Administratie</h1>
                
                <div class="clearFix" />
                
                <div class="admin">
                    <form class="floatLeft form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                       <fieldset>
                           <div class="submitButton marginSubmitButton">
                              <input type="submit" name="addStudent" value="Leerling toevoegen" />
                           </div>
                       </fieldset>
                    </form>

                    <form class="floatLeft form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <fieldset>
                            <div class="submitButton marginSubmitButton2">
                                <input type="submit" name="addTeacher" value="Docent toevoegen" />
                            </div>
                        </fieldset>
                    </form>
                    
                    <div class="clearFix" />

                    <form class="floatLeft form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <fieldset>
                            <div class="submitButton marginSubmitButton">
                                <input type="submit" name="editStudent" value="Leerlingen beheren" />
                            </div>
                        </fieldset>
                    </form>

                    <form class="floatLeft form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <fieldset>
                            <div class="submitButton marginSubmitButton2">
                                <input type="submit" name="editTeacher" value="Docenten beheren" />
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>   
                <div class="clearFix adminReport">
                    <form class="form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <fieldset>
                            <div class="submitButton">
                                <input type="submit" name="signStudentOut" value="Leerling afmelden" />
                            </div>
                        </fieldset>
                    </form>
                </div>
        </div>
    </body>
</html>