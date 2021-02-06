While we recommend using [Custom Formatting](Custom_Formatting) where possible, if desired you can give your users the ability to select the **text color**, **font family** and **font size** manually.

On the **Toolbar** tab of the configurator, you can add the `fontcolor`, `fontfamily` and `fontsize` toolbar buttons to enable these options.

These options will add span tags with inline styles. To use span tags with classes or to apply styles/classes to the block level tags, use [Custom Formatting](Custom_Formatting).

## Customising available colors

As of Redactor v3.1, you can customise the colors available in the text/font color (`fontcolor` button) dropdown. Both the "text" and "highlight" tabs use the same colors.

On the **Formatting** tab of the configurator, enter a comma-separated list of colors (in hex notation, or another CSS-valid color name). Each row in the dropdown has room for 11 colors.

The default colors are:

```
#ffffff, #000000, #eeece1, #1f497d, #4f81bd, #c0504d, #9bbb59, #8064a2, #4bacc6, #f79646, #ffff00,
#f2f2f2, #7f7f7f, #ddd9c3, #c6d9f0, #dbe5f1, #f2dcdb, #ebf1dd, #e5e0ec, #dbeef3, #fdeada, #fff2ca,
#d8d8d8, #595959, #c4bd97, #8db3e2, #b8cce4, #e5b9b7, #d7e3bc, #ccc1d9, #b7dde8, #fbd5b5, #ffe694,
#bfbfbf, #3f3f3f, #938953, #548dd4, #95b3d7, #d99694, #c3d69b, #b2a2c7, #b7dde8, #fac08f, #f2c314,
#a5a5a5, #262626, #494429, #17365d, #366092, #953734, #76923c, #5f497a, #92cddc, #e36c09, #c09100,
#7f7f7f, #0c0c0c, #1d1b10, #0f243e, #244061, #632423, #4f6128, #3f3151, #31859b,  #974806, #7f6000
```

## Customising available fonts

As of Redactor v3.1, you can customise the available fonts for the `fontfamily` toolbar button.

Provide a comma-separated list of font names (no quotes necessary) on the **Formatting** tab in the configurator, for `Font Family Options`. 

The default font families are:

``` 
Arial, Helvetica, Georgia, Times New Roman, Monospace
```

## Customising available font sizes

It's not currently possible to change the available font sizes. They are hard-coded to `10, 11, 12, 14, 16, 18, 20, 24, 28, 30`. If customising these is important to you and you are unable of using the custom formatting instead, please let us know.
