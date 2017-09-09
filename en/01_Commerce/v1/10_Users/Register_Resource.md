This short tutorial will help you create a Register resource that can be used with the standard checkout process in Commerce. 

[TOC]

## 1. Install Login

First things first. Install the [Login](https://modx.com/extras/package/login) extra from MODX.com through the package installer in the manager.

## 2. Create a Register Resource

Create a new resource somewhere in your site, and name it Register, or Sign up. In the content (or a chunk, or a template), put the following code:

````html
[[!Register]]
````

Save the resource. Open it and make sure that it shows the default registration form. 

If you'd like the customer to be able of continuing with the checkout immediately, disable `&activation`, enable `&autoLogin`, and set `submittedResourceId` to `[[++commerce.register_resource]]`. 

For further customisation options, [see the Register documentation](https://docs.modx.com/extras/revo/login/login.register).


## 3. Tell Commerce you have a Register Resource

Go to System > System Settings in the manager, and find the `commerce.regsiter_resource` system setting. Set its value to the ID of the login resource you created, this will automatically add a link to your sign up page from the user step in the checkout.

## 4. Ready to go

That should be all. When the user is logged in and returns to the checkout, they will automatically move to the next step, which is filling in their address information.

## More Information

- [More user-related features in Commerce](index)
- [Register Documentation](https://docs.modx.com/extras/revo/login/login.register)
- [More detailed example registration form](https://docs.modx.com/extras/revo/login/login.register/register.example-form-1)