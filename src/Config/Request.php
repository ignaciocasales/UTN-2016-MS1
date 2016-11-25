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

        $url = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);

        /**
         * Apache:
         * $url = filter_input(INPUT_GET, 'REQUEST_METHOD', FILTER_SANITIZE_URL);
         *
         * Otro:
         * $url = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
         */

        /**
         * La función filter_input() obtiene una variable externa y opcionalmente la filtra.
         * Esta función se utiliza para validar las variables de fuentes inseguras, como la entrada de un usuario.
         */

        $url = str_replace('index.php', '', $url);//esto tambien tuve que agregar para que me direccione correctamente al login

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
            // Si Arreglo Url esta vacio, cargo el controlador por defecto y  cargo el index por defecto.
            $this->controlador = 'Login';
            $this->metodo = 'index';
        } else {
            // Quito el primer elemento del array y lo uso como controlador y el segundo lo uso como metodo
            $this->controlador = ucwords(array_shift($ArregloUrl));
            $this->metodo = array_shift($ArregloUrl);
        }

        if ($metodoRequest == 'GET') {

            if (!empty($ArregloUrl)) {
                $this->parametros = $ArregloUrl;
            }

        } else {

            if (!empty($_POST)) {
                $this->parametros = $_POST;
            }

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
     * @return /Array
     */
    public function getParametros()
    {
        return $this->parametros;
    }
}