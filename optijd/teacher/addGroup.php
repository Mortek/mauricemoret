<?php
session_start();
require '../includes/Settings.php';
require '../includes/classes/DataBase/DataBase.php';
require '../includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require '../includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require '../includes/classes/DataBase/Teacher/Teacher.php';
require '../includes/classes/DataBase/DataAccessObject/GroupDAO.php';
require '../includes/classes/DataBase/Group/Group.php';

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

$error = "";

$teacher = $teacherDAO->checkTeacherLoggedIn();

$teacherId = $teacher->getId();
$allGroups = $teacherDAO->selectAllGroups($teacherId);

//check if the formdata have been sent
if(isset($_POST['add']))
{
    if(empty($_POST['group']) && empty($_POST['character']))
    {
        $error = "Voer een groepsnummer en karakter(A, B) in";
    }
    elseif(empty($_POST['group']))
    {
        $error = "Voer een groepsnummer in";
    }
    elseif($_POST['group'] > 8 || $_POST['group'] <= 0)
    {
        $error = "Voer een getal 1-8 in bij groepsnummer";
    }
    elseif(empty($_POST['character']))
    {
        $error = "Voer een karakter(A,B) in";
    }
    elseif(preg_match("/^[c-zC-Z]+$/i", $_POST['character']))
    {
        $error = "Voer een A of B in bij groepskarakter.";
    }
    else
    {
        if(!is_numeric($_POST['group']))
        {
            $error = "U mag geen tekst invoeren bij groepsnummer";
        }
        elseif(is_numeric($_POST['character']))
        {
            $error = "U mag geen getal invoeren bij groepskarakter";
        }
        elseif(is_numeric($_POST['group']) && is_string($_POST['character']))
        {
            $groupId = $_POST['group'];
            $groupChar = $_POST['character'];
            
            // Voeg groep toe in database
            $groupDAO->addTeacherGroupRelation($teacherId, $groupId.strtoupper($groupChar));

            header('location: teacher.php');

        }
    }
    
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
        <title>Groep toevoegen</title>
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
                
                <h1 class="floatLeft centerH1"><a href="index.php">Groep toevoegen</a></h1>

                <form class="addGroup clearFix" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <fieldset>
                        <div class="addGroupButton">
                            <input type="submit" name="add" value="Voeg toe" />
                        </div>
                        
                        <div class="inputField">
                            <label class="floatLeft" for="group">Groepsnummer (1-8)*</label>
                            <input class="floatLeft" id="group" type="text" name="group" value="" /><br />
                        </div>

                        <div class="inputField">
                            <label class="floatLeft" for="character">&nbsp;&nbsp;Groepskarakter (A of B)*</label>
                            <input class="floatLeft" id="character" type="text" name="character" value="" /><br />
                        </div>
                        
                        <div class="clearFix" />
                        <br />
                        <p class="required textCenter">Velden met een * zijn verplicht</p>
                        <?php
                        if($error != "")
                        {
                        ?>
                        <br />
                         <div class="error">
                            <?php
                                echo $error;
                            ?>
                         </div>
                        <?php
                        }
                        ?>
                    </fieldset>
                </form>
            </div> 
        </div>
    </body>
</html>