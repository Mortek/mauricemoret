<?php
session_start();
require '../includes/Settings.php';
require '../includes/classes/DataBase/DataBase.php';
require '../includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require '../includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require '../includes/classes/DataBase/Teacher/Teacher.php';
require '../includes/classes/DataBase/DataAccessObject/GroupDAO.php';
require '../includes/classes/DataBase/Group/Group.php';
require '../includes/classes/DataBase/DataAccessObject/StudentDAO.php';
require '../includes/classes/DataBase/Student/Student.php';
require '../includes/classes/DataBase/DataAccessObject/PresenceDAO.php';
require '../includes/classes/DataBase/Presence/Presence.php';

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
$presenceDAO = new PresenceDAO($dataBase);

$students = array();

$teacher = $teacherDAO->checkTeacherLoggedIn();

$allStudents = $studentDAO->selectAllByGroup($groupId);

//check if the formdata have been sent
if(isset($_POST['checkPresence']))
{
    if(!empty($_POST['student']))
    {
        foreach($_POST['student'] as $value)  
        {

            $student = $studentDAO->select($value);

            array_push($students, $value);

        } 
        $_SESSION['students'] = $students;
        
        header('location: checkOutHome.php?group_id=' . $groupId);
    }
    else
    {
        header('location: checkOutHome.php?group_id=' . $groupId);
    }

} 
elseif(isset($_POST['back']))
{
    header('location: home.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="../images/logo.png" />
        <link rel="stylesheet" type="text/css" href="../css/style.css"  />
        <title>Afmelden</title>
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
                
                <h1 class="floatLeft centerH1"><a href="index.php">Afmelden</a></h1>
                
                <form class="checkPresence clearFix" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <fieldset>
                        <input type="hidden" id="date" name="date" value="<?php echo $date; ?>" />
                        <input type="hidden" id="presenceId" name="presenceId" value="" />
                        
                        <div class="checkPresenceButton">
                            <input type="submit" name="checkPresence" value="Verder" />
                        </div>

                        <div class="presence">
                            <p>Vink de leerlingen aan die naar huis gaan en klik op verder</p> <br />
                            <?php
                            foreach($allStudents as $student)
                            { 
                            ?>
                                
                                <input class="presenceList" type="checkbox" name="student[]" value="<?php echo $student->getId(); ?>" checked="checked"/><?php echo " " . $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName(); ?><br />
                            <?php
                            } 
                            ?>
                        </div>
                    </fieldset>
                </form>
                
            </div>    
        </div>
    </body>
</html>