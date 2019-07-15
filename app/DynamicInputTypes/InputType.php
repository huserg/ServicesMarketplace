<?php


namespace App\DynamicInputTypes;


class InputType
{
    public $name;

    protected $attributes = [];


    public function getAttributes(){
        return $this->attributes;
    }

}