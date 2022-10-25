<?php

namespace FeatureFlags\Test\TestCase;

use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use FeatureFlags\Feature;
use FeatureFlags\FeatureState;

/**
 * Feature Tests
 *
 * @coversDefaultClass \FeatureFlags\Feature
 */
class FeatureTest extends TestCase
{
    /**
     * Tests the name method
     *
     * @return void
     * @covers ::name
     * @covers ::getFeatureState
     */
    public function testName()
    {
        // Test unset feature flag
        $featureState = Feature::name('Foo');
        $this->assertInstanceOf(FeatureState::class, $featureState);
        $this->assertFalse($featureState->isEnabled());

        // Test enabled feature flag
        Configure::write('App.features.Foo', true);
        $featureState = Feature::name('Foo');
        $this->assertTrue($featureState->isEnabled());

        // Test enabled feature flag
        Configure::write('App.features.Foo', false);
        $featureState = Feature::name('Foo');
        $this->assertFalse($featureState->isEnabled());
    }
}
