The scProductOverviewItemMulti chunk is used with getResources in the standard templates created on install for listing product items where there is one add to cart button at the bottom of the page. 

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