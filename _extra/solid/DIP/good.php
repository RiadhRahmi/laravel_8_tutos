<?php

// low level class
interface Mailer
{
    public function send();
}

// abstraction class
class SmtpMailer implements Mailer
{
    public function send()
    {
    }
}

// abstraction class 
class SendGridMailer implements Mailer
{
    public function send()
    {
    }
}

// high level class
class SendWelcomeMessage
{
    private $mailer;

    public function __construct(SmtpMailer $mailer)
    {
        $this->mailer = $mailer;
    }
}
