> **Note:** This page documents MODX system events carried forward from ContentBlocks 1.x. Verify event names and signatures against your ContentBlocks 2 installation. For v2-specific events, see [Server Events](index).

ContentBlocks provides several events that allow you to extend and customize its functionality.

[TOC]

## Quick Start

Here are the most common scenarios:

- **Create custom input types**: Return JavaScript and CSS URLs from `ContentBlocks_RegisterInputs`. See [Registering Inputs](../01_Custom_Inputs/Registering_Inputs).
- **Modify content on save**: Use `ContentBlocks_RenderContent` to transform content before it's stored
- **Customize templates**: Use `ContentBlocks_BeforeParse` and `ContentBlocks_AfterParse` to modify how individual content is parsed

## Available Events

- `ContentBlocks_RegisterInputs` - JavaScript and CSS for custom inputs
- `ContentBlocks_RenderContent` - Modify content before saving
- `ContentBlocks_RebuildContent` - Hook into content rebuild process
- `ContentBlocks_AfterRebuildContent` - Run code after rebuild completes
- `ContentBlocks_BeforeParse` - Modify templates before rendering
- `ContentBlocks_AfterParse` - Modify final output after rendering

## ContentBlocks_RegisterInputs

Return JavaScript and CSS URLs for a custom input. ContentBlocks loads those files immediately after its own canvas assets.

```php
$modx->event->output([
    'inputNameHere' => [
        'js' => $assetsUrl . 'js/inputs/inputnamehere.js',
        'css' => $assetsUrl . 'css/inputnamehere.css',
    ],
]);
```

See [Registering Inputs](../01_Custom_Inputs/Registering_Inputs).

## ContentBlocks_RenderContent

> Not yet updated for v2

**Purpose**: Modify content before it's saved to the database

**When it fires**:
- When a resource is saved (after content is retrieved but before HTML is generated)
- During content rebuild operations

**What you get**:
- `cbContent` - The ContentBlocks content as an array
- `cbJson` - The original JSON string from the database
- `resource` - The MODX resource object

**What to return**: An array with modified content, or nothing if no changes are needed

### Common Use Cases

- **Data Migration**: Update field names or structure when upgrading
- **Content Validation**: Ensure content meets business rules
- **Content Enhancement**: Add metadata or transform values

**Example**: Adding a timestamp to all text blocks

```php
// System Event: ContentBlocks_RenderContent
$cbContent = $scriptProperties['cbContent'];
$cbJson = $scriptProperties['cbJson'];
$resource = $scriptProperties['resource'];

$modified = false;

// Add timestamp to all text blocks
foreach ($cbContent as &$block) {
    if ($block['field'] === 'text' && !empty($block['value'])) {
        $block['value'] .= "\n<p class=\"timestamp\">Last updated: " . date('Y-m-d H:i:s') . "</p>";
        $modified = true;
    }
}

if ($modified) {
    // Update the JSON string
    $cbJson = $modx->toJSON($cbContent);
    return [
        'cbContent' => $cbContent,
        'cbJson' => $cbJson
    ];
}

// No changes needed
return null;
```

**Important Notes**:
- Multiple plugins can run - only the first non-empty response is used
- Return `null` or nothing if you don't want to modify the content
- Always update both `cbContent` and `cbJson` when making changes

## ContentBlocks_RebuildContent

> Not yet updated for v2

**Purpose**: Run code during the content rebuild process

**When it fires**: During "Rebuild Content" operations, for each resource being rebuilt

**What you get**:
- `cbContent` - The ContentBlocks content array
- `resource` - The MODX resource object being rebuilt

**What to return**: Nothing (return value is ignored)

### Common Use Cases

- **Progress Tracking**: Log which resources are being processed
- **Cache Management**: Clear caches for specific resources
- **External Integration**: Update search indexes or external systems

**Example**: Logging rebuild progress

```php
// System Event: ContentBlocks_RebuildContent
$resource = $scriptProperties['resource'];
$cbContent = $scriptProperties['cbContent'];

// Log the rebuild progress
$modx->log(modX::LOG_LEVEL_INFO,
    '[ContentBlocks] Rebuilding resource #' . $resource->get('id') .
    ' (' . $resource->get('pagetitle') . ')'
);

// Optional: Clear any cached data for this resource
if ($modx->getCacheManager()) {
    $modx->cacheManager->delete('resource/' . $resource->get('id'));
}
```

## ContentBlocks_AfterRebuildContent

> Not yet updated for v2

**Purpose**: Run code after the entire rebuild process completes

**When it fires**: After all resources have been processed during a rebuild operation

**What you get**:
- `total` - Total number of resources processed
- `total_skipped` - Number of resources skipped (not using ContentBlocks)
- `total_skipped_broken` - Number skipped due to corrupted data
- `total_rebuild` - Number of resources successfully rebuilt

**What to return**: Nothing (return value is ignored)

### Common Use Cases

- **Cache Management**: Clear or warm up caches after rebuild
- **External Systems**: Update search indexes or trigger external processes

