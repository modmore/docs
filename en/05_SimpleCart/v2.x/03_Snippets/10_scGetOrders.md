The scGetOrders snippet is used for a "My Account" section where customers can review past orders. See [My Orders](../Frontend/Checkout/My_Orders).

The scGetOrders snippet handles both the order list and detail views. 

[TOC]

## Standard Usage

````
[[!scGetOrders]]
````

## Properties for order list

### outerTpl

Default: [scOrders](../Chunks/scOrders)

Name of the chunk to wrap the order list. 

### loginTpl

Default: [scOrdersLogin](../Chunks/scOrdersLogin)

Name of the chunk to show when the user is not currently logged in.

### rowTpl

Default: [scOrdersRow](../Chunks/scOrdersRow)

Name of the chunk for each individual order in the list. 

### detailResource

Default: current resource

ID of the resource to show the order details on. Defaults to current resource.

### detailKey

Default: `order`

The URL parameter to use for switching between the order list and detail view. This URL parameter will contain the order number. 

### limit

Default: 0

The number of orders to show (per page if using getPage).

### offset

Default: 0

When limit is set, you can also set the starting point of the order list. 

### totalVar

Name of the placeholder to hold the total amount of results. Used for getPage pagination.

### placeholderPrefix

Default: `order.`

### vatPrefix

Default: `vat.`


## Properties for order detail

### detailTpl

Default: [scOrdersDetail](../Chunks/scOrdersDetail)

Name of the chunk for the order detail view. 

### detailRowTpl

Default: [scOrdersDetailRow](../Chunks/scOrdersDetailRow)

### detailVatRowTpl

Default: [scOrdersDetailVatRow](../Chunks/scOrdersDetailVatRow)

### detailRowFieldTpl

Default: [scOrdersDetailRowField](../Chunks/scOrdersDetailRowField)

### detailRowOptionsTpl

Default: [scOrdersDetailRowOptions](../Chunks/scOrdersDetailRowOptions)

### viewVATRows

Default: `true`

### useComments

Default: true

### commentsLoadCreatedBy

Default: false

### detailCommentsTpl

Default: [scOrdersDetailComments](../Chunks/scOrdersDetailComments)

### detailCommentsRowTpl

Default: [scOrdersDetailCommentsRow](../Chunks/scOrdersDetailCommentsRow)

### detailCommentsTpl

Default: [scOrdersDetailCommentsForm](../Chunks/scOrdersDetailCommentsForm)

### commentField

Default: `comment`

### commentsSortBy

Default: `created ASC, id`

### commentsSortdir

Default: `ASC`

