<?php

class Form {

    public static $class = 'form-control';

    public static function make_input (string $type, string $name, string $value = null, array $array = []) : string 
    {
        $checked = '';
        if (isset($array[$name]) && in_array($value, $array[$name])) {
            $checked .= 'checked';
        }
        $checked = " class='" . self::$class . '"'; 
        return <<<HTML
        <input type="$type" name="{$name}[]" value="$value" $checked>
HTML;
    }
    public static function select (string $name, $value, array $options) : string
    {
        $html_options = [];
        foreach ($options as $k => $option) {
            $attributes = $k == $value ? ' selected' : '';
            $html_options[] = "<option value='$k' $attributes>$option</option>";
        }
        $class = self::$class;
        return "<select class='$class' name ='$name'>" . implode($html_options) . '</select>';
    }
}