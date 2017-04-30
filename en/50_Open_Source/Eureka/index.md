The Eureka Media Browser allows users to browse media sources as well as upload, rename, and delete media&nbsp;items.

## Options 
| Option        | Default           | Description  |
| ------------- |:-------------:| -----|
| `allowUploads`      | `true`      |   Whether or not to allow uploading of media items |
| `useLocalStorage` | `true`      |    Whether or not to use the JavaScript `localStorage` API to remember session data such as the last visited directory and view mode preference |
| `storagePrefix` | `"eureka__"`      |    Prepended to `localStorage` keys |
| `allowRename` | `true`      |    Whether or not to offer users the ability to rename directories and media items |
| `allowDelete` | `true`      |    Whether or not to offer users the ability to delete directories and media items |
| `allowDownload` | `false`      |    Whether or not to add a download button to media items |
| `confirmBeforeDelete` | `false`      |    Whether or not to confirm intent before users delete directories and media items |
| `locale` | `"en-US"`      |    The localization to use. See Lexicons. |
| `mediaSource` | `undefined`      |    The default initial media source id to use |
| `currentDirectory` | `"/"`      |    The default initial directory to use |
| `enlargeFocusedRows` | `false`      |    Whether or not to enlarge thumbnails of focused rows |
| `mode` | `"table"`      |    Initial view mode (table, thumb, grid, list) |
| `sort` | `"name"`      |    Initial column to sort media items on |
| `allowFullscreen` | `true`      |    Whether or not the interface should offer a fullscreen button |
| `emphasisFocusedMediaItem` | `true`      |    Whether or not to emphasis selected media items (defaults to emphasizing the filename, only applies to table and list view modes) |
| `doDragNDrop` | `true`      |    Whether or not to enable drag 'n drop features |


## Accessibility 
Not a single feature relies solely on sight or the usage of sight or a mouse. The entire interface is navigable by the keyboard and a combination of ARIA attributes and visually hidden text are used to provide an accessible experience to assistive technology users. 

Eureka follows the principle of designing for users on extreme ends of the spectrum and letting the middle fill itself in. This means that abled bodied users as well as those with multiple disabilities were equally considered throughout the design process.

### International Considerations
Eureka is powered by React Intl and supports several localizations. You may [Request and contribute to translations](https://github.com/jpdevries/eureka#-i18n).

### Device Considerations

**Mobile**  
Eureka's mobile&ndash;first design provides accessibility to touch device users. Fat&ndash;finger&ndash;friendly considerations such as increased font sizes and tap targets allow for a more usable experience. Depending on the current view mode, there may not always be a choose button visible on screen. A double&ndash;tap&ndash;to&ndash;choose feature allows mobile users to choose media items even when the choose buttons are off canvas. 

**Desktop**  
Users on larger viewports may appreciate a two column layout, with ever present yet collapsable media source tree, modern Grid Layout, and large high quality thumbnails. A "holy&ndash;grail" layout is used to keep all toolbars ever present even when viewing large directories. Multiple media items can be selected and downloaded as a zip file. 

### Motor Considerations

**Disabled**  
Eureka does not rely on a mouse, making it fully accessible to keyboard users. The default tabular view mode presents a contextual row of actions below focused media items, allow context menu like features to be accessed without the use of a mouse. Images uploaded when pasted from the clipboard into anywhere within the web component, making the act of uploading images always nearby. A `confirmBeforeDelete` option helps users with mobility issues prevent unintentional deletions. 

The choose, delete and download multiple items features can drastically reduce user exhaustion and as such was designed as an accessibility consideration for users with motor disabilities, as well as a convenience for all users. Paired with the invert selection feature, users can perform complex actions such as selection and choosing or deleting hundreds of items in just a few steps.


From user feedback and testing, we learned that abled considerations, such as drag 'n drop can be problematic to some users. Set `eureka.disableDragNDrop` to `true` to disable drag 'n drop.

**Abled**  
Sighted mouse users may benefit from familiar drag 'n drop functionality and, in supported browsers, right click context menus. 

### Visual Considerations

**Disabled**  
Eureka supports standard high contrast modes. Based off user agent settings, such as Microsoft Windows High Contrast settings, Eureka will automatically switch to white-on-black or black-on-white themes. 

**Abled**  
Eureka supports theming via CSS Properties. Sighted users can set CSS Properties in their own stylesheets to customize the look and feel of the Eureka interface. The Fullscreen API is leveraged to give sighted users more pixels to browse with. Four different view modes give sighted users options for how they view Eureka. A Masonry view mode is available to maximize the viewing area of thumbnails for sighted users. 

### Audible Considerations 
**Disabled**  
Screen reader users appreciate Eureka's usage of ARIA attributes and visually hidden text to describe the interface for non&ndash;sighted access. While the choose button for "turtle.jpg" may visually read "Choose", ensuring visual correlations are relayed non&ndash;visually to assistive technology, it will be relayed as "Choose turtle.jpg".

**Abled**  
Eureka supports multiple embed types for media items, including `<audio>` for playback of audio files. Not only does Eureka let you see your media items, it lets you hear them too.

### Cognitive Considerations

**Disabled**  
By default, Eureka will welcome new users, upon their first visit, with a friendly message and a link to learn more. Set the `eureka.alwaysWelcome` message to `true` to always display this message. When choosing multiple items, the PathBar component displays a click&ndash;to&ndash;copy textarea with a list of currently selected file names. This region is politely read to screen reader users, reminding them what is selected. It also is useful for copying the list to keep a record or discuss actions taken on these items with a colleague. A `confirmBeforeDelete` option will help prevent users from accidentally deleting items, but also will remind you what you are about to delete.

**Abled**  
Local Storage is used to allow Eureka to open back up to wherever it was you left off. This is a connivence as well as an accessibility consideration for the cognitively disabled. If you'd rather not be reminded where you last were browsing, set `eureka.useLocalStorage` to `false` to always open Eureka to the root of the default media source. 

**Keyboard Shortcuts**  
As part of our accessibility and power&ndash;user considerations, Eureka provides the following keyboard shortcuts. 

| Shortcut        | Command              |
| --------------- |:-------------:       |
| Toggle Sidebar      | ctrl+;           |
| Change View      | ctrl+alt+(1-5)      |
| Change Media Source | alt+(1-9)        |
| Delete Item | backspace                |
| Expand Item | spacebar                 |
| Choose Item | return                   |
| Create Directory | ctrl+n              |
| Create file | ctrl+shift+n              |
| Upload Files | ctrl+u                  |
| Rename Item | ctrl+r                   |
| Filter Items | ctrl+f                  |
| Sort Ascending | alt+up                  |
| Sort Descending | alt+down                  |
| Sort by filename | alt+n                  |
| Sort by dimensions | alt+d                  |
| Sort by file size | alt+f                  |
| Sort by edited on | alt+e                  |
