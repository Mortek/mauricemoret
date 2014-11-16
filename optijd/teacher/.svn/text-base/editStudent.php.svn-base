<?php
session_start();
require '../includes/Settings.php';
require '../includes/classes/DataBase/DataBase.php';
require '../includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require '../includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require '../includes/classes/DataBase/Teacher/Teacher.php';
require '../includes/classes/DataBase/DataAccessObject/StudentDAO.php';
require '../includes/classes/DataBase/Student/Student.php';

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);
$studentDAO = new StudentDAO($dataBase);

$teacher = $teacherDAO->checkTeacherLoggedIn();

$students = $studentDAO->selectAll();

if(isset($_POST['back']))
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
        <title>Leerling wijzigen</title>
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
                
                <h1 class="floatLeft centerH1"><a href="index.php">Leerling wijzigen</a></h1>
                
                <div class="group clearFix">
                    <table class="notPresenceList">
                        <tr>
                            <th class="toLeLeft">Naam</th>
                            <th></th>
                            <th></th>
                        </tr>
                    <?php
                    foreach($students as $student)
                    { 
                    ?>
                        <tr>
                            <td><?php echo " " . $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName(); ?></td>
                            <td class="textCenter"><a href="changeStudent.php?student_id=<?php echo $student->getId(); ?>">Wijzigen</a></td>
                            <td><a href="deleteStudent.php?student_id=<?php echo $student->getId(); ?>"><img class="deletePng2" src="../images/delete.png" alt="delete_image" /></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </table> 
                </div>
                
            </div>    
        </div>
    </body>
</html>