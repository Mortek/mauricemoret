<?php
session_start();
require '../includes/Settings.php';
require '../includes/classes/DataBase/DataBase.php';
require '../includes/classes/DataBase/DataAccessObject/DataAccessObject.php';
require '../includes/classes/DataBase/DataAccessObject/TeacherDAO.php';
require '../includes/classes/DataBase/Teacher/Teacher.php';
require '../includes/classes/DataBase/Group/Group.php';

//connect db
$dataBase = new DataBase(Settings::DB_HOST, Settings::DB_USER,
	    Settings::DB_PASS, Settings::DB_NAME);

//connect data access objects
$teacherDAO = new TeacherDAO($dataBase);

$teacher = $teacherDAO->checkTeacherLoggedIn();

$teacherId = $teacher->getId();
$allGroups = $teacherDAO->selectAllGroups($teacherId);

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
        <title>Beheer groepen</title>
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
                
                <h1 class="floatLeft centerH1">Beheer groepen</h1>
                
                <div class="clearFix">
                    <p class="group">U geeft op dit moment les aan de volgende groepen</p> <br />
                    <hr />
                    <?php
                    foreach($allGroups as $group)
                    { 
                    ?>
                        
                        <div class="editGroup"><?php echo $group->getName(); ?> <a class="toLeRight" href="deleteRelation.php?group_id=<?php echo $group->getIdentifier(); ?>&amp;teacher_id=<?php echo $teacherId; ?>"><span class="toLeRight">ontkoppelen</span></a></div>
                        <hr />

                    <?php
                    } //einde foreach
                    ?>
                    <p class="addGroup"><a href="addGroup.php?teacher_id=<?php echo $teacherId; ?>">+ Groep koppelen</a></p>
                </div>
            </div>    
        </div>
    </body>
</html>