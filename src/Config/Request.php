<?php namespace Config;

class Request
{
    private $controlador;
    private $metodo;
    private $parametros;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $metodoRequest = $this->getMetodoRequest();

        if ($metodoRequest == 'GET') {

            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);


            /**
             * $url = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_URL);
             */


            /**
             * La función filter_input() obtiene una variable externa y opcionalmente la filtra.
             * Esta función se utiliza para validar las variables de fuentes inseguras, como la entrada de un usuario.
             */


            $urlToArray = explode("/", $url);


            /**
             * Devuelve un array de string, siendo cada uno un substring del segundo parametro pasado formado
             * por la división realizada por los delimitadores indicados en el primer paramtro.
             */


            $ArregloUrl = array_filter($urlToArray);

            /**
             * echo '<pre>';
             * print_r($ArregloUrl);
             * echo '</pre>';
             */

            /**
             * Filtra elementos de un array usando una función de devolución de llamada.
             * Recorre cada valor de array, pasándolos a la función callback.
             * Si la función callback devuelve true, el valor actual desde array es devuelto al array resultante.
             * Las claves del array se conservan.
             */


            if (empty($ArregloUrl)) {
                // Si Arreglo Url esta vacio, cargo el controlador por defecto
                $this->controlador = 'Login';
            } else {
                // Quito el primer elemento del array y lo uso como controlador
                $this->controlador = ucwords(array_shift($ArregloUrl));
            }

            if (empty($ArregloUrl)) {
                // Si Arreglo Url esta vacio, cargo el index por defecto
                $this->metodo = 'index';
            } else {
                // Quito el primer elemento del array y lo uso como metodo
                $this->metodo = array_shift($ArregloUrl);
            }

            if (!empty($ArregloUrl)) {
                $this->parametros = $ArregloUrl;
            }

        } else {

            $this->parametros = $_POST;

        }

    }

    /**
     * Devuelve el método HTTP
     * con el que se hizo el
     * Request
     *
     * @return String
     */
    public static function getMetodoRequest()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Devuelve el controlador
     * con el que se hizo el
     * Request
     *
     * @return String
     */
    public function getControlador()
    {
        return $this->controlador;
    }

    /**
     * Devuelve el método
     * con el que se hizo el
     * Request
     *
     * @return String
     */
    public function getMetodo()
    {
        return $this->metodo;
    }

    /**
     * Devuelve los atributos
     * con el que se hizo el
     * Request
     *
     * @return Array
     */
    public function getParametros()
    {
        return $this->parametros;
    }
}