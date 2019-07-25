<?php


namespace App\DynamicInputTypes;


class NumberInput extends InputType
{
    function __construct() {
        $this->name = "Number field";
        $this->input_type = "number";
        $this->attributes = [
            "name" => "The name of the field",
            "value" => "Default value for the field",
            "placeholder" => "Display help text in the field if no value",
            "min" => "The minimum number possible",
            "max" => "The maximum number possible",
            "step" => "The increment of the number (for example 0.5 or 10)",
        ];
    }



}