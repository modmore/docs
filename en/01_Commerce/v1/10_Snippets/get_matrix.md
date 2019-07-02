The `commerce.get_matrix` snippet is used to output a [product matrix](../Product_Catalog/Product_Matrix)

Added in 0.12.

## Usage

```` html
[[!commerce.get_matrix? &matrix=`123`]]
````

## Properties

- `&matrix`: the ID of the matrix to output. Typically, you provide the value of the Product Matrix TV here. 
- `&tpl`: the name of a [twig template](../03_Front-end_Theming) to use for rendering the matrix. Defaults to `frontend/matrix/tabular.twig`. 

## Usage

[See the product matrix documentation for examples and how to use this snippet.](../Product_Catalog/Product_Matrix)
