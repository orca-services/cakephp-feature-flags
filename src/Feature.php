<?php
declare(strict_types=1);

namespace FeatureFlags;

use Cake\Core\Configure;

/**
 * Feature Flag
 */
class Feature
{
    /**
     * Fetch the feature by name
     *
     * @param string $featureName Name of the feature.
     * @return FeatureState The feature state for the given feature name.
     */
    public static function name(string $featureName): FeatureState
    {
        return new FeatureState(self::getFeatureState($featureName));
    }

    /**
     * Get the feature state
     *
     * @param string $featureName The name of the feature.
     * @return bool True if enabled, else false.
     * @suppressWarnings(PHPMD.BooleanGetMethodName)
     * @todo Make configuration key configurable, e.g. through static method and/or config key (+ centralize).
     */
    protected static function getFeatureState(string $featureName): bool
    {
        return (bool)Configure::read(FeatureFlags::CONFIG_KEY . '.' . $featureName);
    }
}
