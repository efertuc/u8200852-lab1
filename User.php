<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class User
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    private $createDate;

    public function getCreatedDate() {
        return $this->createDate;
    }
    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createDate = strtotime(date('d.m.Y H.i.s'));

    }
    public function __toString()
    {
        return " Id : " . $this->id . " Name : " . $this->name .
            " Email : " . $this->email . " Password : " . $this->password;
    }
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint(
            'id',
            new Assert\NotBlank(
                array(
                    'message' => 'Enter the ID'
                )
            )
        );
        $metadata->addPropertyConstraint(
            'id',
            new Assert\Positive(
                array(
                    'message' => 'ID should be > 0'
                )
            )
        );
        $metadata->addPropertyConstraint(
            'name',
            new Assert\Length(
                array(
                    'min' => 3,
                    'max' => 20,
                    'minMessage' => 'Name length should be > 3 ',
                    'maxMessage' => 'Name length should be < 20',
                )
            )
        );
        $metadata->addPropertyConstraint(
            'email',
            new Assert\Email(
                array(
                    'message' => 'The email "{{ value }}" is not a valid email.',
                )
            )
        );
        $metadata->addPropertyConstraint(
            'password',
            new Assert\NotBlank(
                array(
                    'message' => 'Enter the Password',
                )
            )
        );
        $metadata->addPropertyConstraint(
            'password',
            new Assert\Length(
                array(
                    'min' => 5,
                    'max' => 20,
                    'minMessage' => 'Password length should be > 5',
                    'maxMessage' => 'Password length should be < 20',
                )
            )
        );
    }

    // public function getDateOfCreateString(): string
    // {
    //     return $this->date_of_create->format('Y-m-d H:i:s');
    // }
}
