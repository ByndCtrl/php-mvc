<?php

class Database 
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    /**
     * Initialize PDO connection.
     * Set the DBH as the new instance of PDO.
     */
    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        try 
        {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } 
        catch (PDOException $e) 
        {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * Prepare statement.
     */
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Bind variables to  proper types.
     * Types allowed: integer, string, bool and null.
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) 
        {
            switch (1) 
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
                    
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Execute prepared statement.
     */
    public function execute()
    {
        return $this->stmt->execute();
    }

    /**
     * Get a set of rows.
     */
    public function getAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
    * Get a single row.
    */
    public function getSingle()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Get the row count of the statement.
     */
    public function rowCount()
    {
        return $this->statement->rowCount();
    }
}
