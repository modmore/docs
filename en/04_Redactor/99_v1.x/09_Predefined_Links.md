The page you're currently looking at contains information related to Redactor 1.x. Please visit [Predefined Links](../v2.x/Predefined_Links) for the relevant information for Redactor 2.x.

---

One of the many additions to [Redactor 1.5](https://www.modmore.com/blog/2014/announcing-redactor-1.5/) is the ability to quickly choose from predefined links in the edit link modal window. By authoring a list of links to be available Redactor will add a select box so your most important links are only two clicks away.

![Predefined Links make for quicker editing in Redactor 1.5](http://assets.modmore.com/img/blog/redactor_link.png)

To use Predefined Links, you'll need to create a JSON object for Redactor to reference, and set the [Predefined Links Setting](https://www.modmore.com/extras/redactor/documentation/configuration/#predefined+links) to a URL that serves your JSON.


```` javascript   
[
  {
    "name": "modmore",
    "url": "http://modmore.com"
  },
  {
    "name": "MODX",
    "url": "http://modx.com"
  },
  {
    "name": "TryCatch",
    "url": "http://devries.jp"
  }
]
````   

As you can see, each link consists of a `name` and a `url` property, formatted in simple JSON. 