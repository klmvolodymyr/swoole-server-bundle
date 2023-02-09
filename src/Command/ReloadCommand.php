<?php
declare(strict_types=1);

namespace VolodymyrKlymniuk\SwooleServerBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ReloadCommand extends ServerCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('swoole:server:reload')
            ->setDescription('Reload Swoole HTTP Server.');
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
                $this->server->reload();
                $style->success('Swoole server reloaded!');
            } else {
                $style->warning('Server not running! Please before start the server.');
            }
        } catch (\Exception $exception) {
            $style->error($exception->getMessage());
        }
    }
}