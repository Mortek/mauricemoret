<?php

require_once 'DataAccessObject.php';


class TeacherDAO implements DataAccessObject
{
    
    private $connection;
    
    function __construct($connection)
    {
        
        $this->connection = $connection;
        
    }
    
    
    public function select($teacherId = "")
    {
        
        $query     = "SELECT * 
                      FROM   teachers
                      WHERE  teacher_id = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $teacherId);
        $statement->execute();
        $statement->store_result();
        
        if($statement->num_rows > 0)
        {
        
            $statement->bind_result($id, $first_name, $insertion, $last_name, $password, $email);
            $statement->fetch();
            
            $teacher = new Teacher($id, $first_name, $insertion, $last_name, $password, $email); 

        }
        else
        {
            
            $teacher = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $teacher;
        
    }
    
    
    public function selectAll($id = "")
    {

        $query     = "SELECT * 
                      FROM teachers
                      ORDER BY teacher_first_name";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->execute();
        $statement->store_result();
        
        $teacherData = array();
        
        if($statement->num_rows > 0)
        {
            
            $statement->bind_result($id, $first_name, $insertion, $last_name, $password, $email);

            while($statement->fetch())
	    {
                $teacher = new Teacher($id, $first_name, $insertion, $last_name, $password, $email); 

                $teacherData[] = $teacher;
            }    
        }
        else
        {
            
            $teacherData = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $teacherData;
        
    }
   
    public function edit($teacher)
    {
        
        $u_id = $teacher->getId();
        $u_teacher_first_name = $teacher->getFirstName();
        $u_teacher_insertion = $teacher->getInsertion();
        $u_teacher_last_name = $teacher->getLastName();
        $u_teacher_password = $teacher->getPassword();
        $u_teacher_email = $teacher->getEmail();
        
        $query     = "UPDATE teachers 
                      SET    teacher_first_name = ?, teacher_insertion = ?, teacher_last_name = ?,
                             teacher_password = ?, teacher_email = ?
                      WHERE  teacher_id = ?";

        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("ssssss", $u_teacher_first_name, $u_teacher_insertion, $u_teacher_last_name, 
                                              $u_teacher_password, $u_teacher_email, $u_id);
        $statement->execute();
        $statement->close();
        
    }
    

    public function add($teacher)
    {
               
        $u_teacher_first_name = $teacher->getFirstName();
        $u_teacher_insertion = $teacher->getInsertion();
        $u_teacher_last_name = $teacher->getLastName();
        $u_teacher_password = $teacher->getPassword();
        $u_teacher_email = $teacher->getEmail();
        
        $query     = "INSERT INTO teachers (teacher_first_name, teacher_insertion, teacher_last_name,
                                  teacher_password, teacher_email) 
                             VALUES (?, ?, ?, ?, ?)";
        

        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("sssss", $u_teacher_first_name, $u_teacher_insertion, $u_teacher_last_name, 
                                              $u_teacher_password, $u_teacher_email);
        $statement->execute();   
                
        $statement->close();
         
    }
    
    public function delete($id)
    {
        
        $query     = "DELETE 
                      FROM  teachers 
                      WHERE teacher_id = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $statement->close();
        
    }
    
    
    public function checkTeacher($password)
    {
        
        $query     = "SELECT teacher_id, teacher_first_name, teacher_insertion, teacher_last_name, teacher_password, teacher_email
                      FROM teachers 
                      WHERE teacher_password = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("s", $password);
        

        $statement->execute();
        $statement->store_result();
        
        if($statement->num_rows > 0)
        {
        
            $statement->bind_result($id, $first_name, $insertion, $last_name, $password, $email);
            $statement->fetch();
            
            $teacher = new Teacher($id, $first_name, $insertion, $last_name, $password, $email);

        }
        else
        {
            
            $teacher = null;
            
        }
        
        $statement->free_result();
        $statement->close();
	
        return $teacher;
        
    }
    
    
    public function checkTeacherLoggedIn()
    {

	$teacher = null;
	
        if (isset($_SESSION['logged_in'])) 
        {
	    
            $teacherId = $_SESSION['teacher_id'];
            
            $teacher = $this->select($teacherId);
            
        }
        else
        {
            header('location: ' . SETTINGS::ROOT_DIR);
        }
        
        return $teacher;
	
    }
    
    
    public function selectAllGroups($teacherId)
    {
        $query     = "SELECT g.group_id, g.group_name, g.file_id, g.group_identifier 
                      FROM `groups` g
                      INNER JOIN `teachers_has_groups` t
                              ON t.`group_identifier` = g.`group_identifier`
                      WHERE t.`teacher_id` = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $teacherId);
        $statement->execute();
       
