<?php


namespace App\MessageHandler;


use App\Message\Execute;
use App\Message\Notification;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class ExecuteHandler implements MessageHandlerInterface
{

    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(Execute $message)
    {

        sleep(5);

        file_put_contents("Execute.log", $message->getContent() . PHP_EOL, FILE_APPEND);

        if ($notification = $message->getNotification()) {
            $this->bus->dispatch($notification);
        }
    }
}