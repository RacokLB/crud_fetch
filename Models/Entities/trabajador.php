<?php
namespace Models\Entities;

class Trabajador
{
    //Atributos
    public $id;
    public $nacionalidad;
    public $cedula;
    public $nombres;
    public $apellidos;
    public $genero;
    public $fecha_nacimiento;
    public $estado_civil;
    public $telefono_fijo;
    public $telefono_movil;
    public $grado_academico;
    public $email;
    public $estatura;
    public $peso;
    public $tipo_sangre;
    public $discapacidad;
    public $talla_camisa;
    public $talla_zapatos;
    public $talla_pantalon;
    public $vivienda;
    public $tenencia;
    public $estado;
    public $ciudad;
    public $municipio;
    public $parroquia;
    public $direccion;
    public $rif;
    public $cargo;
    public $cargo_id;
    public $estatus;
    public $fecha_ingreso;
    public $coordinacion;
    public $coordinacion_id;
    public $num_hijos;
    public array $parientes = [];

    //apartado pariente
    public $idPariente;
    public $trabajador_id;
    public $cedulaPariente;
    public $nombrePariente;
    public $apellidoPariente;
    public $fechaNacimientoPariente;
    public $parentesco;
    public $generoPariente;
    public $coordinacionPariente;
    public $discapacidadPariente;

    //Constructor
    public function __construct(
        $id = null,
        $nacionalidad = null,
        $cedula = null,
        $nombres = null,
        $apellidos = null,
        $genero = null,
        $fecha_nacimiento = null,
        $estado_civil = null,
        $telefono_fijo = null,
        $telefono_movil = null,
        $grado_academico = null,
        $email = null,
        $estatura = null,
        $peso = null,
        $tipo_sangre = null,
        $discapacidad = null,
        $talla_camisa = null,
        $talla_zapatos = null,
        $talla_pantalon = null,
        $vivienda = null,
        $tenencia = null,
        $estado = null,
        $ciudad = null,
        $municipio = null,
        $parroquia = null,
        $direccion = null,
        $rif = null,
        $cargo = null,
        $cargo_id = null,
        $estatus = null,
        $fecha_ingreso = null,
        $coordinacion = null,
        $coordinacion_id = null,
        $num_hijos = null,

        $idPariente = null,
        $trabajador_id = null,
        $cedulaPariente = null,
        $nombrePariente = null,
        $apellidoPariente = null,
        $fechaNacimientoPariente = null,
        $parentesco = null,
        $generoPariente = null,
        $coordinacionPariente = null,
        $discapacidadPariente = null
    ) {
        $this->id = $id;
        $this->nacionalidad = $nacionalidad;
        $this->cedula = $cedula;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->genero = $genero;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->estado_civil = $estado_civil;
        $this->telefono_fijo = $telefono_fijo;
        $this->telefono_movil = $telefono_movil;
        $this->grado_academico = $grado_academico;
        $this->email = $email;
        $this->estatura = $estatura;
        $this->peso = $peso;
        $this->tipo_sangre = $tipo_sangre;
        $this->discapacidad = $discapacidad;
        $this->talla_camisa = $talla_camisa;
        $this->talla_zapatos = $talla_zapatos;
        $this->talla_pantalon = $talla_pantalon;
        $this->vivienda = $vivienda;
        $this->tenencia = $tenencia;
        $this->estado = $estado;
        $this->ciudad = $ciudad;
        $this->municipio = $municipio;
        $this->parroquia = $parroquia;
        $this->direccion = $direccion;
        $this->rif = $rif;
        $this->cargo = $cargo;
        $this->cargo_id = $cargo_id;
        $this->estatus = $estatus;
        $this->fecha_ingreso = $fecha_ingreso;
        $this->coordinacion = $coordinacion;
        $this->coordinacion_id = $coordinacion_id;
        $this->num_hijos = $num_hijos;

        //Parientes
        $this->idPariente = $idPariente;
        $this->trabajador_id = $trabajador_id;
        $this->cedulaPariente = $cedulaPariente;
        $this->nombrePariente = $nombrePariente;
        $this->apellidoPariente = $apellidoPariente;
        $this->fechaNacimientoPariente = $fechaNacimientoPariente;
        $this->parentesco = $parentesco;
        $this->generoPariente = $generoPariente;
        $this->coordinacionPariente = $coordinacionPariente;
        $this->discapacidadPariente = $discapacidadPariente;
    }

