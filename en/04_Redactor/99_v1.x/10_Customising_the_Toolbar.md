The page you're currently looking at contains information related to Redactor 1.x. Please visit [Custom Toolbars](https://www.modmore.com/redactor/documentation/customising-the-editor/) for the relevant information for Redactor 2.x.







With a little bit of CSS, or as we like to call it [Sass](http://sass-lang.com) you can customize the Redactor toolbar to fit your MODX theme however you like. Let’s get started.

![Redactor 1.5 toolbar with a custom color scheme](http://assets.modmore.com/img/blog/custom-toolbar3.png)
> Redactor 1.5 toolbar with a custom color scheme

### Sass

Here’s a look at the source Sass we use to pre-process our [CSS below](https://www.modmore.com/extras/redactor/documentation/customizing-the-toolbar/#css).


```` scss   
$rebeccapurple:#663399;
$white:#FFF;
$black:rgb(85,85,85);

$ignorable:#DDD;
$danger:#E53C30;
$actionable:#09978F;

$toolbarBG:#F2F2F2;
$toolbarColor:#081922;
$toolbarHoverBG:$actionable;
$toolbarHoverColor:$white;
$toolbarActiveBG:$ignorable;
$toolbarActiveColor:#444;

$buttonColor:$white;

body {
    .redactor_toolbar {
        background:$toolbarBG;
        li a {
           color:$toolbarColor;
           &:hover {
               background:$toolbarHoverBG;
               color:$toolbarHoverColor;
           }
           &:active, &.redactor_act {
               background:$toolbarActiveBG;
               color:$toolbarActiveColor;
           }
        }
    }

    #redactor_modal {
        footer {
            button {
                background:$ignorable;
                &:hover {
                    color:$black;
                    background:darken($ignorable,6%);
                }
                &.redactor_modal_delete_btn {
                    background: $danger;
                    color: $buttonColor;
                    &:hover {
                        background:darken($danger,6%);
                        color:$white;
                    }
                }
                &.redactor_modal_action_btn {
                    background:$actionable;
                    color: $buttonColor;
                    &:hover {
                        background:darken($actionable,6%);
                        color:$white;
                    }
                }
            }
        }
    }
}
````   

First we define some variables at the top which define the different colors of the toolbar theme. Since we are writing Sass, we have [many color functions](http://sass-lang.com/documentation/Sass/Script/Functions.html) available to use. For this example, the darken() method is used in a few places to increase contrast when buttons are hovered over or active.

> Plain old CSS is valid Sass, so you already know the Sass syntax.

If you aren’t already familiar with Sass, take a look at the CSS it generates below. One thing you’ll notice is that with Sass, we can nest CSS declarations within other declarations as a shorthand way of defining selectors like `#redactor_modal footer button:hover`. We can also reference pre-defined variables, and perform color functions on them as a way to make our styles more reusable.

### CSS


```` css   
body .redactor_toolbar {
  background: #f2f2f2;
}
body .redactor_toolbar li a {
  color: #081922;
}
body .redactor_toolbar li a:hover {
  background: #09978f;
  color: white;
}
body .redactor_toolbar li a:active, body .redactor_toolbar li a.redactor_act {
  background: #dddddd;
  color: #444444;
}
body #redactor_modal footer button {
  background: #dddddd;
}
body #redactor_modal footer button:hover {
  color: #555555;
  background: #cecece;
}
body #redactor_modal footer button.redactor_modal_delete_btn {
  background: #e53c30;
  color: white;
}
body #redactor_modal footer button.redactor_modal_delete_btn:hover {
  background: #db281b;
  color: white;
}
body #redactor_modal footer button.redactor_modal_action_btn {
  background: #09978f;
  color: white;
}
body #redactor_modal footer button.redactor_modal_action_btn:hover {
  background: #077a74;
  color: white;
}
````   

So this is the CSS the above Sass generates. Notice the selectors all start with `body` and are a bit specific. Yuck. This is done just so we don’t have to worry about which stylesheet is loaded first, the redactor CSS or your custom overrides. If you are confident your overrides load afterwards, you can loosen your selectors accordingly.

### Sass Widget

Changing the colors of the Sass variables in [this gist](http://sassmeister.com/gist/450f4a655963eee6e539) will automatically update your CSS.

[Play with this gist on SassMeister.](https://sassmeister.com/gist/17f1a62335428a48a7ac)

You’ll want to include this CSS on your MODX manager pages so that they override the default Redactor styles. You can do this by supplying the [Stylesheet Setting](https://www.modmore.com/extras/redactor/documentation/configuration/#stylesheet) with an absolute path to your custom stylesheet which may looking something like:

```` html   
[[++asset_url]]css/redactor-custom.css   
````   