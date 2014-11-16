<?php

require_once 'DataAccessObject.php';

class StudentDAO implements DataAccessObject
{
    
    private $connection;
    
    function __construct($connection)
    {
        
        $this->connection = $connection;
        
    }
    
    
    public function select($studentId = "")
    {
        
        $query     = "SELECT * 
                      FROM   students
                      WHERE  student_id = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $studentId);
        $statement->execute();
        $statement->store_result();
        
        if($statement->num_rows > 0)
        {
        
            $statement->bind_result($id, $first_name, $insertion, $last_name, $mail, $mail_active, $sms, $sms_active, $phone, $phone_active, $group_identifier, $file_id);
            $statement->fetch();
            
            $student = new Student($id, $first_name, $insertion, $last_name, $mail, $mail_active, $sms, $sms_active, $phone, $phone_active, $group_identifier, $file_id); 

        }
        else
        {
            
            $student = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $student;
        
    }
    
    
    public function selectAll($id = "")
    {

        $query     = "SELECT * 
                      FROM students
                      ORDER BY student_first_name";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->execute();
        $statement->store_result();
        
        $studentData = array();
        
        if($statement->num_rows > 0)
        {
            
            $statement->bind_result($id, $first_name, $insertion, $last_name, $mail, $mail_active, $sms, $sms_active, $phone, $phone_active, $group_identifier, $file_id);

            while($statement->fetch())
	    {
                $student = new Student($id, $first_name, $insertion, $last_name, $mail, $mail_active, $sms, $sms_active, $phone, $phone_active, $group_identifier, $file_id); 

                $studentData[] = $student;
            }    
        }
        else
        {
            
            $studentData = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $studentData;
        
    }
    
    public function edit($student)
    {
        
        $u_id = $student->getId();
        $u_student_first_name = $student->getFirstName();
        $u_student_insertion = $student->getInsertion();
        $u_student_last_name = $student->getLastName();
        $u_student_contact_mail = $student->getMail();
        $u_student_contact_mail_active = $student->getMailActive();
        $u_student_contact_sms = $student->getSms();
        $u_student_contact_sms_active = $student->getSmsActive();
        $u_student_contact_phone = $student->getPhone();
        $u_student_contact_phone_active = $student->getPhoneActive();
        $u_group_identifier = $student->getGroupIdentifier();
        $u_file_id = $student->getFileId();
        
        $query     = "UPDATE students 
                      SET    student_first_name = ?, student_insertion = ?, student_last_name = ?,
                             student_contact_mail = ?, student_contact_mail_active = ?, student_contact_sms = ?,
                             student_contact_sms_active = ?, student_contact_phone = ?, student_contact_phone_active = ?,
                             group_identifier = ?, file_id = ?
                      WHERE  student_id = ?";

        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("ssssssssssss", $u_student_first_name, $u_student_insertion, $u_student_last_name, 
                                              $u_student_contact_mail, $u_student_contact_mail_active, $u_student_contact_sms,
                                              $u_student_contact_sms_active, $u_student_contact_phone, $u_student_contact_phone_active,
                                              $u_group_identifier, $u_file_id, $u_id);
        $statement->execute();
        $statement->close();
        
    }
    

    public function add($student)
    {
               
        $u_student_first_name = $student->getFirstName();
        $u_student_insertion = $student->getInsertion();
        $u_student_last_name = $student->getLastName();
        $u_student_contact_mail = $student->getMail();
        $u_student_contact_mail_active = $student->getMailActive();
        $u_student_contact_sms = $student->getSms();
        $u_student_contact_sms_active = $student->getSmsActive();
        $u_student_contact_phone = $student->getPhone();
        $u_student_contact_phone_active = $student->getPhoneActive();
        $u_group_identifier = $student->getGroupIdentifier();
        $u_file_id = $student->getFileId();
        
        $query     = "INSERT INTO students (student_first_name, student_insertion, student_last_name,
                                  student_contact_mail, student_contact_mail_active, student_contact_sms,
                                  student_contact_sms_active, student_contact_phone, student_contact_phone_active,
                                  group_identifier, file_id) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        

        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("sssssssssss", $u_student_first_name, $u_student_insertion, $u_student_last_name, 
                                              $u_student_contact_mail, $u_student_contact_mail_active, $u_student_contact_sms,
                                              $u_student_contact_sms_active, $u_student_contact_phone, $u_student_contact_phone_active,
                                              $u_group_identifier, $u_file_id);
        $statement->execute();   
                
        $statement->close();
         
    }

    public function delete($id)
    {
        
        $query     = "DELETE 
                      FROM  students 
                      WHERE student_id = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $statement->close();
        
        $query     = "DELETE 
                      FROM  students_presence
                      WHERE student_id = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $statement->close();
        
    }
    
     /**
     * Search a student in the database.
     * 
     * @param type $searchText  The name of the student.
     */
    public function studentSearch($searchText)
    {
        
        $searchText = "*" . $searchText . "*";
	
	$query     = "SELECT *
                      FROM   students
                      WHERE  MATCH(student_first_name) AGAINST (? IN BOOLEAN MODE)";
	
        
        $statement = $this->connection->prepareQuery($query);
        
        $statement->bind_param("s", $searchText);

        $statement->execute();
        $statement->bind_result($id, $student_first_name, $student_insertion, $student_last_name, 
                                $student_contact_mail, $student_contact_mail_active, $student_contact_sms,
                                $student_contact_sms_active, $student_contact_phone, $student_contact_phone_active,
                                $group_identifier, $file_id);
        
        $studentData = array();
        
        while($statement->fetch())
        {
                    
            $studentData[] = new Student($id, $first_name, $insertion, $last_name, $mail, $mail_active, $sms, $sms_active, $phone, $phone_active, $group_identifier, $file_id); 

        }
        
        $statement->close();
        
        return $studentData;
        
    }
    
    
    public function selectAllByGroup($id = "")
    {

        $query     = "SELECT * 
                      FROM students
                      WHERE group_identifier = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        
        $statement->bind_result($id, $first_name, $insertion, $last_name, $mail, $mail_active, $sms, $sms_active, $phone, $phone_active, $group_identifier, $file_id);
        
        $studentData = array();

        while($statement->fetch())
        {
            $studentData[] = new Student($id, $first_name, $insertion, $last_name, $mail, $mail_active, $sms, $sms_active, $phone, $phone_active, $group_identifier, $file_id);
        }    
        
        $statement->close();

        return $studentData;
        
    }
        
    
    
}

?>