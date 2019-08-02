---
title: A/B Testing Templates
---

Using SimpleAB you can easily (and completely transparent to the user) test different templates in your MODX Revolution site. Setting up a new test is easy.

### Setting up Templates to Test

We'll need some templates to test. In most cases you will have one default template, which is the one linked to your resources, and one or more duplicates of that template with certain changes - or something completely different, if you want to.

For this tutorial and quickly getting started, we'd suggest you just duplicate one of your MODX templates and change something that stands out - for example change the slogan.

### Creating the new Test

To create the test, make sure SimpleAB is installed and head over to Components > A/B Testing in the top menu.

#### 1. Open the Component

In the Component you'll see the Tests grid which lists all your tests, and some important numbers like amount of variations and a conversions count. It's very empty right now, but we'll go ahead and create a new one.

You can already see the two different types of tests in SimpleAB: Template and Chunk. While the process is quite similar, you can [find a tutorial on setting up a Chunk A/B Test here](Testing_Chunks).

This tutorial focuses on Template tests, so go ahead and click the button that says _Add Template Test_.

![Screenshot for Step 1](https://assets.modmore.com/extras/simpleab/templates1.png)

#### 2. Create the Test

Ah, the good part :) After clicking the _Add Template Test_ button, you will see a popup window allowing you to configure the template test. Fill in the different fields.

- **Name** • Make it descriptive (or creative!); the name is your own reference for the Test. Required. In this example, we labelled it _My First Template Test_.
- **Type** • Prefilled and unchangeable, the Type indicates on what object the test applies. As we're making a Template test, this is set to _modTemplate_.
- **Apply to Resources** • With a Template Test, the magic happens in a plugin, and we'll need to define when templates are magically swapped out. We have 2 options: we can apply it to specific resources by defining a comma separated list of resource IDs. In our example, we tell it to trigger on Resouce 19 only. As of SimpleAB 1.1, you can also define ranges by specifying two numbers separated by a dash ("5-15") and resource parents by specifying an ID and a right arrow ">" ("5>"). These can be combined as well by separating with a comma like "19,22-25,36>".
- **Apply to Templates** • If you wish to apply a test to all instances of a template, you can define a comma separated list of template IDs in this field. Optional. _Note:_ If you define both Resource IDs and Template IDs, it will trigger on both the individual resources and any resource using one of the templates specified.
- **Description** • Just a reference for yourself of what a test tries to accomplish. Great to communicate the test and variations quickly to team members. Optional.
- **Active** • Tick this box to make the Test active and have it run on the site.
- **Archived** • When your test is complete, you can archive it to keep the data in the database, but to hide it in the main Tests grid. You can use the button "Include Archived Tests" in the grid toolbar to toggle visibility of archived tests.
- **Enable Auto Optimizer** • Please refer to the [Auto Optimizer tutorial](Auto_Optimizer) for more information on how to use this feature. In this tutorial, we will not use it.

After filling in the test, hit the Save button to store the test in the database.

![Screenshot for Step 2](https://assets.modmore.com/extras/simpleab/templates2.png)

#### 3. Managing the Test

Next we'll need to add the variations in order to make it, like, do stuff. Back in the Tests grid, **right click** the newly created Test (it's ID 17 here, but likely ID 1 for you). You'll see a bunch of things you can do with the test.

