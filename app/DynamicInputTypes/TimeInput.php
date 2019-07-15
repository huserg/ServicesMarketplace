<?php


namespace App\DynamicInputTypes;


class TimeInput extends InputType
{
    function __construct() {
        $this->name = "Time field";
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