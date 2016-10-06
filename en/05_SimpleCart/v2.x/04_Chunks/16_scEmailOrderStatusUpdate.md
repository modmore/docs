The scEmailOrderStatusUpdate chunk is used when sending a [status update](../Manager/Orders/Update_Status)

## Default scEmailOrderStatusUpdate chunk

```` html
<p>[[%simplecart.email.salutation]]</p>
<p>[[%simplecart.email.orderupdated]]</p>

[[+status_changed:notempty=`<p>[[%simplecart.email.statuschanged]]</p>`]]

[[+message:notempty=`<p>[[+message:nl2br]]</p>`]]

<p>[[%simplecart.email.closure]]</p>
<p>[[%simplecart.email.regards]]</p>
```` 