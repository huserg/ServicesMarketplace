<?php


namespace App\DynamicInputTypes;


class TextAreaInput extends InputType
{
    function __construct() {
        $this->name = "Text Area";
        $this->input_type = "textarea";
        $this->attributes = [
            "name" => "The name of the field",
            "value" => "Default value for the field",
            "placeholder" => "Display help text in the field if no value",
            "rows" => "Number of lines of the field before the scrollbar appears"
        ];
    }

}