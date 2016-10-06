The Product Overview Item Multi chunk is being used by the [scGetCart Snippet](../Snippets/scGetCart) 

## Default scProductOverviewItemMulti chunk

```` html
<div class="item">
    <h2>
        <input type="checkbox" name="products&#91;[[+idx]]&#93;[productid]" value="[[+id]]">
        <a href="[[~[[+id]]]]">[[+pagetitle]]</a> ([[+product_code]])
    </h2>
    <p class="price">[[+product_price_formatted]]</p>

    <div>
        <input type="text" name="products&#91;[[+idx]]&#93;[quantity]" value="1" />
    </div>
</div>
```` 