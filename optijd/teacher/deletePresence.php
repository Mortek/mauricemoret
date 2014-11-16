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
    $studentId = "";
}

if(isset($_GET["presence_id"]))
{
    $presenceId = $_GET["presence_id"];
}
else
{
    $presenceId = "";
}

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);
$studentDAO = new StudentDAO($dataBase);
$presenceDAO = new PresenceDAO($dataBase);

$message = "";

$teacher = $teacherDAO->checkTeacherLoggedIn();

if(isset($_POST['nee']))
{
    header('location: studentPresence.php?student_id='.$studentId.'');;
}
elseif(isset($_POST['ja']))
{
    // email verzenden
    $student = $studentDAO->select($studentId);
    $fullName = $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName();

    $messageMail = "Beste ouder / verzorger van " . $fullName . ", \n\n";
    $messageMail .= "Nadat wij u hier voor een bericht hebben gestuurd over de afwezigheid van " . $fullName . ", is " . $fullName . " op school aangekomen.\n\n";
    $messageMail .= "Wel maken wij een melding van het te laat komen van " . $fullName . ".\n\n";
    $messageMail .= "Met vriendelijke groet.\n\n";
    $messageMail .= "CBS de Sleutel \n\n";
    $messageMail .= "Contactgegevens: \n";
    $messageMail .= "Telefoonnummer: 010 – 4 19 13 00\n";
    $messageMail .= "Email: c.vanpelt@cbsdesleutel.nl / m.zandbergen@cbsdesleutel.nl";

    $teacherDAO->sendEmail($student->getMail(), $fullName, $messageMail);

    // ding deleten
    $presenceDAO->delete($presenceId);
    
    $message = "<br /> De afwezigheid is verwijderd en de ouders zijn op de hoogte gesteld.
                <br /> <br /> <a href='studentPresence.php?student_id=$studentId'>Klik hier om terug te keren.</a>";
}
elseif(isset($_POST['back']))
{
    header('location: studentPresence.php?student_id='.$studentId.'');
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="../images/logo.png" />
        <link rel="stylesheet" type="text/css" href="../css/style.css"  />
        <title>Afwezigheid verwijderen</title>
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
                
                <h1 class="floatLeft centerH1"><a href="index.php">Afwezigheid verwijderen</a></h1>
                
                <p class="clearFix textCenter">Weet u zeker dat u deze afwezigheid wilt verwijderen?</p>
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
