The scProductOverviewItem chunk is used with getResources in the standard templates created on install for listing product items with an add-to-cart button on each product.

## Default scProductOverviewItem chunk

```` html
<div class="item">
    <h2><a href="[[~[[+id]]]]">[[+pagetitle]]</a> ([[+product_code]])</h2>
    <p class="price">[[+product_price_formatted]]</p>

    <form action="[[~[[*id]]]]" method="post">
        <div>
            <input type="hidden" name="productid" value="[[+id]]" /><!-- not needed on product detail pages itself -->
            <input type="text" name="quantity" value="1" />
            <input type="submit" name="addcart" value="Add to Cart" />
        </div>
    </form>
</div>
```` 