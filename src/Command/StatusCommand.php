<?php
declare(strict_types=1);

namespace VolodymyrKlymniuk\SwooleServerBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StatusCommand extends ServerCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('swoole:server:status')
            ->setDescription('Status Swoole HTTP Server.');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        try {
            $style->table(
                ['Host', 'Port', 'Status'],
                [[$this->server->getHost(), $this->server->getPort(), $this->server->isRunning() ? 'Running' : 'Stopped']]
            );
        } catch (\Exception $exception) {
            $style->error($exception->getMessage());
        }
    }
}
