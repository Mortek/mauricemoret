<?php

require_once 'DataAccessObject.php';


class FileDAO implements DataAccessObject
{
    
    private $connection;
    
    function __construct($connection)
    {
        
        $this->connection = $connection;
        
    }
    
    
    public function select($fileId = "")
    {
        
        $query     = "SELECT * 
                      FROM   files
                      WHERE  file_id = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $fileId);
        $statement->execute();
        $statement->store_result();
        
        if($statement->num_rows > 0)
        {
        
            $statement->bind_result($id, $name, $url);
            $statement->fetch();
            
            $file = new File($id, $name, $url); 

        }
        else
        {
            
            $file = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $file;
        
    }
    
    
    public function selectAll($id = "")
    {

        $query     = "SELECT * 
                      FROM files";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->execute();
        $statement->store_result();
        
        $fileData = array();
        
        if($statement->num_rows > 0)
        {
            
            $statement->bind_result($id, $name, $url);

            while($statement->fetch())
	    {
                $file = new File($id, $name, $url); 

                $fileData[] = $file;
            }    
        }
        else
        {
            
            $fileData = null;
            
        }
        
        $statement->free_result();
        $statement->close();

        return $fileData;
        
    }
    
 
    public function edit($file)
    {
        
        $u_id = $file->getId();
        $u_file_name = $file->getName();
        $u_file_url = $file->getUrl();
        
        $query     = "UPDATE files 
                      SET    file_name = ?, file_url = ?
                      WHERE  file_id = ?";

        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("sss", $u_file_name, $u_file_url, $u_id);
        $statement->execute();
        $statement->close();
        
    }
    

    public function add($file)
    {
               
        $u_id = $file->getId();
        $u_file_name = $file->getName();
        $u_file_url = $file->getUrl();
        
        $query     = "INSERT INTO files (file_name, file_url) 
                             VALUES (?, ?)";
         

        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("ss", $u_file_name, $u_file_url);
        $statement->execute();   
                
        $statement->close();
         
    }

    public function delete($id)
    {
        
        $query     = "DELETE 
                      FROM  files 
                      WHERE file_id = ?";
        
        $statement = $this->connection->prepareQuery($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $statement->close();
        
    }
        
    
    
}

?>