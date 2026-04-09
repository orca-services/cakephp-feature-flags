# Configuration

The plugin has no settings of its own. It reads every flag from the `Features` key in CakePHP's `Configure`.

The key name is hardcoded (`FeatureFlags::CONFIG_KEY`) and cannot currently be changed.

```php
'Features' => [...]
```

You have two options for organizing the feature flags.

1. **Flattened**:

    ```php
    'Features' => [
        'NewCheckout'   => true,
        'BetaDashboard' => false,
    ],
    ```

    ```php
    Feature::name('NewCheckout')->isEnabled();
    ```

2. **Nested** (any depth, referenced with dot notation):

    ```php
    'Features' => [
        'Reporting' => [
            'AdvancedExport' => true,
            'PdfDownload'    => false,
        ],
    ],
    ```

    ```php
    Feature::name('Reporting.AdvancedExport')->isEnabled();
    ```

## Loading configuration

Any method of populating `Configure` works. Common choices:

- **Dedicated file:**

    ```php
    // config/features.php
    return [
        'Features' => [
            'NewCheckout' => true,
        ],
    ];
    ```

    ```php
    // config/bootstrap.php
    Configure::load('features');
    ```

- **Inline:**

    Add a `Features` section directly in `app.php` / `app_local.php`. `app_local.php` overrides `app.php`, which is useful for environment-specific state.


- **At runtime:**

    ```php
    Configure::write('Features.NewCheckout', true);
    ```

   Runtime writes take effect immediately but don't persist across requests.

## Per-environment setup

Two working patterns:

1. Load a base `features.php` plus an environment-specific file (e.g. `features_production.php`) that overrides only what differs.
2. Put overrides in `app_local.php` (typically gitignored) to keep production state out of the repo.
