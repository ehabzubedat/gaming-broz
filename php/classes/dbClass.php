<?php

class dbClass
{
    // Varibales
    private $host;
    private $db;
    private $charset;
    private $user;
    private $pass;
    private $opt = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    private $connection;

    // C'tor
    public function __construct(string $host = "localhost", string $db = "gaming_broz",
		string $charset = "utf8", string $user = "", string $pass = "")                            
    {
        $this->host = $host;
        $this->db = $db;
        $this->charset = $charset;
        $this->user = $user;
        $this->pass = $pass;
    }

    // Method to connect to Database.
    private function connect()
    {
        $dns = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->connection = new PDO($dns, $this->user, $this->pass, $this->opt);
    }

    // Method to disconnect from Database.
    public function disconnect()
    {
        $this->connection = null;
    }

    // Method that fetch query with specific params(data).
    public function fetch($query,$params,$count=false)
    {
        $this->connect();
        $statement = $this->connection->prepare($query);  
        $statement->execute($params);
        if($count) return $statement->rowCount();
        
        $f = $statement->fetch();
        
        $this->disconnect();
        return $f;            
    }

    // Method that prepare a query and execute the params.
    public function execute($query,$params)
    {
        try 
        {
            $this->connect();
            $statment = $this->connection->prepare($query);
            return $statment->execute($params);
        }
        catch (PDOException $e) 
        {
            print $e->getMessage();
        }
        finally
        {
            $this->disconnect();
        }
    }

    // Method that fetch all data. 
    public function fetchAll($query,$count=false)
    {
        $this->connect();
        $statement = $this->connection->prepare($query);  
        $statement->execute();
        if($count) return $statement->rowCount();
        
        $f = $statement->fetchAll();
        
        $this->disconnect();
        return $f;            
    }
    
	// Method that fetch all data with specific params.
    public function fetchAllWithParams($query,$params,$count=false)
    {
        $this->connect();
        $statement = $this->connection->prepare($query);  
        $statement->execute($params);
        if($count) return $statement->rowCount();
        
        $f = $statement->fetchAll();
        
        $this->disconnect();
        return $f;            
    }
  
}

?>