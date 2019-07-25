<?php


namespace App\DynamicInputTypes;


class InputType
{
    public $name;

    public $input_type;

    protected $attributes = [];

    public function getAttributes(){
        return $this->attributes;
    }

    public function clearDefaultAttributes() {
        $this->attributes = [];
    }

    public function setAttribute($name, $value) {
        $this->attributes[$name] = $value;
    }

}