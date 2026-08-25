<?php
declare(strict_types=1);

namespace FeatureFlags\Test\TestCase;

use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use FeatureFlags\FeatureFlags;
use FeatureFlags\FeatureFlagsList;

/**
 * FeatureFlagsList Tests
 *
 * @coversDefaultClass \FeatureFlags\FeatureFlagsList
 */
class FeatureFlagsListTest extends TestCase
{
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        Configure::delete(FeatureFlags::CONFIG_KEY);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        Configure::delete(FeatureFlags::CONFIG_KEY);
        parent::tearDown();
    }

    /**
     * Tests asArray returns an empty array when nothing is configured.
     *
     * @return void
     * @covers ::asArray
     */
    public function testAsArrayReturnsEmptyArrayByDefault(): void
    {
        static::assertSame([], FeatureFlagsList::asArray());
    }

    /**
     * Tests asArray returns the configured feature flags.
     *
     * @return void
     * @covers ::asArray
     */
    public function testAsArrayReturnsConfiguredFlags(): void
    {
        $flags = [
            'Foo' => true,
            'Bar' => false,
        ];
        Configure::write(FeatureFlags::CONFIG_KEY, $flags);

        static::assertSame($flags, FeatureFlagsList::asArray());
    }
}
