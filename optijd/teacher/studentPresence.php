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

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);
$studentDAO = new StudentDAO($dataBase);
$presenceDAO = new PresenceDAO($dataBase);

$i = 1;

$teacher = $teacherDAO->checkTeacherLoggedIn();

$student = $studentDAO->select($studentId);

$message = "";

$presences = $presenceDAO->select($studentId);

$countPresences = count($presences);

if(isset($_POST['back']))
{
    header('location: presenceList.php');
} 
elseif(isset($_POST['sendMessage']))
{
    $fullName = $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName();
    
    $messageMail = "Beste ouder / verzorger van " . $fullName . ", \n\n";
    $messageMail .= "Het is ons opgevallen dat " . $fullName . " in totaal al " . $countPresences . " keer afwezig is geweest. Wij maken ons hierdoor zorgen over de leerachterstand van " . $fullName . ". \n\n";
    $messageMail .= "Wij vragen u contact met ons op te nemen als uw kind door speciale omstandigheden zo vaak afwezig is. Op die manier kan er rekening gehouden worden met de speciale omstandigheden van " . $fullName . ".\n\n";
    $messageMail .= "Met vriendelijke groet.\n\n";
    $messageMail .= "CBS de Sleutel \n\n";
    $messageMail .= "Contactgegevens: \n";
    $messageMail .= "Telefoonnummer: 010 – 4 19 13 00\n";
    $messageMail .= "Email: c.vanpelt@cbsdesleutel.nl / m.zandbergen@cbsdesleutel.nl";

    $message = "De ouders / verzorgers zijn op de hoogte gesteld.";
    
    $teacherDAO->sendEmail($student->getMail(), $fullName, $messageMail);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="../images/logo.png" />
        <link rel="stylesheet" type="text/css" href="../css/style.css"  />
        <title>Afwezigheid van <?php echo $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName(); ?></title>
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
                
                <h1 class="floatLeft centerH1"><a href="index.php">Afwezigheid van <?php echo $student->getFirstName() . " " . $student->getInsertion() . " " . $student->getLastName(); ?></a></h1>
                
                <?php
                if($countPresences > 3)
                {?>
                   <div class="furtherButton">
                       <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                       <fieldset>
                           <input type="submit" name="sendMessage" value="Melding" />
                       </fieldset>
                       </form>
                   </div>
                
                   <p class="clearFix textCenter">Deze leerling is meer dan 3 keer afwezig geweest, klik op de knop melding om de ouders / verzorgers hiervan in te lichten</p>
                <?php
                }
                else
                {
                ?>
                    <p class="clearFix textCenter">Klik op het kruisje om de afwezigheid te verwijderen</p>
                <?php    
                }
                ?>
                
                <br />
                
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
                
                <div class="group">
                    <table class="notPresenceList">
                        <tr>
                            <th>Nummer</th>
                            <th>Reden</th>
                            <th>Datum</th>
                            <th></th>
                        </tr>
                    <?php
                    if(!empty($presences))
                    {
                        foreach($presences as $presence)
                        { 
                        ?>
                            <tr>
                                <td class="nr"><?php echo $i; ?></td>
                                <td class="reason"><?php echo $presence->getNotPresentReason(); ?></td>
                                <td class="date"><?php echo $presence->getPresenceDatetime(); ?></td>
                                <td class="delete"><a href="deletePresence.php?presence_id=<?php echo $presence->getId(); ?>&amp;student_id=<?php echo $studentId; ?>"><img class="deletePng" src="../images/delete.png" alt="delete_image" /></a></td>
                            </tr>
                        <?php
                            $i++;
                        }
                    }
                    else
                    {   
                    ?>
                        <tr>
                            <td class="nr"></td>
                            <td class="reason"></td>
                            <td class="date"></td>
                            <td class="delete"></td>
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
