As of MoreGallery v1.9, your MoreGallery installation will share technical information about your implementation with modmore.

To set the consent level, update the **moregallery.data_consent** system setting. During installation or upgrade you can also set the consent level. By default the level is set to 10. 

The data is associated with your license on the modmore server, which means we do have the ability of connecting the collected data to an individual site and the site owner. We may use this data in support or to reach out to individual customers who use certain configurations to ask for clarification or feedback on future functionality.

We only keep the **latest data** that is shared. When new data is provided, it overwrites the previous data we had stored. To gain insight into long-term trends in MoreGallery usage, we aggregate the data from all sites nightly, and turn that into anonymous insights. 

[TOC]

## Supported levels

The default consent level is **10**, which will share basic system settings, gallery and image counts, and your crops and custom field configurations on system and resource level.

* 0+: consent level and installed version
* 5+: count of gallery resources, values of several settings, system-level crops and custom field configuration
* 7+: count of images by type (image/vimeo/youtube)
* 10+: per-resource overrides of crops and custom field configuration. This only contains the crops/cf config; not other resource information
* 12+: source_relative_url system setting
* 15+: per-resource override of source relative url

## Seeing what data you're sharing

To see the exact data that is shared from your site, call the `mgGetImages` snippet with the `&showCollectedData` property:

```html
[[!mgGetImages? &showCollectedData=`1`]]
```

That will dump the exact data to screen for you to inspect. 

## Example data

### Level 0

```json
{
    "level": 0,
    "version": "1.9.0-pl"
}
```

### Level 5

``` json
{
    "level": 5,
    "version": "1.9.0-pl",
    "resources": 5,
    "settings": {
        "image_id_in_name": "prefix",
        "content_position": "below",
        "use_rte_for_images": "1",
        "allowed_extensions_per_source": ""
    },
    "crops": [],
    "custom_fields": [
        "{    \"stories\":{        \"label\":\"Stories behind this image\",        \"type\":\"richtext\"    },    \"copyright\":{        \"label\":\"Copyright\"    },    \"class\":{        \"label\":\"Extra Class\",        \"type\":\"select\",        \"options\":[{            \"value\":\"\",            \"label\":\"None\"        },{            \"value\":\"boxed\",            \"label\":\"Boxed thumbnail\"        }]    }}"
    ]
}
```

### Level 7

```json
{
    "level": 7,
    "version": "1.9.0-pl",
    "resources": 5,
    "settings": {
        "image_id_in_name": "prefix",
        "content_position": "below",
        "use_rte_for_images": "1",
        "allowed_extensions_per_source": ""
    },
    "crops": [],
    "custom_fields": [
        "{    \"stories\":{        \"label\":\"Stories behind this image\",        \"type\":\"richtext\"    },    \"copyright\":{        \"label\":\"Copyright\"    },    \"class\":{        \"label\":\"Extra Class\",        \"type\":\"select\",        \"options\":[{            \"value\":\"\",            \"label\":\"None\"        },{            \"value\":\"boxed\",            \"label\":\"Boxed thumbnail\"        }]    }}"
    ],
    "types": {
        "mgImage": 44,
        "mgVimeoVideo": 7,
        "mgYouTubeVideo": 10
    }
}
```

### Level 10

