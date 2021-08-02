<?php 
	/**
	 * Common model class to build query and call db access methods
	 */
	class InvoiceModel
	{
		// Db connection 
		function __construct()
		{
			require_once "lib/DataSource.php";
			$this->ds = new DataSource();
		}

		public function getItemDetails() {
			$query = "SELECT * FROM item_details";
	        $result = $this->ds->select($query);
	        return $result;
		}

		public function getItemDetailsByOrderId($orderId) {
			$query = "SELECT * FROM item_details WHERE order_id = '".$orderId."'";
	        $result = $this->ds->select($query);
	        return $result;
		}

		public function getOrderDetails($orderId){
			$query = "SELECT * FROM `order` WHERE `order_id` = '".$orderId."'";
	        $result = $this->ds->select($query);
	        return $result;
		}

		public function updateOrderDetails($aPost){
			$query = "UPDATE `order` SET `sub_total` = '".$aPost['sub_total']."', `sub_total_with_tax` = '".$aPost['sub_total_with_tax']."', `discount` = '".$aPost['discount']."',`discount_in` = '".$aPost['discount_in']."',`total_with_discount` = '".$aPost['total_with_discount']."' WHERE `order_id` = 1";
			return $order_item_id = $this->ds->update($query); 
		}
		

		public function insertItemDetails($aPost) {
			$order_id = 1;
			$query = "INSERT INTO item_details(item_name,quantity,unit_price,tax,order_id) VALUES('".$aPost['item_name']."','".$aPost['quantity']."','".$aPost['unit_price']."','".$aPost['tax']."','".$order_id."')";
			return $order_item_id = $this->ds->insert($query); 
		}
	}

?>