<?php

namespace app\helper;

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
    public function add_email_validation($field_name)
    {
        $email = $_POST[$field_name];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->field_errors[$field_name][$field_name] =  $field_name . ' not valid format';
        }
    }

    public function output_error($field_name)
    {

        //  var_dump($this->field_errors[$field_name]);
        if (isset($this->field_errors[$field_name])) {
            foreach ($this->field_errors[$field_name] as $key => $error) {
                return $error;
            }
        }
    }

    public function pass()
    {
        return $this->passed;
    }


    public function register_validation($data)
    {

        foreach ($data as $key => $value) {
            if ($key == 'firstname') {
                $this->add_error_field($key);
            }
            if ($key == 'lastname') {
                $this->add_error_field($key);
            }
            if ($key == 'email') {

                if (!$this->add_email_validation($key)) {

                    $this->add_email_validation($key);
                }
                $this->add_error_field($key);
            }
            if ($key == 'username') {
                $this->add_error_field($key);
            }
            if ($key == 'password') {
                $this->add_error_field($key);
            }
            if ($key == 'roleid') {
                $this->add_error_field($key);
            }
            if ($key == 'token') {
                $this->add_error_field($key);
            }
        }
    }
    public function apply_job_validation($data)
    {

        foreach ($data as $key => $value) {
            if ($key == 'firstname') {
                $this->add_error_field($key);
            }
            if ($key == 'lastname') {
                $this->add_error_field($key);
            }
        }
    }
}
