<?php
/**
 * Created by PhpStorm.
 * User: dechadou-pc
 * Date: 20/6/2018
 * Time: 3:50 PM
 */

namespace Src;


class App
{
    /**
     * @var
     */
    private $_controller;

    /**
     * @var string
     */
    private $_method = "index";

    /**
     * @var array
     */
    private $_params = [];

    /**
     * @var array
     */
    public $config = [];

    /**
     * @var
     */
    const NAMESPACES = "\App\Controllers\\";

    /**
     * @var
     */
    const CONTROLLERS = "../App/Controllers/";

    public function getErrorPage()
    {
        return APP . "/Views/errors/404.php";
    }


    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $url = $this->parseUrl();
        $url = $this->checkIfFileExists($url);
        $fullClass = self::NAMESPACES . $this->getController();
        $this->setController(new $fullClass);
        $url = $this->checkIfMethodExists($url);
        $this->setParams( $url ? array_values($url) : []);
    }

    /**
     * @param $url
     * @throws \Exception
     */
    public function checkIfMethodExists($url)
    {
        if (isset($url[1])) {

            //Get the method
            $this->_method = $url[1];
            if (method_exists($this->getController(), $url[1])) {
                //Delete the method from the url so we keep only the parameters
                unset($url[1]);
                return $url;
            } else {
                #throw new \Exception("Error Processing Method {$this->_method}, Method exists?", 1); //this could be environment managed.
                include $this->getErrorPage();
                exit;
            }
        }
    }

    /**
     * @param $url
     */
    public function checkIfFileExists($url)
    {
        if (file_exists(self::CONTROLLERS . ucfirst($url[0]) . ".php")) {
            $this->setController(ucfirst($url[0]));

            unset($url[0]);
            return $url;
        } else {
            /** @var TYPE_NAME $this */
            include $this->getErrorPage();
            exit;
        }
    }


    /**
     * @return array
     */
    public function parseUrl()
    {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(rtrim($_GET["url"], "/"), FILTER_SANITIZE_URL));
        }

        return explode("/", filter_var(rtrim("home", "/"), FILTER_SANITIZE_URL));
    }

    /**
     *
     */
    public function render()
    {
        call_user_func_array([$this->getController(), $this->_method], $this->getParams());
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * @param $controller
     * @return $this
     */
    public function setController($controller)
    {
        $this->_controller = $controller;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->_method;
    }


    /**
     * @return array
     */
    public function getParams()
    {
        return $this->_params;
    }

    /**
     * @param $params
     * @return $this
     */
    public function setParams($params)
    {
        $this->_params = $params;
        return $this;
    }


}
