<?php


namespace Nexus\Dumper\Communication\Command;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Xervice\Console\Command\AbstractCommand;

/**
 * @method \Nexus\Dumper\DumperFacade getFacade()
 */
class DumpSshCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('dumper:dump:ssh')
            ->setDescription('Dump one volume to ssh')
            ->addArgument('volume', InputArgument::REQUIRED, 'The volume to dump')
            ->addArgument('path', InputArgument::REQUIRED, 'The path inside the volume to dump')
            ->addArgument('version', InputArgument::REQUIRED, 'The version for naming of your dump')
            ->addArgument('datapath', InputArgument::OPTIONAL, 'The Datapath for naming of your dump', '/data');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null|void
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getFacade()->dumpToSsh(
            $input->getArgument('volume'),
            $input->getArgument('path'),
            $input->getArgument('version'),
            $input->getArgument('datapath')
        );
    }

}