**Example**: Sending a completion notification

```php
// System Event: ContentBlocks_AfterRebuildContent
$total = $scriptProperties['total'];
$rebuilt = $scriptProperties['total_rebuild'];
$skipped = $scriptProperties['total_skipped'];
$broken = $scriptProperties['total_skipped_broken'];

// Log completion statistics
$modx->log(modX::LOG_LEVEL_INFO,
    '[ContentBlocks] Rebuild completed: ' . $rebuilt . ' rebuilt, ' .
    $skipped . ' skipped, ' . $broken . ' broken'
);

// Optional: Send notification email
if ($rebuilt > 0) {
    $message = "ContentBlocks rebuild completed successfully.\n";
    $message .= "Resources rebuilt: " . $rebuilt . "\n";
    $message .= "Resources skipped: " . $skipped . "\n";
    $message .= "Resources with errors: " . $broken;

    // Send email notification (implement your email logic here)
    // mail('admin@yoursite.com', 'ContentBlocks Rebuild Complete', $message);
}
```

## ContentBlocks_BeforeParse

> Not yet updated for v2

**Purpose**: Modify templates before they're processed and rendered

**When it fires**: Before ContentBlocks processes a template (before placeholder replacement)

**What you get**:
- `tpl` - The template string (HTML, @CHUNK, @FILE, etc.)
- `phs` - Array of placeholders that will be used

**What to return**: A new template string, or nothing if no changes needed

### Common Use Cases

- **Dynamic Templates**: Switch templates based on conditions
- **Template Injection**: Add wrapper markup or modify structure
- **Conditional Rendering**: Use different chunks based on content

**Example**: Implementing a custom Twig parser

```php
// System Event: ContentBlocks_BeforeParse
$tpl = $scriptProperties['tpl'];
$phs = $scriptProperties['phs'];

// Check if this template uses Twig syntax
if (strpos($tpl, '{{') !== false || strpos($tpl, '{%') !== false) {
    // Load Twig if not already loaded
    if (!class_exists('Twig\Environment')) {
        require_once MODX_CORE_PATH . 'components/twig/vendor/autoload.php';
    }

    try {
        // Create Twig environment
        $loader = new \Twig\Loader\ArrayLoader(['template' => $tpl]);
        $twig = new \Twig\Environment($loader);

        // Add custom filters and functions
        $twig->addFilter(new \Twig\TwigFilter('modx_resource', function($id) use ($modx) {
            $resource = $modx->getObject('modResource', $id);
            return $resource ? $resource->toArray() : null;
        }));

        $twig->addFunction(new \Twig\TwigFunction('modx_chunk', function($name) use ($modx) {
            $chunk = $modx->getObject('modChunk', ['name' => $name]);
            return $chunk ? $chunk->getContent() : '';
        }));

        // Render the template with ContentBlocks placeholders
        $rendered = $twig->render('template', $phs);

        // Return the rendered template
        $modx->event->output($rendered);

    } catch (Exception $e) {
        // Log error and fall back to original template
        $modx->log(modX::LOG_LEVEL_ERROR,
            '[ContentBlocks] Twig parsing error: ' . $e->getMessage()
        );
    }
}

// No changes needed
return null;
```

**Important Notes**:
- You can't modify placeholders directly - only the template
- Multiple plugins can run - only the first non-empty response is used
- Keep processing fast as this runs for every block during rendering

## ContentBlocks_AfterParse

> Not yet updated for v2

**Purpose**: Modify the final HTML output after all processing is complete

**When it fires**: After ContentBlocks has finished processing and rendering the template

**What you get**:
- `tpl` - The final HTML output string
- `phs` - The placeholders that were used during processing

**What to return**: A modified HTML string, or nothing if no changes needed

### Common Use Cases

- **Output Enhancement**: Add CSS classes, wrap content, or inject scripts
- **Content Processing**: Minify HTML, add analytics tracking, or modify URLs
- **Security**: Sanitize output or add security headers

**Example**: Adding responsive wrapper and analytics tracking

```php
// System Event: ContentBlocks_AfterParse
$output = $scriptProperties['tpl'];
$phs = $scriptProperties['phs'];

// Add responsive wrapper if specified
if (!empty($phs['responsive']) && $phs['responsive'] === 'true') {
    $output = '<div class="content-block-responsive">' . $output . '</div>';
}

// Add analytics tracking for specific content types
if (!empty($phs['content_type']) && $phs['content_type'] === 'hero') {
    $output .= '<script>gtag("event", "hero_view", {"content_type": "hero"});</script>';
}

// Add lazy loading to images
$output = preg_replace('/<img([^>]+)src=/', '<img$1data-src=', $output);
$output = str_replace('<img', '<img loading="lazy"', $output);

$modx->event->output($output);
```

**Important Notes**:
- This runs for every block during rendering - keep it fast
- Multiple plugins can run - only the first non-empty response is used
- This is your last chance to modify the output before it's saved
