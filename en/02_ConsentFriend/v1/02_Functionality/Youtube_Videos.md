To disable the automatic loading and execution of the YouTube videos, you have
to modify i.e. the iframe code with the following code:

```
<iframe type="text/plain" data-src="https://www.youtube.com/embed/M7lc1UVf-VE" data-name="youtube" ...>
```

To display different content as a replacement for the video, and show a link to the consent management
window, you can use the following solution:
[https://github.com/kiprotect/klaro/issues/157#issuecomment-576187791](https://github.com/kiprotect/klaro/issues/157#issuecomment-576187791)

In the future, this will be configurable with a callback script in
the ConsentFriend service configuration.