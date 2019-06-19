<?php
/**
 * DB operations functions
 */
class DB_Functions {
 
    private $db;
 
    //put your code here
    // constructor
    function __construct() {
        include_once 'config/db.php';
		  include_once 'config/db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }
 
    // destructor
    function __destruct() {
 
    }
 

     /**
     * Getting all indicators
     */
    public function getIndicators() {
		
		//echo "select * FROM indicators, categories WHERE indicators.cat_id = categories.id";
        $result = mysqli_query( $this->db->connect(),"select * FROM indicators, categories WHERE indicators.cat_id = categories.id");
        return $result;
    }

	     /**
     * Getting all categories
     */
    public function getCategories() {
        $result = mysqli_query($this->db->connect(),"select * FROM categories");
        return $result;
    }
	
	/**
	Get Key Indicators
	
	*/
  
    /** get updated row for item **/

   	public function getUnsyncRow($id , $timestamp) {
		// echo "select * FROM indicators WHERE indicatorId = $id AND updated_on = '$timestamp'";
		// echo 'select * FROM indicators WHERE `indicatorId` ='.$id.' AND `updated_on` = "'.$timestamp.'"';
        $results = mysqli_query($this->db->connect(),'select * FROM indicators WHERE `indicatorId` ='.$id.' AND `updated_on` = "'.$timestamp.'"');
        return $results;
    }
	
	
	/**  Get update for row  **/
	
	public function getRowUpdate($id)
	{
	// echo "select * FROM indicators WHERE indicatorId = $id";
    $result = mysqli_query($this->db->connect(),"select * FROM indicators, categories WHERE indicators.cat_id = categories.id AND indicatorId = $id");
    return $result;	
	}
	
	/** get only updates **/
	
	public function getUpdates()
	{
	// echo "select * FROM indicators WHERE indicatorId = $id";
    $result = mysqli_query($this->db->connect(),"select * FROM indicators, updates, categories WHERE indicators.indicatorId = updates.indicator_id AND updates.category_id = categories.id");
    return $result;	
	}
	
	public function getcatName($id)
	{
			// echo "select * FROM indicators WHERE indicatorId = $id";
    $result = mysql_query($this->db->connect(),"select * FROM categories WHERE id = $id");
    return $result;	
	}
	
	
	/**  join **/


	/**  Get update for row  
	
	public function getRowUpdat($id)
	{
	// echo "select * FROM indicators WHERE indicatorId = $id";
    $result = mysql_query("select * FROM indicators, categories WHERE indicators.cat_id = categories.id AND indicatorId = $id");
    return $result;	
	}
	**/

	// get all indicator item values in remote database
	
	public function getAllRows()
	{
		
		$result = mysqli_query($this->db->connect(),"select * FROM indicators");
		return $result;
	}
	

}
 
?>