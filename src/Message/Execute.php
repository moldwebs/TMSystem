<?php


namespace App\Message;


class Execute
{
    private $content;
    private $notification;

    public function __construct(string $content, Notification $notification = null)
    {
        $this->content = $content;
        $this->notification = $notification;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getNotification(): Notification
    {
        return $this->notification;
    }


}