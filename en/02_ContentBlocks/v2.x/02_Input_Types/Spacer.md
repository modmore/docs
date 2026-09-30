The `spacer` input type offers a utility to space out different input types in the manager. It does not return any values and does not require a template. It's useful to fill up a row of inputs with some blank space where appropriate. 

## Accepted properties

- `styles`: an object of css styles to apply to the spacer

## Returned values

- None

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

`spacer` does not persist data; use it only in the editor UI. Template output comes from neighboring inputs.
