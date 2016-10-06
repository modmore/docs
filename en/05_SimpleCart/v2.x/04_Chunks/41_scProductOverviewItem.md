The Product Overview Item is being used by the [scGetCart Snippet](../Snippets/scGetCart) to generate part of the product overview 

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