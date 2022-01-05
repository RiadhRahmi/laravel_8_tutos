<?php

// low level class
class Mailer
{
}

// high level class
class SendWelcomeMessage
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
}
