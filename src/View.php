<?php
/**
 * Created by PhpStorm.
 * User: dechadou-pc
 * Date: 20/6/2018
 * Time: 2:24 PM
 */

namespace Src;

class View
{
    /**
     * @var
     */
    protected static $data;

    /**
     * @var
     */
    const VIEWS_PATH = "../App/Views/";

    /**
     * @var
     */
    const EXTENSION_TEMPLATES = "php";


    /**
     * @param $template
     * @throws \Exception
     */
    public static function render($template)
    {
        self::checkIfFileExists($template);

        ob_start();
        extract(self::$data);
        include(self::VIEWS_PATH . $template . "." . self::EXTENSION_TEMPLATES);
        $str = ob_get_contents();
        ob_end_clean();
        echo $str;
    }

    /**
     * @param $template
     * @throws \Exception
     */
    public static function checkIfFileExists($template)
    {
        if(!file_exists(self::VIEWS_PATH . $template . "." . self::EXTENSION_TEMPLATES))
        {
            throw new \Exception("Error: The File " . self::VIEWS_PATH . $template . "." . self::EXTENSION_TEMPLATES . " does not exist", 1);
        }
    }


    /**
     * @param $name
     * @param $value
     */
    public static function set($name, $value)
    {
        self::$data[$name] = $value;
    }
}
