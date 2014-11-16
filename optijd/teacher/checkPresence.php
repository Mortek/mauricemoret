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

$message = "";

if(isset($_POST['mail']))
{
    foreach($_SESSION['students'] as $studentId)
    {
        $student = $studentDAO->select($studentId);
        $fullName = $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName();
        
        $messageMail = "Beste ouder / verzorger van " . $fullName . ", \n\n";
        $messageMail .= "Wij hebben geen afmelding van u ontvangen. Toch is " . $fullName . " vandaag niet aanwezig in de klas. \n\n";
        $messageMail .= "Wij vragen u, uw kind alsnog af te melden, zodat wij weten dat " . $fullName . " geoorloofd afwezig is. \n\n";
        $messageMail .= "Mocht uw kind vandaag, na het versturen van dit bericht, toch op school komen,  zullen wij u een aanwezigheidsbericht sturen. \n\n\n";
        $messageMail .= "Met vriendelijke groet, \n\n";
        $messageMail .= "CBS de Sleutel \n\n";   
        $messageMail .= "Contactgegevens: \n";
        $messageMail .= "Telefoonnummer: 010 – 4 19 13 00\n";
        $messageMail .= "Email: c.vanpelt@cbsdesleutel.nl / m.zandbergen@cbsdesleutel.nl";
        
        $teacherDAO->sendEmail($student->getMail(), $fullName, $messageMail);
    } 
    
    $message = "<br /> De ouders zijn op de hoogte gesteld. <br /><br />
                <a href='index.php'>Klik hier om terug te keren naar het startscherm.</a>";
}
elseif(isset($_POST['back']))
{
    header('location: presence.php?group_id='.$groupId.'');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="../images/logo.png" />
        <link rel="stylesheet" type="text/css" href="../css/style.css"  />
        <title>Aanwezigheid</title>
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
                
                <h1 class="floatLeft centerH1"><a href="index.php">Afwezigen</a></h1>
                
                <div class="presence clearFix">
                    <?php
                    if(!empty($_SESSION['students']))
                    {
                        foreach($_SESSION['students'] as $studentId)
                        {
                            $student = $studentDAO->select($studentId);
                            echo $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName() . "<br />";
                        }
                        echo "<br />" . "<p>De bovenstaande leerlingen zijn afwezig. </p> <br />
                             <p>Klik op de knop meldingen versturen om de ouders / verzorgers op de hoogte te stellen.</p>";
                    ?>
                     <form class="form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <fieldset>
                            <div class="submitButton">
                                <input type="submit" name="mail" value="Meldingen versturen" />
                            </div>
                        </fieldset>
                    </form>
                    <?php
                    }
                    else
                    {
                        echo "Iedereen is aanwezig! <br />
                             <a href='index.php'>Klik hier om terug te keren naar het startscherm.</a>";
                    }
                    ?>
                    
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
        </div>
    </body>
</html>