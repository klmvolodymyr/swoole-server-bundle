<?php
declare(strict_types=1);

namespace VolodymyrKlymniuk\SwooleServerBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StopCommand extends ServerCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('swoole:server:stop')
            ->setDescription('Stop Swoole HTTP Server.');
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
            if ($this->server->isRunning()) {
                $this->server->stop();
                $style->success('Swoole server stopped!');;
            } else {
                $style->warning('Server not running! Please before start the server.');
            }

        } catch (\Exception $exception) {
            $style->error($exception->getMessage());
        }
    }
}
