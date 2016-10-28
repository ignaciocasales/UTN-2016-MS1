<?php

class PersonaJsonDao implements IPersonaDao{
    
    private $ruta;
    private $lista;
    
    public function __constructor($ruta = __DIR__.'/../persona.txt'){
        
        if(! file_exists ($ruta)){
            throw new Exception ('No se encontro el archivo "personas.txt" ');
        }
        
        $this->ruta = $ruta;
        $this->leer();
    }
    
    public function __destruct(){
        $archivo = fopen($this->ruta,'w');
        
        fwrite($archivo,json_encode($this->lista));
        fclose($archivo);
    }
    
    public function leer(){
        $archivo = fopen($this->ruta,'r');
        $jsonArchivo = json_decode(fgets($archivo),true);
        $this->mapear($jsonArchivo);
        fclose($archivo);
    }
    
    public function mapear($jsonArchivo){
        $persona = is_array($jsonArchivo) ? $jsonArchivo : [];
        $this->lista = array_map(function($p){
            return new Persona($p['nombre'],$p['dni'],$p['domicilio']);
        },$persona);
    }
    
    public function agregar($persona){
        $this->lista[] = $persona;
    }
    
    public function dameTodos(){
        return $this->lista;
    }
    
    public function buscarDni($dni = 0){
        return array_filter($this->lista,function($p) use ($dni){
           return $p->getDni() == $dni; 
        });
    }
}



?>