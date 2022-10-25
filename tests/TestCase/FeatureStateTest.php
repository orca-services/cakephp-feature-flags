<?php

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
    public function testIsEnabled()
    {
        $featureState = new FeatureState(true);
        $this->assertTrue($featureState->isEnabled());
        $featureState = new FeatureState(false);
        $this->assertFalse($featureState->isEnabled());
    }

    /**
     * Tests the isDisabled method
     *
     * @return void
     * @covers ::isDisabled
     * @covers ::__construct
     */
    public function testIsDisabled()
    {
        $featureState = new FeatureState(false);
        $this->assertTrue($featureState->isDisabled());
        $featureState = new FeatureState(true);
        $this->assertFalse($featureState->isDisabled());
    }
}
