The scRecentlyRpw chunk is used in the [scRecentlyViewed Snippet](../Snippets/scRecentlyViewed) to display products the customer recently visited. 

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