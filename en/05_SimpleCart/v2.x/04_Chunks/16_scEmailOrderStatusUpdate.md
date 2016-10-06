The Email Order Status Update chunk is being used by the [scGetCart Snippet](../Snippets/scGetCart) to email status updates

## Default scCart chunk

```` html
<p>[[%simplecart.email.salutation]]</p>
<p>[[%simplecart.email.orderupdated]]</p>

[[+status_changed:notempty=`<p>[[%simplecart.email.statuschanged]]</p>`]]

[[+message:notempty=`<p>[[+message:nl2br]]</p>`]]

<p>[[%simplecart.email.closure]]</p>
<p>[[%simplecart.email.regards]]</p>
```` 