    // Métodos Getters (para acceder a las propiedades)
    // Non-nullable by default, assume these always have values
    public function getId(): ?int
    { // ID can be null if not yet persisted
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    public function getNacionalidad(): ?string
    { // Assuming nationalidad can be null
        return $this->nacionalidad;
    }
    public function setNacionalidad(?string $nacionalidad): void
    {
        $this->nacionalidad = $nacionalidad;
    }
    public function getCedula(): ?int
    { // Cedula can be null, especially if creating new
        return $this->cedula;
    }
    public function setCedula(?int $cedula): void
    {
        $this->cedula = $cedula;
    }
    public function getNombre(): ?string
    { // Names are essential, but making nullable for consistency
        return $this->nombres;
    }
    public function setNombre(?string $nombres): void
    {
        $this->nombres = $nombres;
    }
    public function getApellido(): ?string
    { // Names are essential, but making nullable for consistency
        return $this->apellidos;
    }
    public function setApellido(?string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }
    public function getGenero(): ?string
    { // Can be null
        return $this->genero;
    }
    public function setGenero(?string $genero): void
    {
        $this->genero = $genero;
    }
    public function getFecha_nacimiento(): ?string
    { // Date can be null
        return $this->fecha_nacimiento;
    }
    public function setFecha_nacimiento(?string $fecha_nacimiento): void
    { // Changed type hint to ?string
        $this->fecha_nacimiento = $fecha_nacimiento;
    }
    public function getEstado_civil(): ?string
    { // Can be null
        return $this->estado_civil;
    }
    public function setEstado_civil(?string $estado_civil): void
    {
        $this->estado_civil = $estado_civil;
    }
    public function getTelefono_fijo(): ?string
    { // Can be null
        return $this->telefono_fijo;
    }
    public function setTelefono_fijo(?string $telefono_fijo): void
    {
        $this->telefono_fijo = $telefono_fijo;
    }
    public function getTelefono_movil(): ?string
    { // Can be null
        return $this->telefono_movil;
    }
    public function setTelefono_movil(?string $telefono_movil): void
    {
        $this->telefono_movil = $telefono_movil;
    }
    public function getGrado_academico(): ?int
    { // Can be null
        return $this->grado_academico;
    }
    public function setGrado_academico(?int $grado_academico): void
    {
        $this->grado_academico = $grado_academico;
    }
    public function getEmail(): ?string
    { // Can be null
        return $this->email;
    }
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
    public function getEstatura(): ?string
    { // Can be null
        return $this->estatura;
    }
    public function setEstatura(?string $estatura): void
    {
        $this->estatura = $estatura;
    }
    public function getPeso(): ?string
    { // Can be null
        return $this->peso;
    }
    public function setPeso(?string $peso): void
    {
        $this->peso = $peso;
    }
    public function getTipo_sangre(): ?string
    { // Can be null
        return $this->tipo_sangre;
    }
    public function setTipo_sangre(?string $tipo_sangre): void
    {
        $this->tipo_sangre = $tipo_sangre;
    }
    public function getDiscapacidad(): ?string
    { // Can be null
        return $this->discapacidad;
    }
    public function setDiscapacidad(?string $discapacidad): void
    {
        $this->discapacidad = $discapacidad;
    }
    public function getTalla_camisa(): ?string
    { // **FIXED**: Can be null
        return $this->talla_camisa;
    }
    public function setTalla_camisa(?string $talla_camisa): void
    {
        $this->talla_camisa = $talla_camisa;
    }
    public function getTalla_zapatos(): ?int
    { // **FIXED**: Can be null
        return $this->talla_zapatos;
    }
    public function setTalla_zapatos(?int $talla_zapatos): void
    {
        $this->talla_zapatos = $talla_zapatos;
    }
    public function getTalla_pantalon(): ?int
    { // **FIXED**: Assuming string (e.g., S, M, L) or int (size number), making it nullable
        return $this->talla_pantalon;
    }
    public function setTalla_pantalon(?int $talla_pantalon): void
    {
        $this->talla_pantalon = $talla_pantalon;
    }
    public function getVivienda(): ?string
    { // Can be null
        return $this->vivienda;
    }
    public function setVivienda(?string $vivienda): void
    {
        $this->vivienda = $vivienda;
    }
    public function getTenencia(): ?string
    { // Can be null
        return $this->tenencia;
    }
    public function setTenencia(?string $tenencia): void
    {
        $this->tenencia = $tenencia;
    }
    public function getEstado(): ?string
    { // Can be null
        return $this->estado;
    }
    public function setEstado(?string $estado): void
    {
        $this->estado = $estado;
    }
    public function getCiudad(): ?string
    { // Can be null
        return $this->ciudad;
    }
    public function setCiudad(?string $ciudad): void
    {
        $this->ciudad = $ciudad;
    }
    public function getMunicipio(): ?string
    { // Can be null
        return $this->municipio;
    }
    public function setMunicipio(?string $municipio): void
    {
        $this->municipio = $municipio;
    }
    public function getParroquia(): ?string
    { // Can be null
        return $this->parroquia;
    }
    public function setParroquia(?string $parroquia): void
    {
        $this->parroquia = $parroquia;
    }
    public function getDireccion(): ?string
    { // Can be null
        return $this->direccion;
    }
    public function setDireccion(?string $direccion): void
    {
        $this->direccion = $direccion;
    }
    public function getRif(): ?int
    { // Can be null
        return $this->rif;
    }
    public function setRif(?int $rif): void
    {
        $this->rif = $rif;
    }
    public function getCargo(): ?string
    { // Can be null
        return $this->cargo;
    }
    public function setCargo(?string $cargo): void
    {
        $this->cargo = $cargo;
    }
    public function getCargo_id(): ?int
    {
        return $this->cargo_id;
    }
    public function setCargo_id(?int $cargo_id): void
    {
        $this->cargo_id = $cargo_id;
    }
    public function getEstatus(): ?string
    {
        return $this->estatus;
    }
    public function setEstatus(?string $estatus): void
    {
        $this->estatus = $estatus;
    }
    public function getFecha_ingreso(): ?string
    { // Can be null
        return $this->fecha_ingreso;
    }
    public function setFecha_ingreso(?string $fecha_ingreso): void
    {
        $this->fecha_ingreso = $fecha_ingreso;
    }
    public function getCoordinacion(): ?string
    { // Can be null
        return $this->coordinacion;
    }
    public function setCoordinacion(?string $coordinacion): void
    {
        $this->coordinacion = $coordinacion;
    }
    public function getCoordinacion_id(): ?int
    {
        return $this->coordinacion_id;
    }
    public function setCoordinacion_id(?int $coordinacion_id): void
    {
        $this->coordinacion_id = $coordinacion_id;
    }
    public function getNum_hijos(): ?string
    { // Can be null
        return $this->num_hijos;
    }
    public function setNum_hijos(?string $num_hijos): void
    {
        $this->num_hijos = $num_hijos;
    }

    // Getters para la clase Pariente (also made nullable where appropriate)
    public function getIdPariente(): ?int
    {
        return $this->idPariente;
    }
    public function setIdPariente(?int $idPariente): void
    {
        $this->idPariente = $idPariente;
    }
    public function getTrabajador_id(): ?int
    {
        return $this->trabajador_id;
    }
    public function setTrabajador_id(?int $trabajador_id): void
    {
        $this->trabajador_id = $trabajador_id;
    }
    public function getCedulaPariente(): ?string
    {
        return $this->cedulaPariente;
    }
    public function setCedulaPariente(?string $cedulaPariente): void
    {
        $this->cedulaPariente = $cedulaPariente;
    }
    public function getNombrePariente(): ?string
    {
        return $this->nombrePariente;
    }
    public function setNombrePariente(?string $nombrePariente): void
    {
        $this->nombrePariente = $nombrePariente;
    }
    public function getApellidoPariente(): ?string
    {
        return $this->apellidoPariente;
    }
    public function setApellidoPariente(?string $apellidoPariente): void
    {
        $this->apellidoPariente = $apellidoPariente;
    }
    public function getFechaNacimientoPariente(): ?string
    {
        return $this->fechaNacimientoPariente;
    }
    public function setFechaNacimientoPariente(?string $fechaNacimientoPariente): void
    {
        $this->fechaNacimientoPariente = $fechaNacimientoPariente;
    }
    public function getParentesco(): ?string
    {
        return $this->parentesco;
    }
    public function setParentesco(?string $parentesco): void
    {
        $this->parentesco = $parentesco;
    }
    public function getGeneroPariente(): ?string
    {
        return $this->generoPariente;
    }
    public function setGeneroPariente(?string $generoPariente): void
    {
        $this->generoPariente = $generoPariente;
    }
    public function getCoordinacionPariente(): ?int
    {
        return $this->coordinacionPariente;
    }
    public function setCoordinacionPariente(?int $coordinacionPariente): void
    {
        $this->coordinacionPariente = $coordinacionPariente;
    }
    public function getDiscapacidadPariente(): ?string
    {
        return $this->discapacidadPariente;
    }
    public function setDiscapacidadPariente(?string $discapacidadPariente): void
    {
        $this->discapacidadPariente = $discapacidadPariente;
    }

}