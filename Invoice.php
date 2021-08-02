<?php
/**
 * Save new items added
 * Update the calculated totals and discount in db 
 */
require_once __DIR__."/lib/DataSource.php";
require_once __DIR__."/model/InvoiceModel.php";

if(!empty($_POST)) {

	$flag = (isset($_POST['flag'])) ? $_POST['flag'] : '';
	switch ($flag) {
		// Add new item
		case 'item-save':
			$oInvoiceMod = new InvoiceModel();
			$iLastInsertId = $oInvoiceMod->insertItemDetails($_POST);
			echo $iLastInsertId;
			break;
		// On discount change update order table
		case 'order-updates':
			$oInvoiceMod = new InvoiceModel();
			$rowCount = $oInvoiceMod->updateOrderDetails($_POST);
			echo $rowCount;
			break;
		default:
			break;
	}
}

?>