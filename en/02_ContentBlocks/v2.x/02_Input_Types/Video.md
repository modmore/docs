The `video` input type lets editors embed a video by searching YouTube via the YouTube Data API, selecting a file from the MODX media browser, or pasting a supported video URL. Supported hosts are **YouTube**, **Vimeo**, **Wistia**, **Loom**, and **direct** video files (`.mp4`, `.webm`, `.ogg`, `.mov`).

Selected videos are stored as structured data with a provider-specific ID, a ready-to-use embed URL, and optional metadata.

[TOC]

## Accepted properties

- `providers`: array of enabled providers. Defaults to all supported providers: `["youtube", "vimeo", "wistia", "loom", "direct"]`. When only one provider is listed, pasting only recognises that provider.
- `youtube_search`: when `true` (default), editors can search YouTube by keyword in the manager. Set to `false` to hide the search button; YouTube URLs can still be pasted.
- `youtube_api_key`: YouTube Data API key used for keyword search in the manager. When omitted, ContentBlocks uses a built-in default key. Set your own key when you need dedicated API quota or the default key is unavailable. See [Getting a YouTube API key](#getting-a-youtube-api-key) below.
- `source`: the media source ID to use when opening the browser for direct videos (defaults to `MODx.config.default_media_source`).
- `directory`: optional directory path to open the media browser in when selecting direct videos.
- `file_types`: comma-separated list of allowed video file extensions for the media browser (defaults to `mp4,webm,ogg,mov`).
- `placeholder`: placeholder text for the paste-link field (defaults to the `contentblocks.video.paste_link` lexicon entry).
- `styles`: an object of CSS styles applied to the input container.

## Returned values

- `provider`: the video host (`youtube`, `vimeo`, `wistia`, `loom`, or `direct`).
- `value`: the provider-specific video ID or URL (for example `dQw4w9WgXcQ` for YouTube, `123456789` for Vimeo, or a direct file URL).
- `embed_url`: a ready-to-use URL for the manager preview and front-end embed (`iframe` `src` for hosted videos, `video` `src` for direct files).
- `thumbnail_url`: optional thumbnail URL (typically set when choosing a video from YouTube search).
- `title`: optional video title (typically set when choosing a video from YouTube search or the media browser).

## Manager behaviour

- When YouTube is enabled and `youtube_search` is not `false`, editors can open a search modal to find embeddable YouTube videos by keyword.
- When direct video is enabled, editors can open the MODX media browser to pick a self-hosted video file.
- Editors can paste a supported video URL into the text field; the matching provider is detected automatically.
- When a video is selected, an inline preview is shown below the controls (iframe for hosted videos, `<video>` for direct files).
- Search, browse, and paste controls remain in the input area so editors can change the video without opening the block drawer.

## Getting a YouTube API key

Keyword search in the manager calls the [YouTube Data API v3](https://developers.google.com/youtube/v3) from the browser. You need a Google Cloud project with that API enabled and an API key you can pass as `youtube_api_key` in the input properties.

1. Sign in to the [Google Cloud Console](https://console.cloud.google.com/) with a Google account that can create or manage projects.
2. Create a project (or select an existing one) from the project picker at the top of the page.
3. Open **APIs & Services → Library**, search for **YouTube Data API v3**, and click **Enable** for your project.
4. Open **APIs & Services → Credentials** and click **Create credentials → API key**.
5. Copy the generated key and add it to your block definition:

```json
{
  "properties": {
    "youtube_api_key": "AIza..."
  }
}
```

6. (Recommended) Click the new key in the credentials list to edit it:
   - Under **API restrictions**, choose **Restrict key** and select **YouTube Data API v3** only.
   - Under **Application restrictions**, choose **HTTP referrers (web sites)** and add your MODX manager URL pattern, for example:
     - `https://www.example.com/manager/*`
     - `https://example.com/manager/*`

   Restricting by referrer limits use of the key to your manager and reduces the risk if the key is exposed in client-side JavaScript.

Google provides a free daily quota for the YouTube Data API. Each search in ContentBlocks consumes quota from the key in use (the built-in default or your own). Monitor usage under **APIs & Services → Dashboard** if editors search frequently.

Pasting a video link does **not** use the API key — only the YouTube search modal does.

## Example block

```json
{
    "title": "Video Embed",
    "description": "Search for a YouTube video, or paste a direct link...",
    "icon": "video",
    "inputs": {
        "video": {
            "type": "video",
            "properties": {}
        }
    }
}
```

## Example block (YouTube only)

```json
{
    "title": "Video Embed",
    "description": "Search for a YouTube video, or paste a direct link...",
    "icon": "video",
    "inputs": {
        "video": {
            "type": "video",
            "properties": {
                "providers": ["youtube"],
                "youtube_api_key": "your-youtube-data-api-key"
            }
        }
    }
}
```

## Example block (paste only, no YouTube search)

```json
{
    "inputs": {
        "video": {
            "type": "video",
            "properties": {
                "youtube_search": false
            }
        }
    }
}
```

## Example template structures

Prefer `video.embed_url` in templates so the host does not matter.

### Twig

```twig
{% if video.embed_url|default(video.value) %}
    <div class="video-embed video-embed--{{ video.provider|default('youtube') }}">
        {% if video.provider|default('') == 'direct' %}
            <video src="{{ video.embed_url }}" controls></video>
        {% else %}
            <iframe src="{{ video.embed_url|default('//www.youtube.com/embed/' ~ video.value) }}" frameborder="0" allowfullscreen></iframe>
        {% endif %}
    </div>
{% endif %}
```

### tpl

```tpl
[[+provider:eq=`direct`:then=`
    <div class="video-embed video-embed--direct"><video src="[[+embed_url]]" controls></video></div>
`:else=`
    [[+embed_url:notempty=`
        <div class="video-embed video-embed--[[+provider]]"><iframe src="[[+embed_url]]" frameborder="0" allowfullscreen></iframe></div>
    `:default=`
        <div class="video-embed video-embed--youtube"><iframe src="//www.youtube.com/embed/[[+value]]" frameborder="0" allowfullscreen></iframe></div>
    `]]
`]]
```
