With the [ItemUpload extension](https://modmore.com/commerce/extensions/itemupload/), you can accept file uploads when adding a product to the cart, and the uploaded file(s) are stored with that order item.

The file(s) can then be downloaded from the order page, and be attached to outgoing emails.

After downloading the module from the modmore provider, go to Commerce > Modules in the MODX manager to enable the "Item Upload" module and configure its settings.

## Configuration

The module can be configured with the following settings:

- **Upload Field Names**: Comma-separated list of field names that can be used for uploads (e.g., "upload,file,custom_file")
- **Allowed File Extensions**: Comma-separated list of allowed file extensions (e.g., "jpg,jpeg,png,gif,pdf,doc,docx")
- **Maximum File Size**: Maximum file size in bytes (default: 5242880 = 5MB)
- **Media Source**: Select the media source where uploads should be stored (optional)
- **Upload Path**: Relative path within the media source/base path where uploads should be stored (e.g., "uploads/commerce/")
- **Message Keys**: Comma-separated list of message keys for which uploaded files should be attached to emails (e.g., "order_confirmation,order_completed"). Leave empty to attach to all emails. You will also need to add corresponding message keys to your status workflow.

## Usage

### Adding Upload to Cart

The module automatically handles file uploads when items are added to the cart. Simply include file upload fields in your add-to-cart form:

```html
<form method="post" enctype="multipart/form-data" action="[[~cart]]">
    <input type="hidden" name="add_to_cart" value="1" />
    <input type="hidden" name="product" value="[[*id]]" />
    <input type="file" name="upload" />
    <button type="submit">Add to Cart</button>
</form>
```

The module will automatically:
1. Listen to items being added to the cart
2. Process any uploaded files that match your module configuration
3. Validate file type, size, and security
4. Upload the file to the configured media source and path
5. Store the file path in the item properties

**Note:** The field name(s) used in your form must match the configured "Upload Field Names" in the module settings (default: "upload").

### Email Attachments

The module automatically attaches uploaded files to order emails based on the configured message keys. Files are attached when:
- The order email has a message_key that matches one of the configured message keys (or all emails if no keys are configured)
- The uploaded file path is valid and the file exists

### Show in Cart

To show the uploaded file in the cart, use something along these lines (assuming upload field name is "upload"):

````twig
{% if item.properties.upload_upload_original %}
    <br>🔗 <a href="{{ item.properties.upload_upload_full }}" download="{{ item.properties.upload_upload_original }}">{{ item.properties.upload_upload_original }}</a>
{% endif %}
````

The item properties will contain the following 3 keys for each uploaded file:
- `upload_{upload_key}`: the sanitised file name as it exists now in the media source
- `upload_{upload_key}_original`: the original file name
- `upload_{upload_key}_full`: the full file path for where the file was uploaded
