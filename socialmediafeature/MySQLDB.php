<?php
/*
   MySQL Database Connection Class
*/

/*single responsibility - This class  has been pulled out from the individual pages where it was keeping the other functions holding multiple responsibilities. Now in the separate class it is doing a single responsibility implementing the connection details.*/

/*open closed - Template method holds the algorithm, then the child classes add detail to it. To add a different database you just create a new child class, no need to touch main code.*/

/*Liskov - A client can rely on the connection details being consistently implemented because the children inherit the same behaviour.*/

/*Interface segregtion - this has no extraneous methods that a client would be forced to rely on. Just the necessary.*/

/*Dependency inversion - This is part of the data persistence layer and is now being kept separate from the business logic layer using an abstraction.*/

abstract class TemplateConnectionDetails
{
	
	final function Connect(){
		$dbName = $this->setDBName();
		$db = new MySQL( $this->setHost(), $this->setDBUser() , $this->setDBPass() , $dbName );
		$db->selectDatabase();
		return $db;
	}
	
	function setHost(){
		return 'localhost';
	}
	
	function setDBUser(){
		return 'root';
	}
	
	function setDBPass(){
		return '';
	}
	
	abstract function setDBName();
}

class SudokuConnectionDetails extends TemplateConnectionDetails
{
	function setDBName(){
		return 'sudoku_image_annotator';
	}
}

class MaoriConnectionDetails extends TemplateConnectionDetails
{
		
	function setDBName(){
		return 'maori_image_annotator';
	}
}


class MySQL 
{
  var  $host;
  var  $dbUser;
  var  $dbPass;
  var  $dbName;
  var  $dbConn;
  var  $dbconnectError;


  function __construct( $host , $dbUser , $dbPass , $dbName )
  {
     $this->host   = $host;
     $this->dbUser = $dbUser;
     $this->dbPass = $dbPass;
     $this->dbName = $dbName;
     $this->connectToServer();
   }


  function connectToServer()
  {
       $this->dbConn = mysqli_connect( $this->host , $this->dbUser , $this->dbPass );
       if ( !$this->dbConn )
       {
           trigger_error('could not connect to server' );
           $this->dbconnectError = true;
       }
       else
       {
            //echo "connected to server <br />";
       }
       
  }

    function selectDatabase()
    {
    if (! mysqli_select_db( $this->dbConn, $this->dbName ) )
           {
              trigger_error( 'could not select database' );  
              $this->dbconnectError = true;                     
           }
           else
           {
				//echo "$this->dbName  database selected <br />";
           }
      }
     

    function dropDatabase()
    {
		$sql = "drop database if exists $this->dbName";
        echo "<br> $sql  <br>";
		if ( $this->query($sql) )
		{
			echo "the $this->dbName database was dropped<br>";
		}
		else
		{
			echo "the $this->dbName database was not dropped<br>";
		}
    }


    function createDatabase()
    {
     $sql = "create database if not exists $this->dbName";
            echo "$sql  <br />";
            if ( $this->query($sql) )
               {
                    echo "the $this->dbName database was created<br>";
               }
                else
               {
                    echo "the $this->dbName database was not created<br>";
               }
    }


   function isError()
   {
      if  ( $this->dbconnectError )
      {
         return true;
      }
      $error = mysqli_error( $this->dbConn );
      if (empty ($error))
      {
           return false;
      }
      else
      {
           return true;   
      }
   }


	function query( $sql )
	{
		mysqli_query( $this->dbConn, "set character_set_results='utf8'"); 
		 if (!$queryResource = mysqli_query($this->dbConn, $sql ))
		 {
			trigger_error ( 'Query Failed: <br>' . mysqli_error($this->dbConn ) . '<br> SQL: ' . $sql );
			return false;
		 }
	 
		 return new MySQLResult( $this, $queryResource ); 
   }
   
}


class MySQLResult 
{
   var $mysql;
   var $query;

   function __construct( &$mysql, $query )
   {
     $this->mysql = &$mysql;
     $this->query = $query;
   }

    function size()
    {
        return mysqli_num_rows($this->query);
    }

    function fetch()
    {
		if ( $row = mysqli_fetch_array( $this->query , MYSQLI_ASSOC ))
		{
		   return $row;
		}
			   else if ( $this->size() > 0 )
       {
           mysqli_data_seek ( $this->query , 0 );
           return false;
       }
       else
       {
           return false;
       }         
    }

    function insertID()
    {
            /**
            * returns the ID of the last row inserted
            * @return  int
            * @access  public
            */
          return mysqli_insert_id($this->mysql->dbConn);
    }


   function isError()
   {
        return $this->mysql->isError();
   }
}