<?php
namespace Models\Entities;

class Trabajador{
    //Atributos
    public $id;
    public $nacionalidad;
    public $cedula;
    public $nombre;
    public $apellido;
    public $fechaNacimiento;
    public $estadoCivil;
    public $telefonoFijo;
    public $telefonoMovil;
    public $email;
    public $estatura;
    public $peso;
    public $tipoSangre;
    public $discapacidad;
    public $tallaCamisa;
    public $tallaZapatos;
    public $tallaPantalon;
    public $vivienda;
    public $tenencia;
    public $estado;
    public $ciudad;
    public $municipio;
    public $parroquia;
    public $direccion;
    public $rif;
    public $cargo;
    public $coordinacion;
    public $numeroHijos;
    public array $pariente = [];

    //apartado pariente
    public $idPariente;
    public $trabajadorId;
    public $cedulaPariente;
    public $nombrePariente;
    public $apellidoPariente;
    public $fechaNacimientoPariente;
    public $parentesco;
    public $generoPariente;
    public $discapacidadPariente;

    //Constructor
    public function __construct(
        $id = null,
        $nacionalidad=null,
        $cedula = null,
        $nombre = null,
        $apellido = null,
        $fechaNacimiento = null,
        $estadoCivil = null,
        $telefonoFijo = null,
        $telefonoMovil = null,
        $email = null,
        $estatura = null,
        $peso = null,
        $tipoSangre = null,
        $discapacidad = null,
        $tallaCamisa = null,
        $tallaZapatos = null,
        $tallaPantalon = null,
        $vivienda = null,
        $tenencia = null,
        $estado = null,
        $ciudad = null,
        $municipio = null,
        $parroquia = null,
        $direccion = null,
        $rif = null,
        $cargo = null,
        $coordinacion = null,
        $numeroHijos = null,

        $idPariente = null,
        $trabajadorId = null,
        $cedulaPariente = null,
        $nombrePariente = null,
        $apellidoPariente = null,
        $fechaNacimientoPariente = null,
        $parentesco = null,
        $generoPariente = null,
        $discapacidadPariente = null
    ) {
        $this->id = $id;
        $this->nacionalidad = $nacionalidad;
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->estadoCivil = $estadoCivil;
        $this->telefonoFijo = $telefonoFijo;
        $this->telefonoMovil = $telefonoMovil;
        $this->email = $email;
        $this->estatura = $estatura;
        $this->peso = $peso;
        $this->tipoSangre = $tipoSangre;
        $this->discapacidad = $discapacidad;
        $this->tallaCamisa = $tallaCamisa;
        $this->tallaZapatos = $tallaZapatos;
        $this->tallaPantalon = $tallaPantalon;
        $this->vivienda = $vivienda;
        $this->tenencia = $tenencia;
        $this->estado = $estado;
        $this->ciudad = $ciudad;
        $this->municipio = $municipio;
        $this->parroquia = $parroquia;
        $this->direccion = $direccion;
        $this->rif = $rif;
        $this->cargo = $cargo;
        $this->coordinacion = $coordinacion;
        $this->numeroHijos = $numeroHijos;

        //Parientes
        $this->idPariente = $idPariente;
        $this->trabajadorId = $trabajadorId;
        $this->cedulaPariente = $cedulaPariente;
        $this->nombrePariente = $nombrePariente;
        $this->apellidoPariente = $apellidoPariente;
        $this->fechaNacimientoPariente = $fechaNacimientoPariente;
        $this->parentesco = $parentesco;
        $this->generoPariente = $generoPariente;
        $this->discapacidadPariente = $discapacidadPariente;
    }

