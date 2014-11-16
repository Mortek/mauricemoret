<?php

class Teacher
{
    
    private $teacher_id;
    private $teacher_first_name;
    private $teacher_insertion;
    private $teacher_last_name;
    private $teacher_password;
    private $teacher_email;

    function __construct($id = 0, $first_name, $insertion, $last_name, $password, $email) 
    {
                
        $this->teacher_id = $id;
        $this->teacher_first_name = $first_name;
        $this->teacher_insertion = $insertion;
        $this->teacher_last_name = $last_name;
        $this->teacher_password= $password;
        $this->teacher_email = $email;
        
    }
    
    // getters and setters 
    public function getId() 
    {
        
        return $this->teacher_id;
        
    }

    public function setId($id)
    {
        
        $this->teacher_id = $id;
        
    }
    
    
    public function getFirstName() 
    {
        
        return $this->teacher_first_name;
        
    }

    public function setFirstName($first_name)
    {
        
        $this->teacher_first_name = $first_name;
        
    }
   

    public function getInsertion() 
    {
        
        return $this->teacher_insertion;
        
    }

    public function setInsertion($insertion)
    {
        
        $this->teacher_insertion = $insertion;
        
    }
    
    
    public function getLastName() 
    {
        
        return $this->teacher_last_name;
        
    }

    public function setLastName($last_name)
    {
        
        $this->teacher_last_name = $last_name;
        
    }
    
    
    public function getPassword() 
    {
        
        return $this->teacher_password;
        
    }

    public function setPassword($password)
    {
        
        $this->teacher_password = $password;
        
    }
    
    
    public function getEmail() 
    {
        
        return $this->teacher_email;
        
    }

    public function setEmail($email)
    {
        
        $this->teacher_email = $email;
        
    }
    
    
}

?>