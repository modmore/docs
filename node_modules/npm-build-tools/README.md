# npm-build-tools

These scripts for sass and js files process all js/sass files together if one of them has been updated. This makes importing easy.

## Installation

You can easily install the tools with `npm install christianseel/npm-build-tools`.

## Example usage

Add this to you `package.json`:

```
  "scripts": {
    "clean": "rimraf assets/tpl/dist/*",
    
    "lint": "jshint assets/tpl/sources/js",
    
    "build": "npm run build:js && npm run build:css",
    
    "build:js": "node node_modules/npm-build-tools/index.js --path \"assets/tpl/sources/js/\" --ext \"js\" --outputDir \"assets/tpl/dist/\"",
    "prebuild:js": "npm run lint",
    
    "build:css": "node node_modules/npm-build-tools/index.js --path \"assets/tpl/sources/scss/\" --ext \"scss\" --outputDir \"assets/tpl/dist/\" --outputStyle \"compressed\" --browsers \"['> 2%', 'last 2 versions', 'ie >= 10', 'and_chr >= 2.3']\""
  }
```
