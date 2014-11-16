<?php
session_start();
require '../includes/Settings.php';
require '../includes/classes/DataBase/DataBase.php';
require '../includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require '../includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require '../includes/classes/DataBase/DataAccessObject/FileDAO.php';
require '../includes/classes/DataBase/Teacher/Teacher.php';
require '../includes/classes/DataBase/Group/Group.php';
require '../includes/classes/DataBase/File/File.php';

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);
$fileDAO = new FileDAO($dataBase);

$teacher = $teacherDAO->checkTeacherLoggedIn();

$teacherId = $teacher->getId();
$allGroups = $teacherDAO->selectAllGroups($teacherId);

if(isset($_POST['back']))
{
    header('location: choosePresence.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="shortcut icon" href="../images/logo.png" />
        <link rel="stylesheet" type="text/css" href="../css/style.css"  />
        <title>Selecteer een groep</title>
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
                
                <h1 class="floatLeft centerH1">Groepen</h1>
                
                
                <div class="group clearFix">
                    <p class="group clearFix">Selecteer een groep</p> <br />
                    <?php
                    foreach($allGroups as $group)
                    { 
                        //$file = $fileDAO->select($group->getFileId());
                    ?>
                       
                        <div class="group"><a href="goHome.php?group_id=<?php echo $group->getIdentifier(); ?>">- <?php echo $group->getName(); ?></a></div>
                        
                    <?php
                    }
                    ?>
                </div>
            </div>    
        </div>
    </body>
</html>
