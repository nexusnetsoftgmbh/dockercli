<?php
declare(strict_types=1);

namespace Nexus\Dumper\Communication\Command;

use DataProvider\DumperConfigDataProvider;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Xervice\Console\Business\Model\Command\AbstractCommand;

/**
 * @method \Nexus\Dumper\Business\DumperFacade getFacade()
 */
class ClearCommand extends AbstractCommand
{
    /**
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure(): void
    {
        $this
            ->setName('dumper:clear')
            ->setDescription('Clear one volume')
            ->addArgument('volume', InputArgument::REQUIRED, 'The volume to dump')
            ->addArgument('path', InputArgument::OPTIONAL, 'The path inside the volume to dump', '/data')
            ->addArgument('version', InputArgument::OPTIONAL, 'The version for naming of your restore', 'master');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null|void
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configDataProvider = new DumperConfigDataProvider();
        $configDataProvider->setVolume($input->getArgument('volume'));
        $configDataProvider->setPath($input->getArgument('path'));
        $configDataProvider->setVersion($input->getArgument('version'));

        $this->getFacade()->clear($configDataProvider);
    }

}