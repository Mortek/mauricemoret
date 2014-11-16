<?php
session_start();
require '../includes/Settings.php';
require '../includes/classes/DataBase/DataBase.php';
require '../includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require '../includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require '../includes/classes/DataBase/Teacher/Teacher.php';
require '../includes/classes/DataBase/Group/Group.php';
require '../includes/classes/DataBase/DataAccessObject/StudentDAO.php';
require '../includes/classes/DataBase/Student/Student.php';

if(isset($_GET["group_id"]))
{
    $groupId = $_GET["group_id"];
}
else
{
    $groupId= "";
}

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);
$studentDAO = new StudentDAO($dataBase);

$teacher = $teacherDAO->checkTeacherLoggedIn();

$allStudents = $studentDAO->selectAllByGroup($groupId);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="../images/logo.png" />
        <link rel="stylesheet" type="text/css" href="../css/style.css"  />
        <title>Groepen beheren</title>
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <div class="backButton">
                     <input type="button" value="Terug" onclick="history.back()" />
                </div>
                
                <h1 class="floatLeft centerH1">Groep <?php echo $groupId; ?> beheren</h1>
                
                <div class="group clearFix">
                    <span class="bold">Leerlingen in groep <?php echo $groupId; ?>:</span> <br />
                    <?php
                    foreach($allStudents as $student)
                    { 
                    ?>
                        <?php echo " " . $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName(); ?><br />
                    <?php
                    } 
                    ?>
                </div>
                    
            </div>    
        </div>
    </body>
</html>