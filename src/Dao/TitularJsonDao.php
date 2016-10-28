<?php
    require ('IVehiculoDao.php');

    class TitularJsonDao implements ITitularDao{
        protected $ruta;
        protected $lista;
        
        public function __construct($ruta = __DIR__.'/../titulares.txt')
        {
            if(! file_exists($ruta)){
                throw new Exception('No se encontro el archivo' . $ruta ); 
            }
            
            $this->ruta = $ruta;
            $this->leer();
        }
        
        public function __destruct()
        {
            $archivo = fopen($this->ruta,'w');
            fwrite($archivo,json_encode($this->lista));
            fclose($archivo);
        }
        
        public function leer()
        {
            $archivo = fopen($this->ruta,'r');
            $titulares = json_decode(fgets($titulares),true);
            $this->mapear($titulares);
            fclose($archivo);
        }
        
        public function mapear($titulares)
        {
            $titulares = is_array($titulares) ? $titulares: [];
            $this->lista = array_map(function($v){
                return new Titular($v['nombre'],$v['apellido'],$v['dni'],$v['telefono'],$v['usuario']);
            }, $titulares);
        }
        
        public function agregar($titular)
        {
           $this->lista[] = $titular;
        }
        
        public function borrar($dni)
        {
            foreach($this->lista as $v){
                if($v['dni'] == $dni){
                    unset($this->lista[$v]);
                }
            }
        }
        
        public function damePorDni($dni = '')
        {
            return array_filter($this->listado,function($v) use ($dni) {
                return $v->getPatente() == $dni;
            });
        }
        
        public function dameTodos(){
            return $this->lista;
        }
    }

