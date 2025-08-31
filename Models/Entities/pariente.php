<?php
namespace Models\Entities;


    class Pariente{
        
        public $id;
        public $cedulaTrabajador;
        public $nombre;
        public $apellido;
        public $parentesco;
        public $discapacidad;
        public $fechaNacimiento;

        public function __construct(
            $id,
            $cedulaTrabajador = null,
            $nombre = null,
            $apellido = null,
            $parentesco = null,
            $discapacidad = null,
            $fechaNacimiento = null
        ){
            $this->id = $id;
            $this->cedulaTrabajador = $cedulaTrabajador;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->parentesco = $parentesco;
            $this->discapacidad = $discapacidad;
            $this->fechaNacimiento = $fechaNacimiento;
        }

        public function obtenerTrabajadorId(): ?int{
            return $this->cedulaTrabajador;
        }
        
        public function getTrabajadorId(){
            return $this->cedulaTrabajador;
        }

        public function setTrabajadorId(int $cedulaTrabajador){
            $this->cedulaTrabajador = $cedulaTrabajador;
        }

        //Getters para la clase Pariente
        public function getId(){
            return $this->id;
        }
        public function setId(int $id){
            $this->id = $id;
        }

        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre(string $nombre){
            $this->nombre = $nombre;
        }

        public function getApellido(){
            return $this->apellido;
        }
        public function setApellido(string $apellido){
            $this->apellido = $apellido;
        }

        public function getFechaNacimiento(){
            return $this->fechaNacimiento;
        }

        public function setFechaNacimiento(string $fechaNacimiento){
            $this->fechaNacimiento = $fechaNacimiento;
        }

        public function getDiscapacidad(){
            return $this->discapacidad;
        }

        public function setDiscapacidad(string $discapacidad){
            $this->discapacidad = $discapacidad;
        }

        public function getParentesco(){
            return $this->parentesco;
        }



    }





    
    


?>