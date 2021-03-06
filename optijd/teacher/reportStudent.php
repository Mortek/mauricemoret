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

if(isset($_GET["student_id"]))
{
    $studentId = $_GET["student_id"];
}
else
{
    $studentId= "";
}

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);
$studentDAO = new StudentDAO($dataBase);
$presenceDAO = new PresenceDAO($dataBase);

$date = date("Y-m-d H:i:s");
$error = "";
$message = "";

$teacher = $teacherDAO->checkTeacherLoggedIn();
$student = $studentDAO->select($studentId);

//check if the formdata have been sent
if(isset($_POST['submit']))
{
    if(empty($_POST['reason']))
    {
        $error = "Het veld reden is niet ingevoerd.";
    }
    else
    {
        //add presence to the db
        $presence = new Presence($_POST['presenceId'], $_POST['id'], $_POST['reason'], $_POST['date']);
        
        $presenceDAO->add($presence);
        
        //message the user that it has succeeded
        $message = $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName() . " is afgemeld.";
    }
    
}
elseif(isset($_POST['back']))
{
    header('location: signStudentOut.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="../images/logo.png" />
        <link rel="stylesheet" type="text/css" href="../css/style.css"  />
        <title><?php echo $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName(); ?> afmelden</title>
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
                
                <h1 class="floatLeft centerH1"><a href="index.php"><?php echo $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName(); ?> afmelden</a></h1>
                
                <form class="form2 clearFix" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <fieldset>
                        <div class="inputField">
                            <label class="floatLeft" for="reason">Reden van afwezigheid*</label>
                            <textarea class="floatLeft" id="reason" name="reason" value=""></textarea><br />
                        </div>

                        <input type="hidden" id="id" name="id" value="<?php echo $studentId; ?>" />
                        <input type="hidden" id="date" name="date" value="<?php echo $date; ?>" />
                        <input type="hidden" id="presenceId" name="presenceId" value="" />
                        
                        <div class="submitButton alignCenter clearFix">
                            <input type="submit" name="submit" value="Leerling afmelden" />
                        </div>
                        
                        <br />
                    </fieldset>
                </form>
                <p class="required textCenter">Velden met een * zijn verplicht</p>
                
                <br />
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
                elseif($message != "")
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