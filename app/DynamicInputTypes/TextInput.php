<?php

namespace App\DynamicInputTypes;


class TextInput extends InputType
{
    function __construct() {
        $this->name = "Text field";
        $this->input_type = "text";
        $this->attributes = [
            "name" => "The name of the field",
            "value" => "Default value for the field",
            "placeholder" => "Display help text in the field if no value"
        ];
    }



}