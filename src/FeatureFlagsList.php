<?php

namespace FeatureFlags;

use Cake\Core\Configure;

/**
 * Feature Flags List
 */
class FeatureFlagsList
{
    /**
     * Get a list of all feature flags with their value as array
     *
     * @return array A list of all feature flags with their value as array.
     * @todo Cover by a test
     * @todo Make configuration key configurable, e.g. through static method and/or config key (+ centralize).
     */
    public static function asArray()
    {
        $featureFlags = Configure::read(FeatureFlags::CONFIG_KEY, []);

        return $featureFlags;
    }
}