    // Métodos Getters (para acceder a las propiedades)
    // Non-nullable by default, assume these always have values
    public function getId(): ?int { // ID can be null if not yet persisted
        return $this->id;
    }
    public function setId(?int $id): void {
        $this->id=$id;
    }
    public function getNacionalidad(): ?string { // Assuming nationalidad can be null
        return $this->nacionalidad;
    }
    public function setNacionalidad(?string $nacionalidad): void {
        $this->nacionalidad = $nacionalidad;
    }
    public function getCedula(): ?int { // Cedula can be null, especially if creating new
        return $this->cedula;
    }
    public function setCedula(?int $cedula): void {
        $this->cedula = $cedula;
    }
    public function getNombre(): ?string { // Names are essential, but making nullable for consistency
        return $this->nombre;
    }
    public function setNombre(?string $nombre): void {
        $this->nombre = $nombre;
    }
    public function getApellido(): ?string { // Names are essential, but making nullable for consistency
        return $this->apellido;
    }
    public function setApellido(?string $apellido): void {
        $this->apellido = $apellido;
    }
    public function getFechaNacimiento(): ?string { // Date can be null
        return $this->fechaNacimiento;
    }
    public function setFechaNacimiento(?string $fechaNacimiento): void { // Changed type hint to ?string
        $this->fechaNacimiento = $fechaNacimiento;
    }
    public function getEstadoCivil(): ?string { // Can be null
        return $this->estadoCivil;
    }
    public function setEstadoCivil(?string $estadoCivil): void {
        $this->estadoCivil = $estadoCivil;
    }
    public function getTelefonoFijo(): ?string { // Can be null
        return $this->telefonoFijo;
    }
    public function setTelefonoFijo(?string $telefonoFijo): void {
        $this->telefonoFijo = $telefonoFijo;
    }
    public function getTelefonoMovil(): ?string { // Can be null
        return $this->telefonoMovil;
    }
    public function setTelefonoMovil(?string $telefonoMovil): void {
        $this->telefonoMovil = $telefonoMovil;
    }
    public function getEmail(): ?string { // Can be null
        return $this->email;
    }
    public function setEmail(?string $email): void {
        $this->email = $email;
    }
    public function getEstatura(): ?int { // Can be null
        return $this->estatura;
    }
    public function setEstatura(?int $estatura): void {
        $this->estatura = $estatura;
    }
    public function getPeso(): ?int { // Can be null
        return $this->peso;
    }
    public function setPeso(?int $peso): void {
        $this->peso = $peso;
    }
    public function getTipoSangre(): ?string { // Can be null
        return $this->tipoSangre;
    }
    public function setTipoSangre(?string $tipoSangre): void {
        $this->tipoSangre = $tipoSangre;
    }
    public function getDiscapacidad(): ?string { // Can be null
        return $this->discapacidad;
    }
    public function setDiscapacidad(?string $discapacidad): void {
        $this->discapacidad = $discapacidad;
    }
    public function getTallaCamisa(): ?string { // **FIXED**: Can be null
        return $this->tallaCamisa;
    }
    public function setTallaCamisa(?string $tallaCamisa): void {
        $this->tallaCamisa = $tallaCamisa;
    }
    public function getTallaZapatos(): ?int { // **FIXED**: Can be null
        return $this->tallaZapatos;
    }
    public function setTallaZapatos(?int $tallaZapatos): void {
        $this->tallaZapatos = $tallaZapatos;
    }
    public function getTallaPantalon(): ?string { // **FIXED**: Assuming string (e.g., S, M, L) or int (size number), making it nullable
        return $this->tallaPantalon;
    }
    public function setTallaPantalon(?string $tallaPantalon): void {
        $this->tallaPantalon = $tallaPantalon;
    }
    public function getVivienda(): ?string { // Can be null
        return $this->vivienda;
    }
    public function setVivienda(?string $vivienda): void {
        $this->vivienda = $vivienda;
    }
    public function getTenencia(): ?string { // Can be null
        return $this->tenencia;
    }
    public function setTenencia(?string $tenencia): void {
        $this->tenencia = $tenencia;
    }
    public function getEstado(): ?int { // Can be null
        return $this->estado;
    }
    public function setEstado(?int $estado): void {
        $this->estado = $estado;
    }
    public function getCiudad(): ?int { // Can be null
        return $this->ciudad;
    }
    public function setCiudad(?int $ciudad): void {
        $this->ciudad = $ciudad;
    }
    public function getMunicipio(): ?int { // Can be null
        return $this->municipio;
    }
    public function setMunicipio(?int $municipio): void {
        $this->municipio = $municipio;
    }
    public function getParroquia(): ?int { // Can be null
        return $this->parroquia;
    }
    public function setParroquia(?int $parroquia): void {
        $this->parroquia = $parroquia;
    }
    public function getDireccion(): ?string { // Can be null
        return $this->direccion;
    }
    public function setDireccion(?string $direccion): void {
        $this->direccion = $direccion;
    }
    public function getRif(): ?string { // Can be null
        return $this->rif;
    }
    public function setRif(?string $rif): void {
        $this->rif = $rif;
    }
    public function getCargo(): ?int { // Can be null
        return $this->cargo;
    }
    public function setCargo(?int $cargo): void {
        $this->cargo = $cargo;
    }
    public function getCoordinacion(): ?int { // Can be null
        return $this->coordinacion;
    }
    public function setCoordinacion(?int $coordinacion): void {
        $this->coordinacion = $coordinacion;
    }
    public function getNumeroHijos(): ?int { // Can be null
        return $this->numeroHijos;
    }
    public function setNumeroHijos(?int $numeroHijos): void {
        $this->numeroHijos = $numeroHijos;
    }

    // Getters para la clase Pariente (also made nullable where appropriate)
    public function getIdPariente(): ?int { return $this->idPariente; }
    public function setIdPariente(?int $idPariente): void {$this->idPariente = $idPariente;}
    public function getTrabajadorId(): ?int { return $this->trabajadorId; }
    public function setTrabajadorId(?int $trabajadorId): void {$this->trabajadorId = $trabajadorId;}
    public function getCedulaPariente(): ?string { return $this->cedulaPariente; }
    public function setCedulaPariente(?string $cedulaPariente): void{$this->cedulaPariente = $cedulaPariente;}
    public function getNombrePariente(): ?string { return $this->nombrePariente; }
    public function setNombrePariente(?string $nombrePariente): void {$this->nombrePariente = $nombrePariente;}
    public function getApellidoPariente(): ?string { return $this->apellidoPariente; }
    public function setApellidoPariente(?string $apellidoPariente): void{$this->apellidoPariente = $apellidoPariente;}
    public function getFechaNacimientoPariente(): ?string { return $this->fechaNacimientoPariente; }
    public function setFechaNacimientoPariente(?string $fechaNacimientoPariente): void {$this->fechaNacimientoPariente = $fechaNacimientoPariente;}
    public function getParentesco(): ?string { return $this->parentesco; }
    public function setParentesco(?string $parentesco): void{$this->parentesco = $parentesco;}
    public function getGeneroPariente(): ?string {return $this->generoPariente;}
    public function setGeneroPariente(?string $generoPariente): void{$this->generoPariente = $generoPariente;}
    public function getDiscapacidadPariente(): ?string { return $this->discapacidadPariente; }
    public function setDiscapacidadPariente(?string $discapacidadPariente): void {$this->discapacidadPariente = $discapacidadPariente;}

}