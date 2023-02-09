<?php
declare(strict_types=1);

namespace VolodymyrKlymniuk\SwooleServerBundle\Command;

class ServerCommand extends ContainerAwareCommand
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
