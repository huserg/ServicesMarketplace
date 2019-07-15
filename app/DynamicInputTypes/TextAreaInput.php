<?php


namespace App\DynamicInputTypes;


class TextAreaInput extends InputType
{
    function __construct() {
        $this->name = "Text Area";
        $this->attributes = [
            "name" => "",
            "value" => "",
            "placeholder" => "",
            "rows" => "",
            "cols" => ""

        ];
    }

}