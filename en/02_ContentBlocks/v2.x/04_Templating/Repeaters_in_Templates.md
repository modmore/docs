Repeater inputs store an array of rows. Each row contains the nested input values for that row.

[TOC]

## Block configuration

This block stores a `teamMembers` repeater. Each row has `name`, `position`, `bio`, and `image` inputs, which is the shape used in the data and Twig examples below.

```json
{
    "title": "Team Members",
    "description": "Add team members to your page",
    "icon": "users",
    "inputs": {
        "teamMembers": {
            "type": "repeater",
            "width": 100,
            "properties": {
                "minimumRows": 1,
                "maximumRows": 10,
                "inputs": {
                    "name": {
                        "type": "text",
                        "width": 50,
                        "properties": {
                            "placeholder": "Name"
                        }
                    },
                    "position": {
                        "type": "text",
                        "width": 50,
                        "properties": {
                            "placeholder": "Position"
                        }
                    },
                    "bio": {
                        "type": "richtext",
                        "width": 100,
                        "properties": {}
                    },
                    "image": {
                        "type": "image",
                        "width": 100,
                        "properties": {}
                    }
                }
            }
        }
    }
}
```

See [Repeater input](../02_Input_Types/Repeater) for the full property list.

## Data structure

The data from that repeater would look something like this:

```json
{
    "teamMembers": {
        "rows": [
            {
                "name": { "value": "John Doe" },
                "position": { "value": "CEO" },
                "bio": { "value": "..." },
                "image": { "value": "assets/images/john.jpg" }
            }
        ]
    }
}
```

## Template (Twig)

We recommend using Twig templates for repeaters to use the looping functionality.

```twig
<ul class="team-list">
{% for row in teamMembers.rows %}
    <li>
        <h3>{{ row.name.value }}</h3>
        <p class="role">{{ row.position.value }}</p>
        <div>{{ row.bio.value|raw }}</div>
        {% if row.image.value %}
            <img src="{{ row.image.value }}" alt="{{ row.name.value }}">
        {% endif %}
    </li>
{% endfor %}
</ul>
```