```json
{
    "level": 10,
    "version": "1.9.0-pl",
    "resources": 5,
    "settings": {
        "image_id_in_name": "prefix",
        "content_position": "below",
        "use_rte_for_images": "1",
        "allowed_extensions_per_source": ""
    },
    "crops": [
        "small:width=200,height=400",
        "desktop:default_aspect=1.75,width=600|mobile:default_aspect=1.75,width=200",
        "foo",
        "small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7|large:height=750"
    ],
    "custom_fields": [
        "{    \"stories\":{        \"label\":\"Stories behind this image\",        \"type\":\"richtext\"    },    \"copyright\":{        \"label\":\"Copyright\"    },    \"class\":{        \"label\":\"Extra Class\",        \"type\":\"select\",        \"options\":[{            \"value\":\"\",            \"label\":\"None\"        },{            \"value\":\"boxed\",            \"label\":\"Boxed thumbnail\"        }]    }}",
        "{\"class\":{\"label\":\"Slide Type\",\"type\":\"select\",\"options\":[{\"value\":\"\",\"label\":\"All Devices\"},{\"value\":\"desktop-only\",\"label\":\"Desktop Only\"},{\"value\":\"mobile-only\",\"label\":\"Mobile Only\"},{\"value\":\"text-slide\",\"label\":\"Text Slide\"}]}}"
    ],
    "types": {
        "mgImage": 44,
        "mgVimeoVideo": 7,
        "mgYouTubeVideo": 10
    }
}
```

### Level 12

``` json
{
    "level": 12,
    "version": "1.9.0-pl",
    "resources": 5,
    "settings": {
        "image_id_in_name": "prefix",
        "content_position": "below",
        "use_rte_for_images": "1",
        "allowed_extensions_per_source": ""
    },
    "crops": [
        "small:width=200,height=400",
        "desktop:default_aspect=1.75,width=600|mobile:default_aspect=1.75,width=200",
        "foo",
        "small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7|large:height=750"
    ],
    "custom_fields": [
        "{    \"stories\":{        \"label\":\"Stories behind this image\",        \"type\":\"richtext\"    },    \"copyright\":{        \"label\":\"Copyright\"    },    \"class\":{        \"label\":\"Extra Class\",        \"type\":\"select\",        \"options\":[{            \"value\":\"\",            \"label\":\"None\"        },{            \"value\":\"boxed\",            \"label\":\"Boxed thumbnail\"        }]    }}",
        "{\"class\":{\"label\":\"Slide Type\",\"type\":\"select\",\"options\":[{\"value\":\"\",\"label\":\"All Devices\"},{\"value\":\"desktop-only\",\"label\":\"Desktop Only\"},{\"value\":\"mobile-only\",\"label\":\"Mobile Only\"},{\"value\":\"text-slide\",\"label\":\"Text Slide\"}]}}"
    ],
    "types": {
        "mgImage": 44,
        "mgVimeoVideo": 7,
        "mgYouTubeVideo": 10
    },
    "source_relative_url": [
        "assets\/galleries\/"
    ]
}
```

### Level 15

``` json
{
    "level": 15,
    "version": "1.9.0-pl",
    "resources": 5,
    "settings": {
        "image_id_in_name": "prefix",
        "content_position": "below",
        "use_rte_for_images": "1",
        "allowed_extensions_per_source": ""
    },
    "crops": [
        "small:width=200,height=400",
        "desktop:default_aspect=1.75,width=600|mobile:default_aspect=1.75,width=200",
        "foo",
        "small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7|large:height=750"
    ],
    "custom_fields": [
        "{    \"stories\":{        \"label\":\"Stories behind this image\",        \"type\":\"richtext\"    },    \"copyright\":{        \"label\":\"Copyright\"    },    \"class\":{        \"label\":\"Extra Class\",        \"type\":\"select\",        \"options\":[{            \"value\":\"\",            \"label\":\"None\"        },{            \"value\":\"boxed\",            \"label\":\"Boxed thumbnail\"        }]    }}",
        "{\"class\":{\"label\":\"Slide Type\",\"type\":\"select\",\"options\":[{\"value\":\"\",\"label\":\"All Devices\"},{\"value\":\"desktop-only\",\"label\":\"Desktop Only\"},{\"value\":\"mobile-only\",\"label\":\"Mobile Only\"},{\"value\":\"text-slide\",\"label\":\"Text Slide\"}]}}"
    ],
    "types": {
        "mgImage": 44,
        "mgVimeoVideo": 7,
        "mgYouTubeVideo": 10
    },
    "source_relative_url": [
        "assets\/galleries\/",
        "testgalleries\/local\/"
    ]
}
```

