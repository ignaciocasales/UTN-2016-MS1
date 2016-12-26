/*CREATE DATABASE trafimdq;
 USE TrafiMDQ; */

CREATE TABLE roles
(
  idRol       SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  descripcion VARCHAR(20) UNIQUE               NOT NULL,

  CONSTRAINT pkRol PRIMARY KEY (idRol)
);


CREATE TABLE usuarios
(
  idUsuario SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  correo    VARCHAR(50)                      NOT NULL,

  pwd       VARCHAR(32)                      NOT NULL,

  idRol     SMALLINT UNSIGNED                NOT NULL,

  CONSTRAINT pkUsuario PRIMARY KEY (idUsuario),

  CONSTRAINT fkRolesUsuarios FOREIGN KEY (idRol) REFERENCES roles (idRol)
    ON DELETE CASCADE,

  CONSTRAINT unqUsuarioCorreo UNIQUE (correo)
);


CREATE TABLE titulares
(
  idTitular SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  idUsuario SMALLINT UNSIGNED                NOT NULL,

  dni       VARCHAR(10)                      NOT NULL,

  nombre    VARCHAR(20)                      NOT NULL,

  apellido  VARCHAR(20)                      NOT NULL,

  telefono  VARCHAR(40)                      NOT NULL,

  CONSTRAINT pkTitular PRIMARY KEY (idTitular),

  CONSTRAINT fkUsuariosTitulares FOREIGN KEY (idUsuario) REFERENCES usuarios (idUsuario)
    ON DELETE CASCADE,

  CONSTRAINT unqTitularDni UNIQUE (dni),

  CONSTRAINT unqTitularTelefono UNIQUE (telefono),

  CONSTRAINT unqTitularIdUsuario UNIQUE (idUsuario)
);


CREATE TABLE vehiculos
(
  idVehiculo SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  idTitular  SMALLINT UNSIGNED                NOT NULL,

  dominio    VARCHAR(10)                      NOT NULL,

  marca      VARCHAR(10)                      NOT NULL,

  modelo     VARCHAR(10)                      NOT NULL,

  qr         VARCHAR(100),

  CONSTRAINT pkVehiculo PRIMARY KEY (idVehiculo),

  CONSTRAINT fkTitularesVehiculos FOREIGN KEY (idTitular) REFERENCES titulares (idTitular)
    ON DELETE CASCADE,

  CONSTRAINT unqVehiculoDominio UNIQUE (dominio),

  CONSTRAINT unqVehiculoQr UNIQUE (qr)
);


CREATE TABLE cuentas_corrientes
(
  idCuentaCorriente   SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  ultimaActualizacion DATETIME                         NOT NULL,

  maximoCredito       FLOAT UNSIGNED                   NOT NULL,

  saldo               FLOAT                            NOT NULL,

  idVehiculo          SMALLINT UNSIGNED                NOT NULL,

  CONSTRAINT pkCuentaCorriente PRIMARY KEY (idCuentaCorriente),

  CONSTRAINT fkVehiculosCuentasCorrientes FOREIGN KEY (idVehiculo) REFERENCES vehiculos (idVehiculo)
    ON DELETE CASCADE,

  CONSTRAINT unqCuentaCorrienteVehiculo UNIQUE (idVehiculo)
);


CREATE TABLE tipos_sensores
(
  idTipoSensor SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  descripcion  VARCHAR(50)                      NOT NULL,

  CONSTRAINT pkTipoSensor PRIMARY KEY (idTipoSensor),

  CONSTRAINT unqTipoSensorDescripcion UNIQUE (descripcion)
);


CREATE TABLE sensores
(
  idSensor     SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fechaAlta    DATE                             NOT NULL,

  latitud      FLOAT                            NOT NULL,

  longitud     FLOAT                            NOT NULL,

  numeroSerie  VARCHAR(30)                      NOT NULL,

  idTipoSensor SMALLINT UNSIGNED                NOT NULL,

  CONSTRAINT pkSensor PRIMARY KEY (idSensor),

  CONSTRAINT fkTiposSensoresSensores FOREIGN KEY (idTipoSensor) REFERENCES tipos_sensores (idTipoSensor)
    ON DELETE CASCADE,

  CONSTRAINT unqSensorNumeroSerie UNIQUE (numeroSerie)
);


CREATE TABLE tipos_eventos
(
  idTipoEvento SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  descripcion  VARCHAR(50)                      NOT NULL,

  CONSTRAINT pkTipoEvento PRIMARY KEY (idTipoEvento),

  CONSTRAINT unqTipoEventoDescripcion UNIQUE (descripcion)
);


CREATE TABLE eventos
(
  idEvento     SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fehcaHora    DATETIME                         NOT NULL,

  idTipoEvento SMALLINT UNSIGNED                NOT NULL,

  idSensor     SMALLINT UNSIGNED                NOT NULL,

  CONSTRAINT pkEvento PRIMARY KEY (idEvento),

  CONSTRAINT fkSensoresEventos FOREIGN KEY (idSensor) REFERENCES sensores (idSensor)
    ON DELETE CASCADE,

  CONSTRAINT fkTipoEventoEvento FOREIGN KEY (idTipoEvento) REFERENCES tipos_eventos (idTipoEvento)
    ON DELETE CASCADE
);


CREATE TABLE movimientos
(
  idMovimiento      SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fehchaHora        DATETIME                         NOT NULL,

  importe           FLOAT UNSIGNED                   NOT NULL,

  idCuentaCorriente SMALLINT UNSIGNED                NOT NULL,

  idEvento          SMALLINT UNSIGNED                NOT NULL,

  CONSTRAINT pkMovimiento PRIMARY KEY (idMovimiento),

  CONSTRAINT fkCuentasCorrientesMovimientos FOREIGN KEY (idCuentaCorriente) REFERENCES cuentas_corrientes (idCuentaCorriente)
    ON DELETE CASCADE,

  CONSTRAINT fkEventosMovimientos FOREIGN KEY (idEvento) REFERENCES eventos (idEvento)
    ON DELETE CASCADE

);

CREATE TABLE tarifas
(
  idTarifa        SMALLINT UNSIGNED AUTO_INCREMENT       NOT NULL,

  fechaDesde      DATETIME UNIQUE                        NOT NULL,

  fechaHasta      DATETIME UNIQUE                        NOT NULL,

  multa           FLOAT UNSIGNED                         NOT NULL,

  peajeHoraNormal FLOAT UNSIGNED                         NOT NULL,

  peajeHoraPico   FLOAT UNSIGNED                         NOT NULL,

  CONSTRAINT pkTarifa PRIMARY KEY (idTarifa)
);

CREATE TABLE marcas
(
  idMarca SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  nombre  VARCHAR(40)                      NOT NULL,

  CONSTRAINT pkMarca PRIMARY KEY (idMarca)
);


CREATE TABLE modelos
(
  idModelo SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  idMarca  SMALLINT UNSIGNED                NOT NULL,

  nombre   VARCHAR(50)                      NOT NULL,

  CONSTRAINT pkModelo PRIMARY KEY (idModelo),

  CONSTRAINT fkMarcasModelos FOREIGN KEY (idMarca) REFERENCES marcas (idMarca)
    ON DELETE CASCADE
);