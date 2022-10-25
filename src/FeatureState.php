<?php
declare(strict_types=1);

namespace FeatureFlags;

/**
 * Feature Flag State
 *
 * @todo Consider adding isEnabledOrFail() which throws a to be defined plugin specific exception.
 * @todo Consider adding isNotEnabled(), which is just the inverted of isEnabled() or the same as isDisabled().
 * @todo Consider adding isNotDisabled(), which is just the inverted of isDisabled() or the same as isEnabled().
 */
class FeatureState
{
    /** @var bool The state of the feature */
    protected $state = false;

    /**
     * FeatureState constructor.
     *
     * @param bool $state The current state to set.
     */
    public function __construct($state)
    {
        $this->state = $state;
    }

    /**
     * Get whether the feature is enabled
     *
     * @return bool True if enabled, else false.
     */
    public function isEnabled(): bool
    {
        return $this->state === true;
    }

    /**
     * Get whether the feature is disabled
     *
     * @return bool True if disabled, else false.
     */
    public function isDisabled(): bool
    {
        return $this->state === false;
    }
}
