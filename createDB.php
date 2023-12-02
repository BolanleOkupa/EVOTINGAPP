<?php

class CreateDB
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $tablename2;
    public $tablename3;
    public $tablename4;
    public $tablename5;
    public $tablename6;
    public $con;


    // class constructor
    public function __construct(
        $dbname = "Newdb",
        $tablename = "tbl_users",
        $tablename2 = "tbl_parties",
        $tablename3 = "tbl_electype",
        $tablename4 = "tbl_elect",
        $tablename5 = "tbl_candidate",
        $tablename6 = "tbl_polls",
        $servername = "localhost",
        $username = "root",
        $password = ""
    )

    {
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->tablename2 = $tablename2;
        $this->tablename3 = $tablename3;
        $this->tablename4 = $tablename4;
        $this->tablename5 = $tablename5;
        $this->tablename6 = $tablename6;
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;

        // create connection
        $this->con = mysqli_connect($servername, $username, $password);

        // Check connection
        if(!$this->con){
            die("Connection failed:".mysqli_connect_error());
        }

        //execute query to create the DB
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";


        //execute query to connect to DB and create first table
        if(mysqli_query($this->con, $sql)){
            $this->con = mysqli_connect($servername, $username, $password, $dbname);
            
            //sql to create 'users' table
            $sql = "CREATE TABLE IF NOT EXISTS $tablename 
            (
                `id` int NOT NULL AUTO_INCREMENT,
                `firstname` char(50) NOT NULL,
                `lastname` char(50) NOT NULL,
                `gender` char(6) NOT NULL,
                `email` varchar(50) NOT NULL,
                `password` varchar(255) NOT NULL,

                `reset_token_hash` varchar(64) NULL DEFAULT NULL,
                `reset_token_expires_at` datetime NULL DEFAULT NULL,

                `verifyId` BLOB NOT NULL,
                `status` varchar(15) NOT NULL,
                `role` varchar(10) NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `email` (`email`), 
                UNIQUE KEY `reset_token_hash` (`reset_token_hash`)
            )ENGINE=InnoDB;";

            if(!mysqli_query($this->con, $sql)){
                echo "Error creating table:".mysqli_error($this->con);
            }
        } 
        else{
            //return false;
        }
        

        //execute query to connect to DB and create second table
        if(mysqli_query($this->con, $sql)){
            $this->con = mysqli_connect($servername, $username, $password, $dbname);
            
            //sql to create 'parties' table
            $sql = "CREATE TABLE IF NOT EXISTS $tablename2
            (
                `id` int NOT NULL AUTO_INCREMENT,
                `partyname` varchar(100) NOT NULL,
                `partycode` varchar(5) NOT NULL,
                `logo` BLOB NOT NULL,
                PRIMARY KEY (`id`)
            )ENGINE=InnoDB;";

            if(!mysqli_query($this->con, $sql)){
                echo "Error creating table:".mysqli_error($this->con);
            }
        } 
        else{
            //return false;
        }


        //execute query to connect to DB and create third table
        if(mysqli_query($this->con, $sql)){
            $this->con = mysqli_connect($servername, $username, $password, $dbname);
            
            //sql to create 'electiontype' table
            $sql = "CREATE TABLE IF NOT EXISTS $tablename3
            (
                `id` int NOT NULL AUTO_INCREMENT,
                `electionname` varchar(50) NOT NULL,
                `description` varchar(100) NOT NULL,
                PRIMARY KEY (`id`)
            )ENGINE=InnoDB;";

            if(!mysqli_query($this->con, $sql)){
                echo "Error creating table:".mysqli_error($this->con);
            }
        } 
        else{
            //return false;
        }


        //execute query to connect to DB and create fourth table
        if(mysqli_query($this->con, $sql)){
            $this->con = mysqli_connect($servername, $username, $password, $dbname);
            
            //sql to create 'election' table
            $sql = "CREATE TABLE IF NOT EXISTS $tablename4
            (
                `id` int NOT NULL AUTO_INCREMENT,
                `typeid` int NOT NULL,
                `electiondate` timestamp NOT NULL,
                `description` varchar(100) NOT NULL,
                PRIMARY KEY (`id`),
                KEY `typeid` (`typeid`)
            )ENGINE=InnoDB;";

            if(!mysqli_query($this->con, $sql)){
                echo "Error creating table:".mysqli_error($this->con);
            }
        }    
        else{
            //return false;
        }


        //eexecute query to connect to DB and create fifth table
        if(mysqli_query($this->con, $sql)){
            $this->con = mysqli_connect($servername, $username, $password, $dbname);
            
            //sql to create 'candidate' table
            $sql = "CREATE TABLE IF NOT EXISTS $tablename5
            (
                `id` int NOT NULL AUTO_INCREMENT,
                `userid` int NOT NULL,
                `image` varchar(200) NOT NULL,
                `bio` varchar(100) NOT NULL,
                PRIMARY KEY (`id`),
                KEY `userid` (`userid`)
            )ENGINE=InnoDB;";

            if(!mysqli_query($this->con, $sql)){
                echo "Error creating table:".mysqli_error($this->con);
            }
        }    
        else{
            //return false;
        }
        //execute query to connect to DB and create sixth table
        if(mysqli_query($this->con, $sql)){
            $this->con = mysqli_connect($servername, $username, $password, $dbname);
            
            //sql to create 'polls' table
            $sql = "CREATE TABLE IF NOT EXISTS $tablename6
            (
                `id` int NOT NULL AUTO_INCREMENT,
                `candidateid` int NOT NULL,
                `voterid` int NOT NULL,
                `electionid` int NOT NULL,
                PRIMARY KEY (`id`),
                KEY `candidateid` (`candidateid`),
                KEY `voterid` (`voterid`),
                KEY `electionid` (`electionid`)
            )ENGINE=InnoDB;";

            if(!mysqli_query($this->con, $sql)){
                echo "Error creating table:".mysqli_error($this->con);
            }
        }    
        else{
            //return false;
        }        

    }
}
?>
