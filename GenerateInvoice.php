<?php
/**
 * Get Item details and call generatePDF
 */
require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."\model\InvoiceModel.php";

$invoiceNo 	= 'INV-'.date('Y-m-d');

$invoice 	= new InvoiceModel();

$orderId 	= $_GET['id'];
$itemDet 	= $invoice->getItemDetailsByOrderId($orderId);
$orderDet 	= $invoice->getOrderDetails($orderId);

if(!empty($itemDet))
{
	require_once __DIR__."\lib\GeneratePDFService.php";
	$pdfService 		= new GeneratePDFService();
	$pdfService->generatePDF($itemDet, $orderDet, $invoiceNo);
}

?>