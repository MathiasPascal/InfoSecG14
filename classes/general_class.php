<?php
//connect to database class
require("../settings/db_class.php");

/**
 *General class to handle all functions 
 */
/**
 *@author David Sampah
 *
 */

//  public function add_brand($a,$b)
// 	{
// 		$ndb = new db_connection();	
// 		$name =  mysqli_real_escape_string($ndb->db_conn(), $a);
// 		$desc =  mysqli_real_escape_string($ndb->db_conn(), $b);
// 		$sql="INSERT INTO `brands`(`brand_name`, `brand_description`) VALUES ('$name','$desc')";
// 		return $this->db_query($sql);
// 	}
class general_class extends db_connection
{
	public function add_brand($brandName)
	{
		$ndb = new db_connection();
		$brandName = mysqli_real_escape_string($ndb->db_conn(), $brandName);
		$sql = "INSERT INTO `brands`(`brand_name`) VALUES ('$brandName')";
		return $this->db_query($sql);
	}

	public function get_all_brands()
	{
		$sql = "SELECT * FROM `brands`";
		return $this->db_query($sql);
	}


	public function delete_brand($brand_id)
    {
        $sql = "DELETE FROM `brands` WHERE `brand_id` = '$brand_id'";
        return $this->db_query($sql);
    }



	//--UPDATE--//



	//--DELETE--//


}
