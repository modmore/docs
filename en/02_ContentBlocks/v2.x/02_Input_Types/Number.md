The `number` input lets the editor provide a numeric value. 

[TOC]

## Supported properties

- `min`: the minimum value that will be accepted
- `max`: the maximum value that will be accepted
- `steps`: the size of the steps between the min and max that is allowed. For example `1` requires the value to be an integer, but `0.5` will allow half values. 
- `styles`: an object of css styles to apply to the input

## Returned values

- `value`: the provided number

## Example block

```json 
{
    "title": "Completed Projects",
    "description": "Number of completed projects this year.",
    "inputs": {
        "projectsLabel": {
            "type": "label",
            "width": 30,
            "properties": {
                "for": "projects",
                "text": "projects"
            }
        },
        "projects": {
            "type": "number",
            "width": 30,
            "properties": {
                "min": 0,
                "steps": 1
            }
        },
        "projectsSpacer": {
            "type": "spacer",
            "width": 40
        }
    }
}
```

## Example template structures

### Twig

```twig
{% if projects.value is not empty %}
    <p class="stat">
        <strong>{{ projects.value }}</strong> projects completed
    </p>
{% endif %}
```

### tpl

```tpl
[[+projects.value:notempty=`<p class="stat"><strong>[[+projects.value]]</strong> projects completed</p>`]]
```
