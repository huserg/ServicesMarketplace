<?php

namespace App\DynamicInputTypes;


class TextInput extends InputType
{
    function __construct() {
        $this->name = "Text field";
        $this->attributes = [
            "name" => "",
            "value" => "",
            "placeholder" => ""
        ];
    }



}