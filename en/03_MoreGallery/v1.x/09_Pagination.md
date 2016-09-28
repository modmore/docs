MoreGallery is designed to work with [getPage](http://rtfm.modx.com/display/ADDON/getPage). After installing [getPage from MODX.com](http://modx.com/extras/package/getpage), you will be able of paginating through your gallery by simply wrapping the mgGetImages snippet with getPage.

The minimal usage for a paginated gallery with getPage is as follows:
   
```` html   
[[!getPage?
  &element=`mgGetImages`
]]
[[!+page.nav]]
````

To match it with the Foundation framework, you could add some minimal styling and markup:

```` html   
<div class="text-center">
[[!getPage?
  &element=`mgGetImages`
  &limit=`2`

  &pageActiveTpl=`<li class="current"><a[[+title]] href="[[+href]]">[[+pageNo]]</a></li>`
]]
</div>

<div class="pagination-centered">
  <ul class="pagination">
    [[!+page.nav]]
  </ul>
</div>
````   

You can find a lot more information and options specific to getPage in [the getPage documentation](http://rtfm.modx.com/display/ADDON/getPage). 

If you get stuck integrating MoreGallery with getPage, feel free to [contact support](https://www.modmore.com/account/support/) for help. 

More information about using the mgGetImages snippet and the available properties can be found in the [Snippet Usage](Snippets/mgGetImages) documentation.

Using MoreGallery, getPage, a connector resource and a bit of JavaScript (jQuery) you can also create a "load more"-style functionality, which loads more images via AJAX.
