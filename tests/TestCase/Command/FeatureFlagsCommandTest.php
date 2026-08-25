<?php
declare(strict_types=1);

namespace FeatureFlags\Test\TestCase\Command;

use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Console\TestSuite\StubConsoleOutput;
use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use FeatureFlags\Command\FeatureFlagsCommand;
use FeatureFlags\FeatureFlags;

/**
 * FeatureFlags\Command\FeatureFlagsCommand Test Case
 *
 * @coversDefaultClass \FeatureFlags\Command\FeatureFlagsCommand
 */
class FeatureFlagsCommandTest extends TestCase
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
     * Test buildOptionParser method
     *
     * @return void
     * @covers ::buildOptionParser
     */
    public function testBuildOptionParser(): void
    {
        $command = new FeatureFlagsCommand();
        $parser = $command->buildOptionParser(new ConsoleOptionParser());

        static::assertInstanceOf(ConsoleOptionParser::class, $parser);
    }

    /**
     * Test execute method
     *
     * @return void
     * @covers ::execute
     */
    public function testExecute(): void
    {
        Configure::write(FeatureFlags::CONFIG_KEY, [
            'Foo' => true,
            'Bar' => false,
        ]);

        $output = new StubConsoleOutput();
        $io = new ConsoleIo($output);
        $args = new Arguments([], [], []);

        $command = new FeatureFlagsCommand();
        $result = $command->execute($args, $io);

        // Method has no explicit return, so a successful run returns null.
        static::assertSame(FeatureFlagsCommand::CODE_SUCCESS, $result);

        $text = implode("\n", $output->messages());
        static::assertStringContainsString('These are the currently set feature flags:', $text);
        static::assertStringContainsString('Feature flag', $text);
        static::assertStringContainsString('Value', $text);
        static::assertStringContainsString('Foo', $text);
        static::assertStringContainsString('true', $text);
        static::assertStringContainsString('Bar', $text);
        static::assertStringContainsString('false', $text);
    }

    /**
     * Test execute method flattens nested feature flags into dotted keys.
     *
     * @return void
     * @covers ::execute
     */
    public function testExecuteFlattensNestedFlags(): void
    {
        Configure::write(FeatureFlags::CONFIG_KEY, [
            'Group' => ['Nested' => true],
        ]);

        $output = new StubConsoleOutput();
        $io = new ConsoleIo($output);
        $args = new Arguments([], [], []);

        (new FeatureFlagsCommand())->execute($args, $io);

        $text = implode("\n", $output->messages());
        static::assertStringContainsString('Group.Nested', $text);
        static::assertStringContainsString('true', $text);
    }

    /**
     * Test execute method with no feature flags set.
     *
     * @return void
     * @covers ::execute
     */
    public function testExecuteWithNoFlags(): void
    {
        $output = new StubConsoleOutput();
        $io = new ConsoleIo($output);
        $args = new Arguments([], [], []);

        $result = (new FeatureFlagsCommand())->execute($args, $io);

        static::assertSame(FeatureFlagsCommand::CODE_SUCCESS, $result);
        $text = implode("\n", $output->messages());
        static::assertStringContainsString('These are the currently set feature flags:', $text);
    }
}
