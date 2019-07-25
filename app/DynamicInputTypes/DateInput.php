<?php


namespace App\DynamicInputTypes;


class DateInput extends InputType
{
    function __construct() {
        $this->name = "Date field";
        $this->input_type = "date";
        $this->attributes = [
            "name" => "The name of the field",
            "value" => "Default value for the field",
            "placeholder" => "Display help text in the field if no value",
            "min" => "The minimal date valid formatted as yyyy-MM-dd",
            "max" => "The maximal date valid formatted as yyyy-MM-dd"

        ];
    }

}