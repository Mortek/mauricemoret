<?php
session_start();
require '../includes/Settings.php';
require '../includes/classes/DataBase/DataBase.php';
require '../includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require '../includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require '../includes/classes/DataBase/Teacher/Teacher.php';
require '../includes/classes/DataBase/DataAccessObject/StudentDAO.php';
require '../includes/classes/DataBase/Student/Student.php';
require '../includes/classes/DataBase/DataAccessObject/PresenceDAO.php';
require '../includes/classes/DataBase/Presence/Presence.php';

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);
$studentDAO = new StudentDAO($dataBase);
$presenceDAO = new PresenceDAO($dataBase);

$teacher = $teacherDAO->checkTeacherLoggedIn();

$presences = $presenceDAO->selectAllLimit();

if(isset($_POST['back']))
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
        <title>Afwezigheidslijst</title>
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
                
                <h1 class="floatLeft centerH1">Afwezigheidslijst</h1>
                
                <p class="textCenter clearFix">Klik op een leerling om de redenen van afwezigheid te bekijken</p>
                <br />
                <div class="group">
                    <table class="notPresenceList">
                        <tr>
                            <th>Naam</th>
                            <th>Totaal afwezig</th>
                        </tr>
                    <?php
                    foreach($presences as $presence)
                    { 
                        $student = $studentDAO->select($presence->getStudentId());
                    ?>
                        <tr>
                            <td><a href="studentPresence.php?student_id=<?php echo $presence->getStudentId(); ?>"><?php echo $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName(); ?></a></td>
                            <td><?php echo $presenceDAO->countPresence($presence->getStudentId()); ?></td>
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
