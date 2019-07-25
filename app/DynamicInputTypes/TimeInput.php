<?php


namespace App\DynamicInputTypes;


class TimeInput extends InputType
{
    function __construct() {
        $this->name = "Time field";
        $this->input_type = "time";
        $this->attributes = [
            "name" => "The name of the field",
            "value" => "Default value for the field",
            "placeholder" => "Display help text in the field if no value",
            "min" => "The minimal time allowed formatted as hh:mm:ss (for example 08:00 if not allowed before 8am",
            "max" => "The maximal time allowed formatted as hh:mm:ss (for example 17:00 if not allowed after 5pm",
            "step" => "The time increment in seconds (for example 60 for one minute or 1800 for 30 minutes ",

        ];
    }
}