CREATE TABLE roles
(
  id_roles    SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  descripcion VARCHAR(20),

  CONSTRAINT pk_de_roles PRIMARY KEY (id_roles)
);


CREATE TABLE usuarios
(
  id_usuarios SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  mail        VARCHAR(50) UNIQUE NOT NULL,

  pwd         VARCHAR(32)  NOT NULL,
  
  id_roles    SMALLINT UNSIGNED,

  CONSTRAINT pk_de_usuario PRIMARY KEY (id_usuarios),

  CONSTRAINT fk_de_rol FOREIGN KEY (id_roles) REFERENCES roles (id_roles)
    ON DELETE CASCADE
);


CREATE TABLE titulares
(
  id_titulares SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  id_usuarios  SMALLINT UNSIGNED,

  dni          VARCHAR(10) UNIQUE  NOT NULL,

  nombre       VARCHAR(20) NOT NULL,

  apellido     VARCHAR(20) NOT NULL,

  telefono     VARCHAR(40) UNIQUE,

  CONSTRAINT pk_de_id_titulares PRIMARY KEY (id_titulares),

  CONSTRAINT fk_de_usuario FOREIGN KEY (id_usuarios) REFERENCES usuarios (id_usuarios)
    ON DELETE CASCADE
);


CREATE TABLE vehiculos
(
  id_vehiculos SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  id_titulares SMALLINT UNSIGNED,

  dominio      VARCHAR(10) UNIQUE NOT NULL,

  marca        VARCHAR(10) NOT NULL,

  modelo       VARCHAR(10) NOT NULL,

  qr           VARCHAR(100) UNIQUE,

  CONSTRAINT pk_de_vehiculos PRIMARY KEY (id_vehiculos),

  CONSTRAINT fk_de_id_titular FOREIGN KEY (id_titulares) REFERENCES titulares (id_titulares)
    ON DELETE CASCADE
);


CREATE TABLE cuentas_corrientes
(
  id_cuentas_corrientes      SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fecha_ultima_actualisacion DATETIME  NOT NULL,

  maximo_credito  FLOAT UNSIGNED  NOT NULL,

  saldo           FLOAT UNSIGNED NOT NULL,

  id_vehiculos    SMALLINT UNSIGNED,

  CONSTRAINT pk_de_id_cuentas_corrientes PRIMARY KEY (id_cuentas_corrientes),

  CONSTRAINT fk_de_id_vehiculos FOREIGN KEY (id_vehiculos) REFERENCES vehiculos (id_vehiculos)
    ON DELETE CASCADE
);


CREATE TABLE sensores
(
  id_sensores   SMALLINT UNSIGNED AUTO_INCREMENT,
  
  tipo_sensor   VARCHAR(40),

  fecha_alta    DATE,

  latitud       FLOAT,

  longitud      FLOAT,

  numeros_serie VARCHAR(30) UNIQUE NOT NULL,

  CONSTRAINT pk_id_sensores PRIMARY KEY (id_sensores)
);


CREATE TABLE eventos
(
id_eventos SMALLINT UNSIGNED AUTO_INCREMENT,

tipo_evento VARCHAR (40),

foto MEDIUMBLOB,

tipo_foto VARCHAR(10),

id_sensores SMALLINT UNSIGNED,

CONSTRAINT pk_de_eventos PRIMARY KEY(id_eventos),

CONSTRAINT fk_de_id_de_sensores FOREIGN KEY(id_sensores) REFERENCES sensores(id_sensores)
on DELETE CASCADE
);

CREATE TABLE movimientos_cuentas_corrientes
(
  id_movimientos        SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fecha_hora            DATETIME   NOT NULL,

  inporte               FLOAT UNSIGNED NOT NULL,

  id_cuentas_corrientes SMALLINT UNSIGNED,

  id_eventos   SMALLINT UNSIGNED,

  CONSTRAINT pk_de_id_movimientos PRIMARY KEY (id_movimientos),

  CONSTRAINT fk_de_id_cuentas_corrientes_de_cuentas FOREIGN KEY (id_cuentas_corrientes) REFERENCES cuentas_corrientes (id_cuentas_corrientes)
    ON DELETE CASCADE,

  CONSTRAINT fk_de_id_de_eventos_eventos FOREIGN KEY (id_eventos) REFERENCES eventos(id_eventos)
    ON DELETE CASCADE

);


CREATE TABLE pagos
(
  id_pagos   SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fecha      DATE  NOT NULL,

  id_movimientos SMALLINT UNSIGNED,

  CONSTRAINT pk_id_pagos PRIMARY KEY (id_pagos),

  CONSTRAINT fk_de_id_movimientos FOREIGN KEY (id_movimientos) REFERENCES movimientos_cuentas_corrientes (id_movimientos)
    ON DELETE CASCADE
);


CREATE TABLE tarifas
(
  id_tarifas        SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fecha_desde       DATE   NOT NULL,

  fecha_asta        DATE,

  multa             FLOAT UNSIGNED  NOT NULL,

  peaje_hora_normal DATE,

  peaje_hora_pico   DATE,

  CONSTRAINT pk_id_de_tarifas PRIMARY KEY (id_tarifas)
);
  
