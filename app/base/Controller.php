<?php

namespace app\base;

class Controller
{
    public function render($file, $data = [])
    {
        ob_start();
        extract($data);
        require_once '../' . $file . '.php';
        return  ob_get_contents();
        //ob_end_clean();
    }

    public function sanitize_value($str)
    {
        foreach ($str as $key =>   $value) {
            $values =  htmlspecialchars($value, ENT_QUOTES, "UTF-8");
            return  $values;
        }
    }
    public function sanitize_single_value($str)
    {
        $values =  htmlspecialchars($str, ENT_QUOTES, "UTF-8");
        return  $values;
    }
}
