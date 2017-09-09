This short tutorial will help you create a Login resource that can be used with the standard checkout process in Commerce. 

[TOC]

## 1. Install Login

First things first. Install the [Login](https://modx.com/extras/package/login) extra from MODX.com through the package installer in the manager.

## 2. Create a Login Resource

Create a new resource somewhere in your site, and name it Login. In the content (or a chunk, or a template), put the following code:

````html
[[!Login]]
````

Save the resource. Open it and make sure that it shows the login form, or a logout link if you were already logged in.

If you'd like, you can customise the login form further in a few ways.

- Change the `&loginTpl` property to tweak the design of the login form. This only applies when customers actually view the login form, for example if you use the same login resource outside the checkout. 
- Provide `&contexts` with the keys of contexts, separated by commas, that customers should get logged in to automatically. 
- Provide a fallback login redirect with `&redirectToPrior` or `&loginResource` in case the customer provided incorrect details or didn't come from the checkout.

[See the Login documentation](https://docs.modx.com/extras/revo/login/login.login) for details on those options. 


## 3. Tell Commerce you have a Login Resource

Go to System > System Settings in the manager, and find the `commerce.login_resource` system setting. Set its value to the ID of the login resource you created. 

## 4. Ready to go

As the default checkout templates include a ready-made form to login, you should be ready to go!

## More Information

- [More user-related features in Commerce](index)
- [Login Documentation](https://docs.modx.com/extras/revo/login/login.login)
- [Making Member-Only Pages in MODX](https://docs.modx.com/revolution/2.x/administering-your-site/security/security-tutorials/making-member-only-pages)
