<?php


namespace App\DynamicInputTypes;


class DateInput extends InputType
{
    function __construct() {
        $this->name = "Date field";
        $this->attributes = [
            "name" => "",
            "value" => "",
            "placeholder" => "",
            "min" => "",
            "max" => ""

        ];
    }

}