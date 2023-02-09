<?php
declare(strict_types=1);

namespace VolodymyrKlymniuk\SwooleServerBundle\EventSubscriber;

use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class DoctrineCleaner implements EventSubscriberInterface
{
    /**
     * @var ManagerRegistry;
     */
    private $registry;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::FINISH_REQUEST => [
                ['clear', 10],
            ],
        ];
    }

    /**
     * @param FinishRequestEvent $event
     */
    public function clear(FinishRequestEvent $event)
    {
        $this->registry->getManager()->clear();
    }
}