<?php
declare(strict_types=1);

namespace FeatureFlags\Test\TestCase;

use Cake\TestSuite\TestCase;
use FeatureFlags\FeatureState;

/**
 * FeatureState Tests
 *
 * @coversDefaultClass \FeatureFlags\FeatureState
 */
class FeatureStateTest extends TestCase
{
    /**
     * Tests the isEnabled method
     *
     * @return void
     * @covers ::isEnabled
     * @covers ::__construct
     */
    public function testIsEnabled(): void
    {
        $featureState = new FeatureState(true);
        static::assertTrue($featureState->isEnabled());

        $featureState = new FeatureState(false);
        static::assertFalse($featureState->isEnabled());
    }

    /**
     * Tests the isDisabled method
     *
     * @return void
     * @covers ::isDisabled
     * @covers ::__construct
     */
    public function testIsDisabled(): void
    {
        $featureState = new FeatureState(false);
        static::assertTrue($featureState->isDisabled());

        $featureState = new FeatureState(true);
        static::assertFalse($featureState->isDisabled());
    }
}
