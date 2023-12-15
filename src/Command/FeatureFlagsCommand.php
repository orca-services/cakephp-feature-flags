<?php

namespace FeatureFlags\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Utility\Hash;
use FeatureFlags\FeatureFlagsList;

/**
 * FeatureFlags command
 */
class FeatureFlagsCommand extends Command
{
    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/3.0/en/console-and-shells/commands.html#defining-arguments-and-options
     *
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     * @todo Cover by a test.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|int|void The exit code or null for success
     * @todo Cover by a test.
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $io->out('These are the currently set feature flags:');

        $featureFlagTableHeader = [
            ['Feature flag', 'Value'],
        ];
        $featureFlagTableData = $featureFlagTableHeader;

        $featureFlagList = FeatureFlagsList::asArray();
        $featureFlagList = Hash::flatten($featureFlagList);
        foreach ($featureFlagList as $featureFlag => $featureState) {
            $featureState = $featureState ? 'true' : 'false';
            $featureFlagTableData[] = [$featureFlag, $featureState];
        }

        $io->helper('Table')->output($featureFlagTableData);
    }
}
