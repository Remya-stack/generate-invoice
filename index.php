<?php 
require_once "includes/header.php";
require_once __DIR__."/model/InvoiceModel.php";
$oItems = new InvoiceModel();
$aItemDetails = $oItems->getItemDetails();
$iOrderId = 1;
?>
<div class="container"> 
	<div class="row invoice-head" >
		Invoice 
	</div>
	<div class="row" >
		Order Id : 1
	</div>
	<div class="row">
		<div class="col-8" ></div>
		<div class="col-2 generate-inv-btn">
			<a class="btn btn-success gen-inv" href="GenerateInvoice.php/?id=<?php echo $iOrderId;?>" data-target="_blank">Generate Invoice</a>
		<div class="col-2 add-item-btn">
			<button class="btn btn-primary" type="button" id="add-item" data-bs-toggle="modal" data-bs-target="#addItemModal">Add Item</button>
		</div>
	</div>
	<div class="row">		
		<table class="table table-layout">
			<thead class="table-light">
				<tr>
				  	<th scope="col">#</th>
				  	<th scope="col">Name</th>
				  	<th scope="col">Quantity</th>
				  	<th scope="col">Unit Price ($)</th>
				  	<th scope="col">Taxable Value ($)</th>
				  	<th scope="col">Tax (%)</th>
				  	<th scope="col">Line Total ($)</th>
				</tr>
			</thead>
		 	<tbody>
		 		<span id="items-list"></span>
				<?php 
				$subTotalWithTax = 0;
				$subTotalWithOutTax = 0;
				$taxable = 0;
				foreach ($aItemDetails as $key => $itemDet) { 
					$total = 0;
					$taxable = round($itemDet['unit_price']*$itemDet['quantity'], 2);
					$total = round(($taxable + (($taxable*$itemDet['tax'])/100)), 2);
				?>
				<tr>
				  	<td><?php echo $key+1;?></td>				  
				  	<td><?php echo $itemDet['item_name'];?></td>
				  	<td><?php echo $itemDet['quantity'];?></td>
				  	<td><?php echo $itemDet['unit_price'];?></td>
				  	<td><?php echo $taxable;?></td>
				  	<td><?php echo $itemDet['tax'];?></td>
				  	<td><?php echo $total;?></td>

				</tr>
				<?php 
				$subTotalWithTax += $total; 
				$subTotalWithOutTax += $taxable;
				} ?>
		  	</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-8"></div>
		<div class="col-4">
			<table class="table">
				
			 	<tbody>
					<tr>
						<td>Subtotal (without tax): </td><td><?php echo round($subTotalWithOutTax, 2);?></td>
					</tr>
					<tr>
						<td>Subtotal (with tax): </td><td><?php echo round($subTotalWithTax, 2);?></td>
					</tr>
					<tr>
						<td>Discount : </td>
						<td>
							<input type="number" min="0" class="discount" id="discount-id">
							<input type="hidden" id="sub-total-with-tax" value="<?php echo $subTotalWithTax;?>">
							<input type="hidden" id="sub-total-without-tax" value="<?php echo $subTotalWithOutTax;?>">
							<select id="discount-in">
								<option>%</option>
								<option>$</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>Total : </th><td><span id="total-amt"><?php echo $subTotalWithTax;?></span></td>
					</tr>
			  	</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addItemModalLabel">Add New Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		  <div class="container-fluid">
		    <div class="row row-clear">
		      <div class="col-md-4"><span>Name : </span></div>
		      <div class="col-md-4"><input type="text" id="item-name"></div>
		    </div>
		    <div class="row row-clear">
		      <div class="col-md-4"><span>Quantity : </span></div>
		      <div class="col-md-4"><input type="number" id="quantity"></div>
		    </div>
		    <div class="row row-clear">
		      <div class="col-md-4"><span>Unit Price ($) : </span></div>
		      <div class="col-md-4"><input type="number" id="price"></div>
		    </div>
		    <div class="row row-clear">
		      <div class="col-md-4"><span>Tax (%): </span></div>
		      	<div class="col-md-4">
			      	<select id="tax">
			      		<option>0</option>
			      		<option>1</option>
			      		<option>5</option>
			      		<option>10</option>
			      	</select>
		  		</div>
		    </div>
		  </div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-modal">Close</button>
        <button type="button" class="btn btn-primary" id="item-save">Save</button>
      </div>
    </div>
  </div>
</div>

<?php
require_once "includes/footer.php";
?>


