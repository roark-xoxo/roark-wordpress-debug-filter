# ROARK WordPress Debug Filter

**Author:** [ROARK](https://roark.at)\
**License:** MIT

## Overview

The **ROARK Debug Filter** is a Must-Use (MU) plugin designed to suppress specific `_doing_it_wrong` notices introduced in WordPress 6.7. These notices pertain to the `_load_textdomain_just_in_time` function, which is triggered when translation files are loaded too early in the WordPress execution cycle.

After updating to WordPress 6.7, many developers and site administrators have encountered the following notice:

> **Notice:** Function `_load_textdomain_just_in_time` was called incorrectly. Translation loading for the `<plugin>` domain was triggered too early. This is usually an indicator for some code in the plugin or theme running too early. Translations should be loaded at the `init` action or later. Please see [Debugging in WordPress](https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/) for more information. (This message was added in version 6.7.0.)

This plugin addresses the issue by filtering out these specific notices, ensuring that your debug logs remain clean and focused on actionable items.

## Why This Plugin Is Necessary

WordPress 6.7 introduced stricter checks to ensure that translation files are loaded at the appropriate time during the execution cycle. Loading translations too early can lead to unexpected behavior, especially in multilingual setups.

However, many plugins and themes have not yet adapted to this change, resulting in frequent notices that can clutter debug logs and obscure more critical issues. Until these plugins and themes are updated to comply with the new standards, the **ROARK Debug Filter** provides a temporary solution to suppress these specific notices.

## How It Works

The plugin utilizes the `doing_it_wrong_trigger_error` filter introduced in WordPress 6.7. By hooking into this filter, it checks if the function triggering the notice is `_load_textdomain_just_in_time`. If so, it returns `false`, effectively suppressing the notice.

Here's the core functionality:

```php
add_filter(
  'doing_it_wrong_trigger_error',
  'roark_filter_doing_it_wrong_notices',
  10,
  2
);

function roark_filter_doing_it_wrong_notices($trigger, $function_name)
{
  if ('_load_textdomain_just_in_time' === $function_name) {
    return false;
  }
  return $trigger;
}
```

## Installation

1. **Locate the MU-Plugins Directory:**
   Navigate to the `wp-content/mu-plugins` directory in your WordPress installation. If the `mu-plugins` directory doesn't exist, create it.

2. **Add the Plugin File:**
   Create a new PHP file named `roark-debug-filter.php` within the `mu-plugins` directory.

3. **Insert the Plugin Code:**
   Copy and paste the plugin code into the `roark-debug-filter.php` file.

4. **Save and Verify:**
   Save the file. Since MU-Plugins are automatically activated by WordPress, there's no need to activate it manually.

## Important Notes

- **Temporary Solution:** This plugin is intended as a temporary workaround. It's recommended to monitor updates from plugin and theme developers and remove this filter once they've addressed the issue.

- **Production Environments:** While this plugin suppresses specific notices, it's also advisable to configure your `wp-config.php` file appropriately for production environments:

  ```php
  define('WP_DEBUG', false);
  define('WP_DEBUG_DISPLAY', false);
  define('WP_DEBUG_LOG', false);
  ```

- **Stay Updated:** Keep an eye on updates from the WordPress core and your installed plugins/themes to ensure compatibility and optimal performance.

## Support and More Information

For further assistance, updates, or to learn more about our offerings, please visit [ROARK](https://roark.at).
