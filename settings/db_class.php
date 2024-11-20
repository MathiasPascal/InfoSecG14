<?php



require('db_cred.php');

/**
 *@author David Sampah
 *@version 1.1
 */
class db_connection
{
	
	
	public $db = null;
	public $results = null;

	
	/**
	*Database connection
	*@return bolean
	**/
	function db_connect(){
		
		
		$this->db = mysqli_connect(SERVER,USERNAME,PASSWD,DATABASE);
		
		
		if (mysqli_connect_errno()) {
			return false;

		}else{
			return true;
		}
	}

	function db_conn(){
		
		
		$this->db = mysqli_connect(SERVER,USERNAME,PASSWD,DATABASE);
		
		
		if (mysqli_connect_errno()) {
			return false;
		}else{
			return $this->db;
		}
	}


	
	/**
	*Query the Database
	*@param takes a connection and sql query
	*@return bolean
	**/
    function db_query($sqlQuery)
    {
        if (!$this->db_connect()) {
            return false;
        } elseif ($this->db == null) {
            return false;
        }

        $this->results = mysqli_query($this->db, $sqlQuery);
        return $this->results;
    }

	
	
	/**
	*Query the Database
	*@param takes a connection and sql query
	*@return bolean
	**/
	function db_query_escape_string($sqlQuery){
		
		
		$this->results = mysqli_query($this->db,$sqlQuery);
		
		if ($this->results == false) {
			return false;
		}else{
			return true;
		}
	}

	
	/**
	*get select data
	*@return a record
	**/
	function db_fetch_one($sql){
		
		
		if(!$this->db_query($sql)){
			return false;
		} 
		
		return mysqli_fetch_assoc($this->results);
	}

	
	/**
	*get select data
	*@return all record
	**/
	function db_fetch_all($sql){
		
		
		if(!$this->db_query($sql)){
			return false;
		} 
		
		return mysqli_fetch_all($this->results, MYSQLI_ASSOC);
	}


	
	/**
	*get select data
	*@return a count
	**/
	function db_count(){
		
		
		if ($this->results == null) {
			return false;
		}
		elseif ($this->results == false) {
			return false;
		}
		
		
		return mysqli_num_rows($this->results);

	}
	
}
?>