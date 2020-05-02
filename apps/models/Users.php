<?php

use Phalcon\Mvc\Model;
//use Phalcon\Mvc\Model\MessageInterface as Message;
use Phalcon\Messages\Message as Message;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\InclusionIn;

class Users extends Model
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    public function beforeSave()
    {
        if ($this->name === "arif") {
            $message = new Message(
                "Sorry, Arif is my name, so no."
            );

            $this->appendMessage($message);

            return false;
        }
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new Uniqueness(
                [
                    'message' => 'that email has already been used',
                ]
            )
        );

        return $this->validate($validator);
    }

    public $email;

    
}