<?php
/**
 * This is a simple Class which contains the database connection.
 * The only accesible method is prepareQuery. Because of this only prepared
 * statements can be used, which will improve security.
 */
class DataBase
{

    private $host;
    private $user;
    private $pass;
    private $db;
    
    private $connection;
    
    /**
     * Set up a connection to the database
     * 
     * @param type $host    The host where the database server is located.
     * @param type $user    The username which will be used to log in.
     * @param type $pass    The password which will be used to log in.
     * @param type $db      The database we'll want to access.
     */
    function __construct($host, $user, $pass, $db)
    {
        
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db   = $db;
        
        $this->connection = new mysqli($host, $user, $pass, $db);
        
        if (mysqli_connect_errno()) 
        {
            
            throw new FatalException("Er kon geen verbinding met de database worden gemaakt.");
            
        }
        
    }
    
    /**
     * Clean up our connection once we are done with the database object.
     */
    function __destruct() 
    {
        
        $this->connection->close();
        
    }
    
    /**
     * Start a new prepared statement
     * 
     * @param type $query   The query we'll want to execute.
     * @return type         The Prepared statements result.
     */
    public function prepareQuery($query)
    {
        
        $preparedStatement = $this->connection->prepare($query);
        	
        if($preparedStatement == false && Settings::DEBUG_MODE == true)
        {
            
            echo "Er is een fout opgetreden in de volgende query: " . $query;
            
        }
        
        return $preparedStatement;
        
    }

    
}
?>