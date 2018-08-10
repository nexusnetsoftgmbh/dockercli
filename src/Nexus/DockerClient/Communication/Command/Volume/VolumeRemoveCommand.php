<?php


namespace Nexus\DockerClient\Communication\Command\Volume;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Xervice\Console\Command\AbstractCommand;

/**
 * @method \Nexus\DockerClient\DockerClientFacade getFacade()
 */
class VolumeRemoveCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('docker:volume:rm')
            ->setDescription('Remove a docker volume')
            ->addArgument('names', InputArgument::IS_ARRAY, 'Volume names seperated by space')
        ;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null|void
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $names = $input->getArgument('names');
        $response = '';

        foreach ($names as $name) {
            $command = sprintf(
                'volume rm %s',
                $name
            );

            $response .= $this->getFacade()->runDocker($command);
        }

        if ($output->isVerbose()) {
            $output->writeln($response);
        }
    }
}