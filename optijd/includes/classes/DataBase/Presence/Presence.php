<?php

class Presence
{
    
    private $student_presence_id;
    private $student_id;
    private $student_not_present_reason;
    private $student_presence_datetime;


    function __construct($presence_id, $student_id, $not_present_reason, $presence_datetime) 
    {
                
        $this->student_presence_id = $presence_id;
        $this->student_id = $student_id;
        $this->student_not_present_reason = $not_present_reason;
        $this->student_presence_datetime = $presence_datetime;

        
    }
    
    // getters and setters 
    public function getId() 
    {
        
        return $this->student_presence_id;
        
    }

    public function setId($presence_id)
    {
        
        $this->student_presence_id = $presence_id;
        
    }
    
    
    public function getStudentId() 
    {
        
        return $this->student_id;
        
    }

    public function setStudentId($student_id)
    {
        
        $this->student_id = $student_id;
        
    }
   
    
    public function getNotPresentReason() 
    {
        
        return $this->student_not_present_reason;
        
    }

    public function setNotPresentReason($not_present_reason)
    {
        
        $this->student_not_present_reason = $not_present_reason;
        
    }
    
    
    public function getPresenceDatetime() 
    {
        
        return $this->student_presence_datetime;
        
    }

    public function setPresenceDatetime($presence_datetime)
    {
        
        $this->student_presence_datetime = $presence_datetime;
        
    }
    
}

?>