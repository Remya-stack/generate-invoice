# Application to generate invoice

## Introduction

Generate Invoice is an application used to add items, view item details and generate invoice.

### Features

* Add Item:
  Click on Add Item button
  Enter item details
  Click on save
  (Add Item popup get closed and shows new added item in listing)
* Calculates line total using unit price, quantity and tax and displays it against each line item
* Calculates subtotal with tax and without tax and renders
* Can able provide discount on subtotal with tax amt
  Discount can be applied in % and $ values
  On change of the discount, the 'Total' amt get calculated and rendered at bottom of the listing
* Generate Invoice
  Can generate invoice in a pdf format using TCPDF
  Invoice can be downloaded and printed

###Database Setup
Import sql/invoice.sql into your database

