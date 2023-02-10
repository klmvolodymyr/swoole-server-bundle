<?php
declare(strict_types=1);

namespace VolodymyrKlymniuk\SwooleServerBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StartCommand extends ServerCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('swoole:server:start')
            ->setDescription('Start Swoole HTTP Server.')
            ->addOption('host', null, InputOption::VALUE_OPTIONAL, 'If your want to override the default configuration host, use these method.')
            ->addOption('port', null, InputOption::VALUE_OPTIONAL, 'If your want to override the default configuration port, use these method.');
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
                $style->warning('Server is running! Please before stop the server.');
            } else {
                $host = $input->getOption('host');
                if ($host) {
                    $this->server->setHost($host);
                }

                $port = $input->getOption('port');
                if ($port) {
                    $this->server->setPort($port);
                }

                $this->server->start(function (string $message) use ($style) {
                    $style->success($message);
                });
            }
        } catch (\Exception $exception) {
            $style->error($exception->getMessage());
        }
    }
}