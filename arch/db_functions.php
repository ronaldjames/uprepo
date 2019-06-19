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
        $result = mysql_query("select * FROM indicators");
        return $result;
    }
    
	/**
     * Getting all outlets for user
     */
    public function getOutlets($username) {
		
	//	echo "select * FROM outlets WHERE username='".$username."'";
	
	//echo "select * FROM users_for_outlets WHERE user_id=$username";
	
		
        $result = mysql_query("select * FROM users_for_outlets WHERE user_id=".$username."");
		
	//	print_r($result);
        return $result;
    }
	
		/**
     * Getting all outlets for user
     */
    public function getCategories($username) {
		
	//	echo "select * FROM outlets WHERE username='".$username."'";
	
	//echo "select * FROM users_for_outlets WHERE user_id='".$username."'";
	
		
        $result = mysql_query("select * FROM outlet_categories WHERE user_id=".$username."");
		
	//	print_r($result);
        return $result;
    }
	
	
	/**
     * Getting user ID
     */
    public function getUserID($username) {
		
	//	echo "select user_id FROM users WHERE user_email='".$username."'";
		
       $result = mysql_query("select user_id FROM users WHERE user_email='".$username."'");
        return $result;
    }
	
	/**
	* Get outlet ID for user
	*/
	   public function getUserOutletID($username) {
		
	//	echo "select user_id FROM users WHERE username='".$username."'";
		
        $result = mysql_query("select outlet_id FROM users_for_outlets WHERE user_id = '".$username."'");
		
        return $result;
    
	   }
	
	/**
     * Getting all items for user
     */
    public function getItems($outet_id, $user_id) {
		
	//echo "select * FROM items_for_outlet WHERE outet_id=".$outet_id."";
	
	//echo "select * FROM items_for_outlet WHERE $outet_id" ;
	
	//echo "select * FROM items_for_outlet WHERE $outet_id" ;	
	
	//  $result = mysql_query("select * FROM items_for_outlet WHERE $outet_id");
	//SELECT p.item_name , y.item_id FROM items_for_outlet as y, items as p WHERE p.id = y.item_id
	// echo "select * FROM items_for_outlet WHERE $outet_id AND user_id=$user_id";
        $result = mysql_query("select * FROM items_for_outlet WHERE $outet_id AND user_id=$user_id");
        return $result;
    }
	
	/** Get item name from ID   **/
	
	 public function getItemName($item_id) {
		
	//echo "select * FROM items_for_outlet WHERE outet_id=".$outet_id."";
	
	//echo "select * FROM items_for_outlet WHERE $outet_id" ;
	
	// echo "select * FROM items_for_outlet WHERE $outet_id" ;	
	
	//  $result = mysql_query("select * FROM items_for_outlet WHERE $outet_id");
	//SELECT p.item_name , y.item_id FROM items_for_outlet as y, items as p WHERE p.id = y.item_id
        $result = mysql_query("select * FROM items WHERE id=$item_id");
        return $result;
    }
	
	/** Get item name from ID   **/
	
	 public function getOutletName($outlet_id) {
		
	//echo "select * FROM items_for_outlet WHERE outet_id=".$outet_id."";
	
	//echo "select * FROM items_for_outlet WHERE $outet_id" ;
	
	// echo "select * FROM items_for_outlet WHERE $outet_id" ;	
	
	//  $result = mysql_query("select * FROM items_for_outlet WHERE $outet_id");
	//SELECT p.item_name , y.item_id FROM items_for_outlet as y, items as p WHERE p.id = y.item_id
	
	// echo "select outlet_name FROM outlets WHERE id=$outlet_id";
        $result = mysql_query("select * FROM outlets WHERE id=$outlet_id");
        return $result;
    }
	
	
	
	public function getSubDivisionName($sub_division_id)
	{
		$result = mysql_query("select * FROM subdivision WHERE id=$sub_division_id");
        return $result;
		
		
	}
	/**
	* Insert Remote data
	*/
	
	 public function insertData($outlet_id, $price, $item_qty, $item_unit, $item_longitude, $item_latitude, $item_date, $item_remarks,$id, $remote_item_id) {
		// echo "INSERT INTO prices(COLUMN_PRICE, ITEM_ID) VALUES ($price, '$id')" ; 
		
		// echo "INSERT INTO prices(COLUMN_OUTLET_ID, COLUMN_PRICE,COLUMN_QUANTITY,COLUMN_UNIT,COLUMN_LONGITUDE,	COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', $price, '$item_qty', '$item_unit', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')" ; 
		
        $result = mysql_query("INSERT INTO prices(COLUMN_OUTLET_ID, COLUMN_PRICE,COLUMN_QUANTITY,COLUMN_UNIT,COLUMN_LONGITUDE,	COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID , REMOTE_ITEM_ID) VALUES ('$outlet_id', '$price', '$item_qty', '$item_unit', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id', '$remote_item_id')");
        return $result;
    }
	
	/**Update QTY1 Record */
	 public function updateData_qty1($outlet_id, $price, $item_qty, $item_unit, $item_longitude, $item_latitude, $item_date, $item_remarks,$id,$remote_item_id) {
		// echo "INSERT INTO prices(COLUMN_PRICE, ITEM_ID) VALUES ($price, '$id')" ; 
		
		// echo "INSERT INTO prices(COLUMN_OUTLET_ID, COLUMN_PRICE,COLUMN_QUANTITY,COLUMN_UNIT,COLUMN_LONGITUDE,	COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', $price, '$item_qty', '$item_unit', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')" ; 
		
        $result = mysql_query("UPDATE prices SET COLUMN_PRICE = '$price' ,COLUMN_QUANTITY = '$item_qty',COLUMN_UNIT = '$item_unit' ,COLUMN_LONGITUDE = $item_longitude ,	COLUMN_LATITUDE = $item_latitude,COLUMN_DATE = '$item_date',COLUMN_REMARKS = '$item_remarks' ,REMOTE_ITEM_ID = '$remote_item_id' WHERE ITEM_ID = '$id' AND COLUMN_OUTLET_ID = '$outlet_id'");
        return $result;
    }
	
	/**Update QTY1 Record */
	 public function updateData_qty2($outlet_id, $price, $item_qty, $item_unit, $item_longitude, $item_latitude, $item_date, $item_remarks,$id,$remote_item_id, $duration,$CourseCharge,$term,$year,$baby_fee,$middle_fee,$top_fee,$p1_fee,$p2_fee,$p3_fee,$p4_fee,$p5_fee,$p6_fee,$p7_fee,$s1_fee,$s2_fee ,$s3_fee 
,$s4_fee,$s5_fee,$s6_fee,$item_longitude,$item_latitude,$item_date,$item_remarks) {
		// echo "INSERT INTO prices(COLUMN_PRICE, ITEM_ID) VALUES ($price, '$id')" ; 
		
		// echo "INSERT INTO prices(COLUMN_OUTLET_ID, COLUMN_PRICE,COLUMN_QUANTITY,COLUMN_UNIT,COLUMN_LONGITUDE,	COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', $price, '$item_qty', '$item_unit', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')" ; 
		
		//echo "UPDATE prices SET COLUMN_PRICE = $price ,COLUMN_QUANTITY = '$item_qty',COLUMN_UNIT = '$item_unit' ,COLUMN_LONGITUDE = $item_longitude ,	COLUMN_LATITUDE = $item_latitude,COLUMN_DATE = '$item_date',COLUMN_REMARKS = '$item_remarks' ,REMOTE_ITEM_ID = '$remote_item_id',ITEM_DURATION = '$duration',ITEM_COURSE_CHARGE = '$CourseCharge',ITEM_TERM = '$term',ITEM_YEAR='$year',ITEM_BABY_FEE='$baby_fee',ITEM_MIDDLE_FEE='$middle_fee',ITEM_TOP_FEE='$top_fee',ITEM_P1_FEE='$p1_fee',ITEM_P2_FEE='$p2_fee',ITEM_P3_FEE='$p3_fee',ITEM_P4_FEE='$p4_fee',ITEM_P5_FEE=$p5_fee',ITEM_P6_FEE='$p6_fee',ITEM_P7_FEE='$p7_fee',ITEM_S1_FEE='$s1_fee',ITEM_S2_FEE='$s2_fee',ITEM_S3_FEE='$s3_fee',ITEM_S4_FEE='$s4_fee',ITEM_S5_FEE='$s5_fee',ITEM_S6_FEE='$s6_fee', REMOTE_ITEM_ID='$remote_item_id' WHERE ITEM_ID = '$id' AND COLUMN_OUTLET_ID = '$outlet_id'" ;
		
        $result = mysql_query("UPDATE prices SET COLUMN_PRICE = '$price' ,COLUMN_QUANTITY = '$item_qty',COLUMN_UNIT = '$item_unit' ,COLUMN_LONGITUDE = $item_longitude ,	COLUMN_LATITUDE = $item_latitude,COLUMN_DATE = '$item_date',COLUMN_REMARKS = '$item_remarks' ,REMOTE_ITEM_ID = '$remote_item_id',ITEM_DURATION = '$duration',ITEM_COURSE_CHARGE = '$CourseCharge',ITEM_TERM = '$term',ITEM_YEAR='$year',ITEM_BABY_FEE='$baby_fee',ITEM_MIDDLE_FEE='$middle_fee',ITEM_TOP_FEE='$top_fee',ITEM_P1_FEE='$p1_fee',ITEM_P2_FEE='$p2_fee',ITEM_P3_FEE='$p3_fee',ITEM_P4_FEE='$p4_fee',ITEM_P5_FEE='$p5_fee',ITEM_P6_FEE='$p6_fee',ITEM_P7_FEE='$p7_fee',ITEM_S1_FEE='$s1_fee',ITEM_S2_FEE='$s2_fee',ITEM_S3_FEE='$s3_fee',ITEM_S4_FEE='$s4_fee',ITEM_S5_FEE='$s5_fee',ITEM_S6_FEE='$s6_fee', REMOTE_ITEM_ID='$remote_item_id' WHERE ITEM_ID = '$id' AND COLUMN_OUTLET_ID = '$outlet_id'");
        return $result;
    }
	
	/** Qty 2 **/
		 public function insertDataQty2($outlet_id,$duration, $courseCharge, $item_longitude, $item_latitude, $item_date, $item_remarks,$id) {
		// echo "INSERT INTO prices(COLUMN_PRICE, ITEM_ID) VALUES ($price, '$id')" ; 
		
		// echo "INSERT INTO prices(COLUMN_OUTLET_ID, COLUMN_PRICE,COLUMN_QUANTITY,COLUMN_UNIT,COLUMN_LONGITUDE,	COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', $price, '$item_qty', '$item_unit', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')" ; 
		
        $result = mysql_query("INSERT INTO prices(COLUMN_OUTLET_ID, ITEM_DURATION,ITEM_COURSE_CHARGE,COLUMN_LONGITUDE,	COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', '$duration', '$courseCharge', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')");
        return $result;
    }
	/** Qty 3 **/
		 public function insertDataQty3($outlet_id,$term,$year,$baby_fee,$middle_fee,$top_fee,$item_longitude, $item_latitude, $item_date, $item_remarks,$id) {
		// echo "INSERT INTO prices(COLUMN_PRICE, ITEM_ID) VALUES ($price, '$id')" ; 
		
		// echo "INSERT INTO prices(COLUMN_OUTLET_ID, COLUMN_PRICE,COLUMN_QUANTITY,COLUMN_UNIT,COLUMN_LONGITUDE,	COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', $price, '$item_qty', '$item_unit', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')" ; 
		
		//echo "INSERT INTO prices(COLUMN_OUTLET_ID, ITEM_TERM,ITEM_YEAR,ITEM_BABY_FEE,ITEM_MIDDLE_FEE,ITEM_TOP_FEE,COLUMN_LONGITUDE,COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', '$term', '$year','$baby_fee','$middle_fee','$top_fee', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')";
		
        $result = mysql_query("INSERT INTO prices(COLUMN_OUTLET_ID, ITEM_TERM,ITEM_YEAR,ITEM_BABY_FEE,ITEM_MIDDLE_FEE,ITEM_TOP_FEE,COLUMN_LONGITUDE,COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', '$term', '$year','$baby_fee','$middle_fee','$top_fee', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')");
        return $result;
    }
		/** Qty 4 **/
		 public function insertDataQty4($outlet_id,$term,$year,$p1_fee,$p2_fee,$p3_fee,$p4_fee,$p5_fee,$p6_fee,$p7_fee,$item_longitude, $item_latitude, $item_date, $item_remarks,$id) {
		// echo "INSERT INTO prices(COLUMN_PRICE, ITEM_ID) VALUES ($price, '$id')" ; 
		
		// echo "INSERT INTO prices(COLUMN_OUTLET_ID, COLUMN_PRICE,COLUMN_QUANTITY,COLUMN_UNIT,COLUMN_LONGITUDE,	COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', $price, '$item_qty', '$item_unit', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')" ; 
		
		//echo "INSERT INTO prices(COLUMN_OUTLET_ID, ITEM_TERM,ITEM_YEAR,ITEM_BABY_FEE,ITEM_MIDDLE_FEE,ITEM_TOP_FEE,COLUMN_LONGITUDE,COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', '$term', '$year','$baby_fee','$middle_fee','$top_fee', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')";
		
        $result = mysql_query("INSERT INTO prices(COLUMN_OUTLET_ID, ITEM_TERM,ITEM_YEAR,ITEM_P1_FEE,ITEM_P2_FEE,ITEM_P3_FEE,ITEM_P4_FEE,ITEM_P5_FEE,ITEM_P6_FEE,ITEM_P7_FEE,COLUMN_LONGITUDE,COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', '$term', '$year','$p1_fee','$p2_fee','$p3_fee','$p4_fee','$p5_fee','$p6_fee','$p7_fee', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')");
        return $result;
    }
		/** Qty 5 **/
		 public function insertDataQty5($outlet_id,$term,$year,$s1_fee,$s2_fee,$s3_fee,$s4_fee,$s5_fee,$s6_fee,$item_longitude, $item_latitude, $item_date, $item_remarks,$id) {
		// echo "INSERT INTO prices(COLUMN_PRICE, ITEM_ID) VALUES ($price, '$id')" ; 
		
		// echo "INSERT INTO prices(COLUMN_OUTLET_ID, COLUMN_PRICE,COLUMN_QUANTITY,COLUMN_UNIT,COLUMN_LONGITUDE,	COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', $price, '$item_qty', '$item_unit', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')" ; 
		
		//echo "INSERT INTO prices(COLUMN_OUTLET_ID, ITEM_TERM,ITEM_YEAR,ITEM_BABY_FEE,ITEM_MIDDLE_FEE,ITEM_TOP_FEE,COLUMN_LONGITUDE,COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', '$term', '$year','$baby_fee','$middle_fee','$top_fee', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')";
		
        $result = mysql_query("INSERT INTO prices(COLUMN_OUTLET_ID, ITEM_TERM,ITEM_YEAR,ITEM_S1_FEE,ITEM_S2_FEE,ITEM_S3_FEE,ITEM_S4_FEE,ITEM_S5_FEE,ITEM_S6_FEE,COLUMN_LONGITUDE,COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', '$term', '$year','$s1_fee','$s2_fee','$s3_fee','$s4_fee','$s5_fee','$s6_fee',$item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')");
        return $result;
    }
	
		/** Qty 5 **/
		 public function insertDataQtyAll($outlet_id, $price, $item_qty, $item_unit,$duration, $courseCharge,$term,$year,$baby_fee,$middle_fee,$top_fee,$p1_fee,$p2_fee,$p3_fee,$p4_fee,$p5_fee,$p6_fee,$p7_fee,$s1_fee,$s2_fee,$s3_fee,$s4_fee,$s5_fee,$s6_fee,$item_longitude, $item_latitude, $item_date, $item_remarks,$id,$remote_id) {
		// echo "INSERT INTO prices(COLUMN_PRICE, ITEM_ID) VALUES ($price, '$id')" ; 
		
		// echo "INSERT INTO prices(COLUMN_OUTLET_ID, COLUMN_PRICE,COLUMN_QUANTITY,COLUMN_UNIT,COLUMN_LONGITUDE,	COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', $price, '$item_qty', '$item_unit', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')" ; 
		
		//echo "INSERT INTO prices(COLUMN_OUTLET_ID, ITEM_TERM,ITEM_YEAR,ITEM_BABY_FEE,ITEM_MIDDLE_FEE,ITEM_TOP_FEE,COLUMN_LONGITUDE,COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID) VALUES ('$outlet_id', '$term', '$year','$baby_fee','$middle_fee','$top_fee', $item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id')";
		
        $result = mysql_query("INSERT INTO prices(COLUMN_OUTLET_ID, COLUMN_PRICE,COLUMN_QUANTITY,COLUMN_UNIT, ITEM_DURATION,ITEM_COURSE_CHARGE,ITEM_TERM,ITEM_YEAR,ITEM_BABY_FEE,ITEM_MIDDLE_FEE,ITEM_TOP_FEE,ITEM_P1_FEE,ITEM_P2_FEE,ITEM_P3_FEE,ITEM_P4_FEE,ITEM_P5_FEE,ITEM_P6_FEE,ITEM_P7_FEE,ITEM_S1_FEE,ITEM_S2_FEE,ITEM_S3_FEE,ITEM_S4_FEE,ITEM_S5_FEE,ITEM_S6_FEE,COLUMN_LONGITUDE,COLUMN_LATITUDE,COLUMN_DATE,COLUMN_REMARKS, ITEM_ID, REMOTE_ITEM_ID) VALUES ('$outlet_id','$price', '$item_qty', '$item_unit','$duration', '$courseCharge', '$term', '$year','$baby_fee','$middle_fee','$top_fee','$p1_fee','$p2_fee','$p3_fee','$p4_fee','$p5_fee','$p6_fee','$p7_fee','$s1_fee','$s2_fee','$s3_fee','$s4_fee','$s5_fee','$s6_fee',$item_longitude, $item_latitude, '$item_date', '$item_remarks', '$id', '$remote_id')");
        return $result;
    }
	
	/**
	* Get updates for outlets
	**/
	
	 public function getUpdatesOutlets($username) {
	
        $result = mysql_query("select * FROM outlets WHERE username='".$username."' AND status=1");
        return $result;
    }
	
	
	/**
	Get unsync row count for outlets
	*/
	
		 public function getUnSyncRowOutletCount($user_id){
			 
	// echo "select * FROM users_for_outlets WHERE user_id='".$user_id."' AND row_sync_update=0" ;
	
	   $result = mysql_query("select * FROM users_for_outlets WHERE user_id='".$user_id."' AND row_sync_update=0");
		
		// $result = mysql_query("select * FROM outlets WHERE row_sync_update=0");
        return $result;
		
		 }
		 
		 	/**
	Get unsync row count for outlets
	*/
	
		 public function getUnSyncRowItemCount($user_id){
			 
			// echo "select * FROM items_for_outlet WHERE user_id='".$user_id."' AND row_sync_update=0" ;
	
	   $result = mysql_query("select * FROM items_for_outlet WHERE user_id='".$user_id."' AND row_sync_update=0");
		
		// $result = mysql_query("select * FROM outlets WHERE row_sync_update=0");
        return $result;
		
		 }
		 
		 /**
		 Update Sync status  of rows
		 */
		 
		 public function updateOutletsSyncSts( $status, $id)
		 {
		

	// echo "UPDATE users_for_outlets SET row_sync_update = $status WHERE outlet_id = $id";
			 
	    $result = mysql_query("UPDATE users_for_outlets SET row_sync_update = $status WHERE outlet_id = $id");
        return $result;
		
		 }
		 
		 	 
		 /**
		 Update Sync status  of rows
		 */
		 
		 public function updateItemsSyncSts( $status, $id, $outlet_id, $user_id)
		 {
		
       // echo "UPDATE items_for_outlet SET row_sync_update = $status WHERE outlet_id = $id" ;
	   
	// echo "UPDATE users_for_outlets SET row_sync_update = $status WHERE outlet_id = $id";
			 
	    $result = mysql_query("UPDATE items_for_outlet SET row_sync_update = $status WHERE item_id = $id AND user_id=$user_id AND outlet_id=$outlet_id");
        return $result;
		
		 }
		 
	/**
	* Get updates for outlets
	**/
	
	 public function getUpdatesItems($username) {
	
        $result = mysql_query("select * FROM items WHERE username='".$username."' AND status=1");
        return $result;
    }
	
	/**
	* toggle update status to 0 after it has synchronized with the native items DB
	**/
	/**
     * Update Sync status of rows
     */
    public function updateSyncStsItemss($id, $sts){
        $result = mysql_query("UPDATE items SET status = $sts WHERE Id = $id");
        return $result;
    }
	
	/**
	* toggle update status to 0 after it has synchronized with the native items DB
	**/
	/**
     * Update Sync status of rows
     */
    public function updateSyncStsOutlets($id, $sts){
        $result = mysql_query("UPDATE outlets SET status = $sts WHERE Id = $id");
        return $result;
    }
}
 
?>