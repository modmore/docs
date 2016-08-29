 One of the power user features in Redactor is the ability to quickly choose from predefined links in the edit link modal window. By authoring a list of links to be available Redactor will add a select box so your most important links are only two clicks away.

![Predefined Links make for quicker editing in Redactor 1.5](http://assets.modmore.com/img/blog/redactor_link.png)Predefined Links make for quicker editing in Redactor 1.5   
 To use Predefined Links, you'll need to create a JSON object for Redactor to reference, and set the Predefined Links Setting to a URL that serves your JSON.

   
 ```` javascript   
 [ { "name": "modmore", "url": "http://modmore.com" }, { "name": "MODX", "url": "http://modx.com" }, { "name": "TryCatch", "url": "http://devries.jp" } ]   
 ````   
As you can see, each link consists of a `name` and a `url` property, formatted in simple JSON.