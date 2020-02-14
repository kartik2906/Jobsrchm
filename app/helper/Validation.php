<?php

namespace helper;

class Validation
{
    public $passed = false;
    public $field_errors = array();




    public function add_error_field($field_name)
    {


        if (!$_POST[$field_name]) {
            $this->field_errors[$field_name][$field_name] =  $field_name . 'cannot be empty';
            $this->passed = true;
        }
    }

    public function output_error($field_name)
    {


        if (isset($this->field_errors[$field_name])) {
            foreach ($this->field_errors[$field_name] as $key => $error) {

                echo $error;
            }
        }
    }

    public function pass()
    {
        return $this->passed;
    }
}
