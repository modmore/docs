[TOC]

## Default

When using `Gitify init` and answering Yes to all questions, and keeping the data directory as the default, this is the `.gitify` file you and up with:

````
data_directory: _data/
backup_directory: _backup/
data:
    contexts:
        class: modContext
        primary: key
    context_settings:
        class: modContextSetting
        primary:
            - context_key
            - key
    template_variables:
        class: modTemplateVar
        primary: name
    template_variables_access:
        class: modTemplateVarTemplate
        primary:
            - tmplvarid
            - templateid
    content:
        type: content
        exclude_keys:
            - editedby
            - editedon
        truncate_on_force:
            - modTemplateVarResource
    categories:
        class: modCategory
        primary: category
        truncate_on_force:
            - modCategoryClosure
    templates:
        class: modTemplate
        primary: templatename
        extension: .html
    chunks:
        class: modChunk
        primary: name
        extension: .html
    snippets:
        class: modSnippet
        primary: name
        extension: .php
    plugins:
        class: modPlugin
        primary: name
        extension: .php
    plugin_events:
        class: modPluginEvent
        primary:
            - pluginid
            - event
    events:
        class: modEvent
        primary: name
    namespaces:
        class: modNamespace
        primary: name
    system_settings:
        class: modSystemSetting
        primary: key
        exclude_keys:
            - editedon
    extension_packages:
        class: modExtensionPackage
        primary: namespace
        exclude_keys:
            - created_at
            - updated_at
    fc_sets:
        class: modFormCustomizationSet
        primary: id
    fc_profiles:
        class: modFormCustomizationProfile
        primary: id
    fc_profile_usergroups:
        class: modFormCustomizationProfileUserGroup
        primary:
            - usergroup
            - profile
    fc_action_dom:
        class: modActionDom
        primary:
            - set
            - name
    mediasources:
        class: modMediaSource
        primary: id
    mediasource_elements:
        class: sources.modMediaSourceElement
        primary:
            - source
            - object_class
            - object
            - context_key
    dashboards:
        class: modDashboard
        primary:
            - id
            - name
    dashboard_widgets:
        class: modDashboardWidget
        primary: id
    dashboard_widget_placement:
        class: modDashboardWidgetPlacement
        primary:
            - dashboard
            - widget
````

## Including other XPDO objects 

To include ACL-related objects, that is Policies and PolicyTemplates, the following additional data part should do the trick. _Note: these configuration is currently not asked by the init command!_

```` 
    access_policy_templates:
        class: modAccessPolicyTemplate
        primary:
            - id
            - name
    access_policy:
        class: modAccessPolicy
        primary:
            - id
            - name
    access_policy_template_group:
        class: modAccessPolicyTemplateGroup
        primary:
            - id
            - name
````

## Almost a full site

Keep adding stuff to it, and you might end up with something more like this:

````
name: modmore.com
data_directory: _data/
data:
  contexts:
    class: modContext
    primary: key
  context_settings:
    class: modContextSetting
    primary: [context_key, key]
    exclude_keys:
      - editedon
  content:
    type: content
    exclude_keys:
      - editedby
      - editedon
  categories:
    class: modCategory
    primary: category
  templates:
    class: modTemplate
    primary: templatename
  template_variables:
    class: modTemplateVar
    primary: name
  template_variables_access:
    class: modTemplateVarTemplate
    primary: [tmplvarid, templateid]
  chunks:
    class: modChunk
    primary: name
  snippets:
    class: modSnippet
    primary: name
    extension: .php
  plugins:
    class: modPlugin
    primary: name
    extension: .php
  plugin_events:
    class: modPluginEvent
    primary: [pluginid,event]

  events:
    class: modEvent
    primary: name
  namespaces:
    class: modNamespace
    primary: name
  extension_packages:
    class: modExtensionPackage
    primary: namespace
  action:
    class: modAction
    primary: [id, namespace]
  system_settings:
    class: modSystemSetting
    primary: key
    exclude_keys:
      - editedon

  cb_fields:
    class: cbField
    primary: [id, name]
    package: contentblocks
  cb_categories:
    class: cbCategory
    primary: [id, name]
  cb_layouts:
    class: cbLayout
    primary: [id, name]
  cb_templates:
    class: cbTemplate
    primary: [id, name]
  cb_defaults:
    class: cbDefault
    primary: id
    
  redirects:
    class: modRedirect
    primary: id
    package: redirector
  clientconfig_groups:
    class: cgGroup
    primary: label
    package: clientconfig
  clientconfig_settings:
    class: cgSetting
    primary: key
  faq_set:
    class: faqManSet
    primary: name
    package: faqman
  faq_item:
    class: faqManItem
    primary: id
  moregallery_image:
    class: mgImage
    primary: [resource, id]
    package: moregallery
    exclude_keys:
      - editedon
      - mgr_thumb_path
      - file_url
      - file_path
      - view_url
  moregallery_image_tag:
    class: mgImageTag
    primary: id
  moregallery_tag:
    class: mgTag
    primary: display
  polls_category:
    class: modPollCategory
    primary: name
    package: polls
  polls_question:
    class: modPollQuestion
    primary: id
  polls_answer:
    class: modPollAnswer
    primary: [question, id]
  scheduler_task:
    class: sTask
    primary: [namespace, reference]
    package: scheduler

  migx_formtab:
    class: migxFormtab
    primary: [id, caption]
    package: migx
  migx_formtab_field:
    class: migxFormtabField
    primary: [id, field]
  migx_config_element:
    class: migxConfigElement
    primary: id
  migx_element:
    class: migxElement
    primary: id
  migx_config:
    class: migxConfig
    primary: [id, name]
````

## Including objects when package uses a service-class 

If an extra uses a service-class instead of a normal class (like Commerce does),
then the name of the service has to be provided at the first config-object with the *service* option.

```` 
    commerce_currency:
        class: comCurrency
        primary: id
        package: commerce
        service: Commerce
    commerce_product:
        class: comProduct
        primary: id
    commerce_product_bundle_product:
        class: comProductBundleProduct
        primary: id
    commerce_order:
        class: comOrder
        exclude_keys:
          - created_on
        primary: id
    commerce_order_item:
        class: comOrderItem
        primary: id
    commerce_order_shipment:
        class: comOrderShipment
        primary: id
    commerce_delivery_type:
        class: comDeliveryType
        primary: id
    commerce_shipping_method:
        class: comShippingMethod
        primary: id
    commerce_status:
        class: comStatus
        primary: id
    commerce_status_change:
        class: comStatusChange
        primary: id
    commerce_status_change_action:
        class: comStatusChangeAction
        primary: id
    commerce_tax_group:
        class: comTaxGroup
        primary: id
    commerce_tax_rule:
        class: comTaxRule
        primary: id
    commerce_tax_rate:
        class: comTaxRate
        primary: id
    commerce_order_item_tax_rate:
        class: comOrderItemTax
        primary: id
    commerce_order_item_adjustment:
        class: comOrderItemAdjustment
        primary: id
    commerce_order_log:
        class: comOrderLog
        primary: id
    commerce_order_address:
        class: comOrderAddress
        primary: id
    commerce_address:
        class: comAddress
        primary: id
    commerce_order_message:
        class: comOrderMessage
        primary: id
        exclude_keys:
          - created_on
    commerce_transaction:
        class: comTransaction
        primary: id
    commerce_payment_method:
        class: comPaymentMethod
        primary: id
    commerce_module:
        class: comModule
        primary: id
    commerce_coupon:
        class: comCoupon
        primary: id
    commerce_coupon_usage:
        class: comCouponUsage
        primary: id
````
