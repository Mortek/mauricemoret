<?php

require_once 'DataAccessObject.php';


class PresenceDAO implements DataAccessObject
{
    
    private $connection;
    
    function __construct($connection)
    {
        
        $this->connection = $connection;
        
    }
    
    
    public function select($studentId = "")
    {
        
        $query     = "SELECT * 
                      FROM   students_presence
                      WHERE  student_id = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $studentId);
        $statement->execute();
        $statement->store_result();
        
        $presenceData = array();
        
        if($statement->num_rows > 0)
        {
            
            $statement->bind_result($presence_id, $student_id, $not_present_reason, $presence_datetime);

            while($statement->fetch())
	    {
                $presence = new Presence($presence_id, $student_id, $not_present_reason, $presence_datetime); 

                $presenceData[] = $presence;
            }    
        }
        else
        {
            
            $presenceData = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $presenceData;
    }
    
    
    public function selectAll($id = "")
    {

        $query     = "SELECT * 
                      FROM students_presence";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->execute();
        $statement->store_result();
        
        $presenceData = array();
        
        if($statement->num_rows > 0)
        {
            
            $statement->bind_result($presence_id, $student_id, $not_present_reason, $presence_datetime);

            while($statement->fetch())
	    {
                $presence = new Presence($presence_id, $student_id, $not_present_reason, $presence_datetime); 

                $presenceData[] = $presence;
            }    
        }
        else
        {
            
            $presenceData = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $presenceData;
        
    }
    
    
    public function selectAllLimit($id = "")
    {

        $query     = "SELECT * 
                      FROM students_presence
                      GROUP BY student_id
                      ORDER BY student_presence_id";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->execute();
        $statement->store_result();
        
        $presenceData = array();
        
        if($statement->num_rows > 0)
        {
            
            $statement->bind_result($presence_id, $student_id, $not_present_reason, $presence_datetime);

            while($statement->fetch())
	    {
                $presence = new Presence($presence_id, $student_id, $not_present_reason, $presence_datetime); 

                $presenceData[] = $presence;
            }    
        }
        else
        {
            
            $presenceData = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $presenceData;
        
    }
    
   
    public function edit($presence)
    {
        
        $u_id = $presence->getId();
        $u_student_id = $presence->getStudentId();
        $u_not_present_reason = $presence->getNotPresentReason();
        $u_presence_datetime = $presence->getPresenceDatetime();
        
        $query     = "UPDATE students_presence
                      SET    student_id = ?, student_not_present_reason = ?, student_presence_datetime = ?
                      WHERE  student_presence_id = ?";

        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("ssss", $u_student_id, $u_not_present_reason, $u_presence_datetime, $u_id);
        $statement->execute();
        $statement->close();
        
    }
    

    public function add($presence)
    {
               
        $u_id = $presence->getId();
        $u_student_id = $presence->getStudentId();
        $u_not_present_reason = $presence->getNotPresentReason();
        $u_presence_datetime = $presence->getPresenceDatetime();
        
        $query     = "INSERT INTO students_presence (student_id, student_not_present_reason, student_presence_datetime) 
                             VALUES (?, ?, ?)";
        

        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("sss", $u_student_id, $u_not_present_reason, $u_presence_datetime);
        $statement->execute();   
                
        $statement->close();
         
    }

    public function delete($id)
    {
        
        $query     = "DELETE 
                      FROM  students_presence
                      WHERE student_presence_id = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $statement->close();
        
    }
    
    
    public function countPresence($studentId)
    {
        $query     = "SELECT COUNT(*)
                      FROM   students_presence
                      WHERE  student_id = ?";
       
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $studentId);
        $statement->execute();
        $statement->store_result();
        
        if($statement->num_rows > 0)
        {
        
            $count = $statement->bind_result($count);
            $statement->fetch();
         

        }
        else
        {
            
            $count = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $count;
    }
        
    
    
}

?>