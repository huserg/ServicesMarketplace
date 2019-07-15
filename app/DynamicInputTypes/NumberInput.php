<?php


namespace App\DynamicInputTypes;


class NumberInput extends InputType
{
    function __construct() {
        $this->name = "Number field";
        $this->attributes = [
            "name" => "",
            "value" => "",
            "placeholder" => "",
            "min" => "",
            "max" => "",
            "step" => "",
        ];
    }



}