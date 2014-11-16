<?php

require_once 'DataAccessObject.php';

class GroupDAO implements DataAccessObject
{
    
    private $connection;
    
    function __construct($connection)
    {
        
        $this->connection = $connection;
        
    }
    
    
    public function select($groupId = "")
    {
        
        $query     = "SELECT * 
                      FROM   groups
                      WHERE  group_id = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $groupId);
        $statement->execute();
        $statement->store_result();
        
        if($statement->num_rows > 0)
        {
        
            $statement->bind_result($id, $name, $file, $identifier);
            $statement->fetch();
            
            $group = new Group($id, $name, $file, $identifier); 

        }
        else
        {
            
            $group = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $group;
        
    }
    
    
    public function selectAll($id = "")
    {

        $query     = "SELECT * 
                      FROM groups";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->execute();
        $statement->store_result();
        
        $groupData = array();
        
        if($statement->num_rows > 0)
        {
            
            $statement->bind_result($id, $name, $file, $identifier);

            while($statement->fetch())
	    {
                $group = new Group($id, $name, $file, $identifier); 

                $groupData[] = $group;
            }    
        }
        else
        {
            
            $groupData = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $groupData;
        
    }
    
    public function edit($group)
    {
        
        $u_id = $group->getId();
        $u_group_name = $group->getName();
        //$u_group_character = $group->getCharacter();
        $u_file_id = $group->getFileId();
        $u_group_identifier = $group->getIdentifier();
        
        $query     = "UPDATE groups 
                      SET    group_name = ?, file_id = ?, group_identifier = ?
                      WHERE  group_id = ?";

        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("ssss", $u_group_name, $u_file_id, $u_group_identifier, $u_id);
        $statement->execute();
        $statement->close();
        
    }
    

    public function add($group)
    {
               
        $u_id = $group->getId();
        $u_group_name = $group->getName();
        //$u_group_character = $group->getCharacter();
        $u_file_id = $group->getFileId();
        $u_group_identifier = $group->getIdentifier();
        
        $query     = "INSERT INTO groups (group_name, file_id, group_identifier) 
                             VALUES (?, ?, ?)";
        

        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("sss", $u_group_name, $u_group_identifier, $u_file_id);
        $statement->execute();   
                
        $statement->close();
         
    }
    
    public function delete($id)
    {
        
        $query     = "DELETE 
                      FROM  groups 
                      WHERE group_id = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $statement->close();
        
    }
    
    
    public function addTeacherGroupRelation($teacherId, $groupIdentifier)
    {
        $query     = "INSERT INTO teachers_has_groups (teacher_id, group_identifier) 
                             VALUES (?, ?)";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("is", $teacherId, $groupIdentifier);
        $statement->execute();   
                
        $statement->close();
    }
    
    public function deleteTeacherGroupRelation($teacherId, $groupIdentifier)
    {
        $query     = "DELETE 
                      FROM teachers_has_groups 
                      WHERE teacher_id = ? AND group_identifier = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("is", $teacherId, $groupIdentifier);
        $statement->execute();   
                
        $statement->close();
    }
        
    
    
}

?>