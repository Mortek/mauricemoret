<?php

class Group
{
    
    private $group_id;
    private $group_name;
    //private $group_character;
    private $file_id;
    private $group_identifier;


    function __construct($id, $name, $file_id, $groupIdentifier) 
    {
                
        $this->group_id = $id;
        $this->group_name = $name;
        //$this->group_character = $character;
        $this->file_id = $file_id;
        $this->group_identifier = $groupIdentifier;
        
    }
    
    // getters and setters 
    public function getId() 
    {
        
        return $this->group_id;
        
    }

    public function setId($id)
    {
        
        $this->group_id = $id;
        
    }
    
    
    public function getName() 
    {
        
        return $this->group_name;
        
    }

    public function setName($name)
    {
        
        $this->group_name = $name;
        
    }
    
    
    /*public function getCharacter() 
    {
        
        return $this->group_character;
        
    }

    public function setCharacter($character)
    {
        
        $this->group_character = $character;
        
    }*/
    
    
    public function getFileId() 
    {
        
        return $this->file_id;
        
    }

    public function setFileId($file)
    {
        
        $this->file_id = $file;
        
    }
    
    
    public function getIdentifier() 
    {
        
        return $this->group_identifier;
        
    }

    public function setIdentifier($groupIdentifier)
    {
        
        $this->group_identifier = $groupIdentifier;
        
    }
    
}

?>