- **Edit Test** • This menu item will bring back the popup window we just used to create the test, allowing us to change the Resources or Templates it triggers on, or really to make any other change.
- **Manage Variations & Results** • This menu item will bring you to a separate view where you can manage the variations for this specific test, and also lets you view statistics on the test. Some options are only available in this view. We'll go there in a minute.
- **Duplicate Test** • If you click this menu item, you will be presented with a new popup window asking for a new name and if you want to copy along performance data. This is incredibly useful if you want to run a slightly different test.
- **Archive Test** or **Unarchive Test** • Depending on the state of the Test, this lets you quickly archive or unarchive a test. Note that in order for a test to be working, it needs to be both active and not archived.
- **Delete Test** • Use this to remove the test (and all its data) completely.   
Note: when doing this, all data will be written to an export XML file in your core/cache/simpleab/backups/ folder just in case. This export file will work with [ImportX 2.0](http://modx.com/extras/package/importx), however until that is released, you cannot restore the test.

Go ahead and choose **Manage Variations & Results** so we can add some variations.

![Screenshot for Step 3](https://assets.modmore.com/extras/simpleab/templates3.png)

#### 4. The Manage Variations & Results view

In this test-specific view, you will find two tabs (screenshot follows below): Variations and Analytics. The analytics tab is quite.. useless at this point, as there's no data yet in a new test :).

Let's first look at the 4 actions in the buttons bar on top.

- **Edit Test** • When hitting the Edit Test button, the same popup we saw before (in step 2) appears, allowing you to customize when the test runs and to change its name and stuff like that.
- **Archive Test** • The ability to archive a test is also available from the Tests grid, but is also available here.
- **Clear Test Data** • If you want to reset a test, you can use the Clear Test Data button to get rid of Conversions, Picks and even Variations from here.   
Note: when doing this, all data will be written to an export XML file in your core/cache/simpleab/backups/ folder just in case. This export file will work with ImportX 2.0 (planned for late 2013), however until that is released, you cannot restore the data.
- **Back to Tests** • This button brings you back to the homepage of the component with the Tests grid.

In the Variations tab, we will find a grid with the various variations for this test, and a couple of useful (all-time) metrics for each of them. But we don't have any variations yet, so let's change that..

![Screenshot for Step 4](https://assets.modmore.com/extras/simpleab/templates4.png)

#### 5. Adding & Managing Variations

Hit the **Add Variation** button in the grid toolbar to create a new variations. You will see a couple of fields appear in a new modal window.

- **Name** • Required. The name for the variation. This does not have to be the name of a template, but it may be useful to give this something that describes the variation. The first variation we're adding is the current (baseline) design, so we name our variation "Current Design".
- **Description** • Optional. If you want to, you can provide a further description of the variation here.
- **Element** • Required. This is where we assign the template we want this variation to use. In this case we're using the BaseTemplate template, which (as you know) is quite blank.
- **Active** • Use the Active toggle to enable or disable variations within a test. Only active variations will be used as alternatives in the test, so be sure to enable it.

Once you filled in the Variation fields, hit Save, and repeat the process for as many variation as you want to include in the test. In this tutorial, we only add a second variation ("Bootstrap").

![Screenshot for Step 5](https://assets.modmore.com/extras/simpleab/templates5.png)

#### 6. Preview the Test Variations

Now that we've got the Variations set up, we can use the preview functionality to test the variatons and make sure they're ready to be activated.

Right click the variation you would like to preview, and choose the **Preview Variation** menu item. You will see a new modal, providing you with a summary of what you are going to see (what test and what variation) and an input field where you need to define the Resource ID to run the test on. This Resource needs to be specified in the Test its "Apply to Resources" field, or the template the resource uses needs to be in the "Apply to Templates" field of the test. You can check this by choosing for Edit Test in the button bar.

Fill in the Resource ID (just one, please) and hit the **Preview Variation** button. It will briefly talk with the server to get the proper url, and then attempt to open a window or tab in your browser with the test. As many browsers include popup blockers, it will also come back with a quick window with the link.

![Screenshot for Step 6](https://assets.modmore.com/extras/simpleab/templates6.png)

Previewing a test should give you a nice "SimpleAB Admin Preview" box in the bottom left of the screen. It shows you the name of the test you are previewing, as well as a dropdown so you can easily switch to a different variation.

![Admin preview](https://assets.modmore.com/extras/simpleab/adminpreview.png)

#### 7. Set up Conversions

You'll need to log conversions if you want to calculate a conversion rate, so let's do that. As setting up Conversion points is the same for both Chunk and Template tests, please view [the tutorial on setting up conversions](Tracking_Conversions).

#### 8. Let data pour in...

Now it's the time to get a refill for that empty cup. Depending on how many visits your site gets, it may take a few hours to a few weeks to get some reliable data. Sounds like a great time to pick up a new hobby, or to write about how awesome SimpleAB is on your blog and earn money with our [Affiliate program](https://modmore.com/account/affiliate/). :)

We take documentation serious, and we hope this tutorial has helped you understanding creating Template Tests with SimpleAB. If you need more help which is not covered here, or spot any issues, please don't hesitate to [get in touch with support](https://support.modmore.com/) and we'd be glad to help.
