The scFirstChild snippet is used as an output modifier in various places of SimpleCart. Its purpose is to return the ID of the first child resource of the resource ID provided. 

[TOC]

## Standard Usage

````
[[*id:scFirstChild]]
````
or
````
[[scFirstChild? &id=`[[*id]]`]]
````

## Properties

When called as an output modifier, this snippet does not have any properties. When used as snippet, it expects the `&id` property to hold the resource ID it needs the child from. 