<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'User.php';

class Comment
{
    public string $message;
    public User $user;

    public function __construct(User $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function __toString()
    {
        return $this->user . " Message : " . $this->message;
    }
}
