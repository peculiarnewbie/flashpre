<?php

use Phalcon\Mvc\Model;

class Decks extends Model
{
    public $id;
    public $name;
    public $size;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}