# Usage

## Checking a flag

`Feature::name()` returns a `FeatureState` with `isEnabled()` and `isDisabled()`:

```php
use FeatureFlags\Feature;

if (Feature::name('NewCheckout')->isEnabled()) {
    // new flow
}

if (Feature::name('BetaDashboard')->isDisabled()) {
    throw new NotFoundException();
}
```

Nested flags use dot notation:

```php
Feature::name('Reporting.AdvancedExport')->isEnabled();
```

Unknown flags resolve to disabled. No exception is thrown.

## Common patterns

**Controller:**

```php
if (Feature::name('NewCheckout')->isEnabled()) {
    $this->viewBuilder()->setTemplate('view_v2');
}
```

**Template:**

```php
<?php if (Feature::name('BetaDashboard')->isEnabled()): ?>
    <?= $this->element('dashboard/beta') ?>
<?php endif; ?>
```

**Routes:**

```php
if (Feature::name('NewCheckout')->isEnabled()) {
    $routes->connect('/checkout', ['controller' => 'Checkout', 'action' => 'v2']);
}
```

## Listing flags in code

```php
use FeatureFlags\FeatureFlagsList;

$flags = FeatureFlagsList::asArray();
// raw Features array, nesting preserved
```

## Console command

Print all configured flags as a table:

```
bin/cake feature_flags
```

Nested keys are flattened to dot notation; booleans render as `true` / `false`.

## Testing

CakePHP's `TestCase` resets `Configure` between tests, so you can write flags directly:

```php
Configure::write('Features.NewCheckout', true);
$this->assertTrue(Feature::name('NewCheckout')->isEnabled());
```
