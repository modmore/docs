The Recently Row chunk is being used by the [scGetCart Snippet](../Snippets/scGetCart) to display a row of recently viewed

## Default scRecentlyRow chunk

```` html
<div class="item">
    <h3>[[+recent.pagetitle]]</h3>
    <p>
        [[+recent.introtext:isempty=`[[+recent.content:stripTags:ellipsis=`75`]]`]]
        <a href="[[~[[+recent.id]]]]">[[%simplecart.cart.more]]</a>
    </p>
</div>
```` 