<?php
declare(strict_types=1);

namespace FeatureFlags\Test\TestCase;

use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use FeatureFlags\Feature;

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
    public function testName(): void
    {
        // Test unset feature flag
        $featureState = Feature::name('Foo');
        static::assertFalse($featureState->isEnabled());

        // Test enabled feature flag
        Configure::write('Features.Foo', true);
        $featureState = Feature::name('Foo');
        static::assertTrue($featureState->isEnabled());

        // Test enabled feature flag
        Configure::write('Features.Foo', false);
        $featureState = Feature::name('Foo');
        static::assertFalse($featureState->isEnabled());
    }
}
