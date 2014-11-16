<?php

class Student
{
    
    private $student_id;
    private $student_first_name;
    private $student_insertion;
    private $student_last_name;
    private $student_contact_mail;
    private $student_contact_mail_active;
    private $student_contact_sms;
    private $student_contact_sms_active;
    private $student_contact_phone;
    private $student_contact_phone_active;
    private $group_identifier;
    private $file_id;

    function __construct($id, $first_name, $insertion, $last_name, $mail, $mail_active, $sms, $sms_active, $phone, $phone_active, $group_identifier, $file_id) 
    {
                
        $this->student_id = $id;
        $this->student_first_name = $first_name;
        $this->student_insertion = $insertion;
        $this->student_last_name = $last_name;
        $this->student_contact_mail = $mail;
        $this->student_contact_mail_active = $mail_active;
        $this->student_contact_sms = $sms;
        $this->student_contact_sms_active = $sms_active;
        $this->student_contact_phone = $phone;
        $this->student_contact_phone_active = $phone_active;
        $this->group_identifier = $group_identifier;
        $this->file_id = $file_id;
        
    }
    
    // getters and setters 
    public function getId() 
    {
        
        return $this->student_id;
        
    }

    public function setId($id)
    {
        
        $this->student_id = $id;
        
    }
    
    
    public function getFirstName() 
    {
        
        return $this->student_first_name;
        
    }

    public function setFirstName($first_name)
    {
        
        $this->student_first_name = $first_name;
        
    }
   

    public function getInsertion() 
    {
        
        return $this->student_insertion;
        
    }

    public function setInsertion($insertion)
    {
        
        $this->student_insertion = $insertion;
        
    }
    
    
    public function getLastName() 
    {
        
        return $this->student_last_name;
        
    }

    public function setLastName($last_name)
    {
        
        $this->student_last_name = $last_name;
        
    }
    
    
    public function getMail() 
    {
        
        return $this->student_contact_mail;
        
    }

    public function setMail($mail)
    {
        
        $this->student_contact_mail = $mail;
        
    }
    
    
    public function getMailActive() 
    {
        
        return $this->student_contact_mail_active;
        
    }

    public function setMailActive($mail_active)
    {
        
        $this->student_contact_mail_active = $mail_active;
        
    }
    
    
    public function getSms() 
    {
        
        return $this->student_contact_sms;
        
    }

    public function setSms($sms)
    {
        
        $this->student_contact_sms = $sms;
        
    }
    
    
    public function getSmsActive() 
    {
        
        return $this->student_contact_sms_active;
        
    }

    public function setSmsActive($sms_active)
    {
        
        $this->student_contact_sms_active = $sms_active;
        
    }
    
    
    public function getPhone() 
    {
        
        return $this->student_contact_phone;
        
    }

    public function setPhone($phone)
    {
        
        $this->student_contact_phone = $phone;
        
    }
    
    
    public function getPhoneActive() 
    {
        
        return $this->student_contact_phone_active;
        
    }

    public function setPhoneActive($phone_active)
    {
        
        $this->student_contact_phone_active = $phone_active;
        
    }
    
    
    public function getGroupIdentifier() 
    {
        
        return $this->group_identifier;
        
    }

    public function setGroupIdentifier($group_identifier)
    {
        
        $this->group_identifier = $group_identifier;
        
    }
    
    
    public function getFileId() 
    {
        
        return $this->file_id;
        
    }

    public function setFileId($file_id)
    {
        
        $this->file_id = $file_id;
        
    }
    
}

?>