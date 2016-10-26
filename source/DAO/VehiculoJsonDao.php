<?php
    require ('IVehiculoDao.php');

    class VehiculoJsonDao implements IVehiculoDao{
        protected $ruta;
        protected $lista;
        
        public function __construct($ruta = __DIR__.'/../vehiculos.txt')
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
            $vehiculos = json_decode(fgets($archivo),true);
            $this->mapear($vehiculos);
            fclose($archivo);
        }
        
        public function mapear($vehiculos)
        {
            $vehiculos = is_array($vehiculos) ? $vehiculos : [];
            $this->lista = array_map(function($v){
                return new Vehiculo($v['modelo'],$v['marca'],$v['patente'],$v['titular']);
            }, $vehiculos);
        }
        
        public function agregar($vehiculo)
        {
           $this->lista[] = $vehiculo;
        }
        
        public function borrar($patente)
        {
            foreach($this->lista as $v){
                if($v['patente'] == $patente){
                    unset($this->lista[$v]);
                }
            }
        }
        
        public function damePorPatente($patente = '')
        {
            return array_filter($this->listado,function($v) use ($patente) {
                return $v->getPatente() == $patente;
            });
        }
        
        public function dameTodos(){
            return $this->lista;
        }
    }

?>