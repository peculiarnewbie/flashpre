<?php

use Phalcon\Mvc\Model;

class Cards extends Model
{
    public $id;
    public $deck_id;
    public $front;
    public $back;
    public $weight;
    public $time;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setFront($front)
    {
        $this->front = $front;

        return $this;
    }
}