        $statement->bind_result($id, $group_name, $file_id, $group_identifier);
                 
        $groups = array();
        
        while($statement->fetch())
        {
                    
            $groups[] = new Group($id, $group_name, $file_id, $group_identifier);
            
        }
        
        $statement->close();
        
        return $groups;
    
    }
    
    
    public function checkEmailExist($email)
    {
        
        $query = "SELECT
                        teacher_email 
                    FROM 
                        teachers
                    WHERE 
                         teacher_email = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("s", $email);
        $statement->execute();
        $statement->store_result();
                
        $emailExist = ($statement->num_rows > 0) ? true : false;
        
        $statement->close();
        
        return $emailExist;
        
    }
    
    public function editPassword($email, $password)
    {
        
        $query     = "UPDATE teachers 
                      SET teacher_password = ?
                      WHERE teacher_email = ?";

        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("ss", $password, $email);
        $statement->execute();
        $statement->close();
        
    }
    
    public function passwordRecovery($teacherEmail, $teacherName)
    {
        $teacherInfo = "Beste " . $teacherName . ", \n\n";
        $teacherInfo .= "Klik op de onderstaande link om uw wachtwoord te veranderen: \n\n";
        $teacherInfo .= "http://www.mauricemoret.nl/optijd/newPassword.php?email=$teacherEmail\n\n";
        
        return $teacherInfo;
    }
    
    
    public function sendEmail($to, $subject, $message)
    {
        //default message in every email sended to the user
        $headers = 'Van: CBS De Sleutel'; 
        
        mail($to, $subject, $message, $headers);
        
    }
    
    
    public function selectTeacherByEmail($email)
    {
        
        $query     = "SELECT * 
                      FROM   teachers
                      WHERE  teacher_email = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("s", $email);
        $statement->execute();
        $statement->store_result();
        
        if($statement->num_rows > 0)
        {
        
            $statement->bind_result($id, $first_name, $insertion, $last_name, $password, $email);
            $statement->fetch();
            
            $teacher = new Teacher($id, $first_name, $insertion, $last_name, $password, $email); 

        }
        else
        {
            
            $teacher = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $teacher;
        
    }
    
    
    /*
    public function teacherSearch($searchText)
    {
        
        $searchText = "*" . $searchText . "*";
	
	$query     = "SELECT *
                      FROM   teachers
                      WHERE  MATCH(teacher_first_name) AGAINST (? IN BOOLEAN MODE)";
	
        
        $statement = $this->connection->prepareQuery($query);
        
        $statement->bind_param("s", $searchText);

        $statement->execute();
        $statement->bind_result($id, $teacher_first_name, $teacher_insertion, $teacher_last_name, 
                                $teacher_contact_mail, $teacher_contact_mail_active, $teacher_contact_sms,
                                $teacher_contact_sms_active, $teacher_contact_phone, $teacher_contact_phone_active,
                                $group_id, $teacher_presence_id);
        
        $teacherData = array();
        
        while($statement->fetch())
        {
                    
            $teacherData[] = new teacher($id, $first_name, $insertion, $last_name, $mail, $mail_active, $sms, $sms_active, $phone, $phone_active, $group_id, $presence_id); 

        }
        
        $statement->close();
        
        return $teacherData;
        
    }*/
        
    
    
}

?>