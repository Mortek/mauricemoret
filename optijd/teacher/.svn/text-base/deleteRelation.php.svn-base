<?php
session_start();
require '../includes/Settings.php';
require '../includes/classes/DataBase/DataBase.php';
require '../includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require '../includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require '../includes/classes/DataBase/Teacher/Teacher.php';
require '../includes/classes/DataBase/DataAccessObject/GroupDAO.php';
require '../includes/classes/DataBase/Group/Group.php';

if(isset($_GET["group_id"]))
{
    $groupId = $_GET["group_id"];
}
else
{
    $groupId= "";
}

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
$groupDAO = new GroupDAO($dataBase);

$message = "";

$teacherDAO->checkTeacherLoggedIn();

if(isset($_POST['nee']))
{
    header('location: teacher.php');;
}
elseif(isset($_POST['ja']))
{
    $groupDAO->deleteTeacherGroupRelation($teacherId, $groupId);
    
    $message = "<br /> Groep " . $groupId . " is ontkoppeld.
                <br /> <br /> <a href='teacher.php'>Klik hier om terug te keren.</a>";
}
elseif(isset($_POST['back']))
{
    header('location: teacher.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="../images/logo.png" />
        <link rel="stylesheet" type="text/css" href="../css/style.css"  />
        <title>Groep <?php echo $groupId;?> ontkoppelen</title>
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
                
                <h1 class="floatLeft centerH1"><a href="index.php">Groep <?php echo $groupId;?> ontkoppelen</a></h1>
                
                <p class="clearFix textCenter">Weet u zeker dat u groep <?php echo $groupId ?> wilt ontkoppelen?</p>
                <br />
                 <form class ="form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                     <fieldset>       
                         <div class="submitButton">
                             <input type="submit" name="nee" value="Nee, terug" />
                         </div>

                         <div class="submitButton">
                             <input type="submit" name="ja" value="Ja, ontkoppelen" />
                         </div>
                    </fieldset>
                </form>
                
                <?php
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