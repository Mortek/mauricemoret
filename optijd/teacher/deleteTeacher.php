<?php
session_start();
require '../includes/Settings.php';
require '../includes/classes/DataBase/DataBase.php';
require '../includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require '../includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require '../includes/classes/DataBase/Teacher/Teacher.php';
require '../includes/classes/DataBase/DataAccessObject/StudentDAO.php';
require '../includes/classes/DataBase/Student/Student.php';

if(isset($_GET["teacher_id"]))
{
    $teacherId = $_GET["teacher_id"];
}
else
{
    $teacherId= "";
}

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);
$studentDAO = new StudentDAO($dataBase);

$message = "";

$teacherDAO->checkTeacherLoggedIn();

$teacher = $teacherDAO->select($teacherId);

if(isset($_POST['nee']))
{
    header('location: editTeacher.php');;
}
elseif(isset($_POST['ja']))
{
    $teacherDAO->delete($teacherId);
    
    $message = $teacher->getFirstName() . " " . $teacher->getInsertion() . " " . $teacher->getLastName() . " is verwijderd. 
            <br /> <br /> <a href='editTeacher.php'>Klik hier om terug te keren.</a>";
}
elseif(isset($_POST['back']))
{
    header('location: editTeacher.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="../images/logo.png" />
        <link rel="stylesheet" type="text/css" href="../css/style.css"  />
        <title>Docent verwijderen</title>
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
                
                <h1 class="floatLeft centerH1"><a href="index.php">Docent verwijderen</a></h1>
                
                <p class="textCenter clearFix">Weet u zeker dat u <?php echo $teacher->getFirstName() . " " . $teacher->getInsertion() . " " . $teacher->getLastName(); ?> wilt verwijderen?</p>
                <br />
                
                 <form class ="form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                     <fieldset>       
                         <div class="submitButton">
                             <input type="submit" name="nee" value="Nee, terug" />
                         </div>

                         <div class="submitButton">
                             <input type="submit" name="ja" value="Ja, verwijderen" />
                         </div>
                    </fieldset>
                </form>
                <br />
                <?
                if($message != "")
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