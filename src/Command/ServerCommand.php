<?php
declare(strict_types=1);

namespace VolodymyrKlymniuk\SwooleServerBundle\Command;

//use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use VolodymyrKlymniuk\SwooleServerBundle\Swoole\Server;

class ServerCommand extends Command
{
    /**
     * @var Server
     */
    protected $server;

    /**
     * @param Server      $server
     * @param string|null $name
     */
    public function __construct(Server $server, string $name = null)
    {
        $this->server = $server;
        parent::__construct($name);
    }
}
