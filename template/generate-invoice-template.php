<?php

function getGenerateInvoiceHtmlData($itemDet, $orderDet, $invoiceNo){
	ob_start();
?>
<html>
<head>Receipt of Purchase - <?php  echo $result[0]["order_invoice"]; ?>
</head>
<body>
<div style="text-align:right;">
        <b>Sender:</b> Bismi
    </div>
    <div style="text-align: left;border-top:1px solid #000;">
        <div style="font-size: 24px;color: #666;">INVOICE</div>
    </div>
<table style="line-height: 1.5;">
    <tr><td><b>Invoice:</b> #<?php echo $invoiceNo; ?>
        </td>
        <td style="text-align:right;"><b>Receiver:</b></td>
    </tr>
    <tr>
        <td><b>Date:</b> <?php echo date('d-m-Y'); ?></td>
        <td style="text-align:right;"><?php echo 'Jane John'; ?></td>
    </tr>
<tr>
<td></td>
<td style="text-align:right;"><?php echo 'janejohn@gmail.com'; ?></td>
</tr>
</table>

<div></div>
    <div style="border-bottom:1px solid #000;">
        <table style="line-height: 2;">
            <tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
            	<td style="border:1px solid #cccccc;width:20px;">#</td>
                <td style="border:1px solid #cccccc;width:150px;">Name</td>
                <td style = "text-align:right;border:1px solid #cccccc;width:55px">Quantity</td>
                <td style = "text-align:right;border:1px solid #cccccc;width:80px;">Unit Price($)</td>
                <td style = "text-align:right;border:1px solid #cccccc;width:100px;">Taxable Value($)</td>
                <td style = "text-align:right;border:1px solid #cccccc;width:50px;">Tax(%)</td>
                <td style = "text-align:left;border:1px solid #cccccc;">Line Total($)</td>
            </tr>
<?php
foreach ($itemDet as $k => $item) {
	$lineTotal = 0;
	$taxable = $item['unit_price']*$item['quantity'];
	$lineTotal = ($taxable + (($taxable*$item['tax'])/100));	
    ?>
    <tr> <td style="border:1px solid #cccccc;"><?php echo $k+1; ?></td>
        <td style = "text-align:left; border:1px solid #cccccc;"><?php echo $item["item_name"]; ?></td>
        <td style = "text-align:right; border:1px solid #cccccc;"><?php echo $item["quantity"]; ?></td>
        <td style = "text-align:right; border:1px solid #cccccc;"><?php echo $item["unit_price"]; ?></td>
        <td style = "text-align:right; border:1px solid #cccccc;"><?php echo number_format($taxable, 2); ?></td>
        <td style = "text-align:right; border:1px solid #cccccc;"><?php echo $item["tax"]; ?></td>
        <td style = "text-align:right; border:1px solid #cccccc;"><?php echo number_format($lineTotal, 2); ?></td>
   </tr>
<?php
}
?>
<tr>
    <td></td><td></td><td></td>
    <td style = "text-align:right;">Subtotal (without tax)</td>
    <td style = "text-align:right;"><?php echo $orderDet[0]['sub_total']; ?></td>
</tr>
<tr>
    <td></td><td></td><td></td>
    <td style = "text-align:right;">Subtotal (with tax)</td>
    <td style = "text-align:right;"><?php echo $orderDet[0]['sub_total_with_tax']; ?></td>
</tr>
<tr>
    <td></td><td></td><td></td>
    <td style = "text-align:right;">Discount (<?php echo $orderDet[0]['discount_in'];?>)</td>
    <td style = "text-align:right;"><?php echo $orderDet[0]['discount']; ?></td>
</tr>
<tr  style = "font-weight: bold;">
	<td></td><td></td><td></td>
    <td style = "text-align:right;">Total</td>
    <td style = "text-align:right;"><?php echo $orderDet[0]['total_with_discount']; ?></td>	
</tr>
</table></div>
<p><u>Kindly make your payment to</u>:<br/>
Bank: SBI<br/>
A/C: 05346346543634664422<br/>
</p>
</body>
</html>

<?php
return ob_get_clean();
}