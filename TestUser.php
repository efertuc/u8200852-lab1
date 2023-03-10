<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'User.php';
require_once 'Comment.php';

use Symfony\Component\Validator\Validation;

function validUser(User $user)
{
    $validator = Validation::createValidatorBuilder()
        ->addMethodMapping('loadValidatorMetadata')
        ->getValidator();
    $violations = $validator->validate($user);
    if (count($violations) > 0) {
        echo '<br>' . "Invalid user  " . $user . '<br>';
        foreach ($violations as $violation) {
            echo $violation->getMessage() . '<br>';
        }
    } else {
        echo '<br>' . "Valid user" . $user . '<br>';
    }
}

$user1 = new User(1, "Efertuc", "eferuc@mail.ru", "efertuc");
$user2 = new User(-1, "Efertuc", "eferuc@mail.ru", "");
$user3 = new User(1, "Efertuc", "eferuc", "efertuc");
$user4 = new User(10, "Efertuc", "eferuc@mail.ru", "efertuc");

validUser($user1); //Valid user
validUser($user2); // Invalid user 
validUser($user3); //Invalid user 
validUser($user4); //Valid user

$comment1 = new Comment($user1, "Hello");
$comment2 = new Comment($user2, "from");
$comment3 = new Comment($user2, "PHP");
$comments = [$comment1, $comment2, $comment3];

$time = new DateTime('10.03.2022 00:34:24');
foreach ($comments as $comment) {
    if ($comment->user->getCreatedDate() > $time) {
        echo $comment->message . '<br>';
    }
}
