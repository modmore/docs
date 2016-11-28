This page tries to explain the Auto Optimizer functionality in SimpleAB and how you can take advantage of it to let your A/B or multivariate tests manage itself.

The Auto Optimizer functionality is available for both Template and Chunk tests. In a nutshell, you define for each test at how many conversions the Smart Optimizer should kick in, and also what percentage of views should be used as a control sample. When it reaches the conversion threshold, it will look at historical conversion rates for each of the variations and start serving the best performing variation. The control sample is the percentage of requests that are served a random variation instead - this makes sure the best performing variation a month ago, still is the best performing variation now.

### Configuring the Auto Optimizer

The Auto Optimizer functionality is optional, but super easy to set up. It's available for both Template and Chunk tests.

#### 1. Set up a Test

Follow the instructions to set up a [Template](Testing_Templates) or [Chunk](Testing_Chunks) test, with variations like you would normally do. In this example, we set up a chunk test for our Call-to-Action button. It has 3 variations set up, however that doesn't matter for this tutorial. Open the _Edit Test_ window from the context menu in the grid, or by using the button at the top right when viewing the test variations and statistics.

![Screenshot for step 1](https://assets.modmore.com/extras/simpleab/autooptimizer1.png)

#### 2. Enable Auto Optimizer

In the _Edit Test_ window, tick the box before "Enable Auto Optimizer". You will notice a few new fields just appeared.

![Screenshot for step 2](https://assets.modmore.com/extras/simpleab/autooptimizer2.png)

#### 3. Choose the right Numbers

By default, the Conversion Threshold is set to 100, and the Randomization Percentage is set to 25. This means that as soon as 100 conversions have been logged, the Auto Optimizer will kick in and choose the best performing variation to serve. A Randomization Percentage of 25 means that 25% (or 1 in 4) of each new requests will pick a random variation instead of the one with the highest conversion rate.

What are the right numbers for your situation? You probably know best. How quickly do you want Smart Optimizer to kick in, and how many conversions get logged in that time? How many picks does it take to get a single conversion? The more data the better, and 100 is probably on the conversions is probably on the lower end of the spectrum.

A randomization percentage of 25% is probably a nice control sample in most cases, but if you get a lot of requests you could bring it down a bit - just make sure that it's not too low as conversion rates are calculated as percentages and if you only serve 1 randomized request which gets a conversion; that's a 100% conversion rate! If you want to provide the Auto Optimizer with a more accurate sample, just bump up the numbers.