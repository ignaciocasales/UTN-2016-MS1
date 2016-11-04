CREATE TABLE roles
(
  id_roles    SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  descripcion VARCHAR(20),

  CONSTRAINT pk_de_roles PRIMARY KEY (id_roles)
);


CREATE TABLE usuarios
(
  id_usuarios SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  mail        VARCHAR(50)                      NOT NULL,

  pwd         VARCHAR(32)                      NOT NULL,

  id_roles    SMALLINT UNSIGNED,

  CONSTRAINT pk_de_usuario PRIMARY KEY (id_usuarios),

  CONSTRAINT fk_de_rol FOREIGN KEY (id_roles) REFERENCES roles (id_roles)
    ON DELETE CASCADE
);


CREATE TABLE titulares
(
  id_titulares SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  id_usuarios  SMALLINT UNSIGNED,

  dni          VARCHAR(10) UNIQUE               NOT NULL,

  nombre       VARCHAR(20)                      NOT NULL,

  apellido     VARCHAR(20)                      NOT NULL,

  telefono     VARCHAR(40) UNIQUE,

  CONSTRAINT pk_de_id_titulares PRIMARY KEY (id_titulares),

  CONSTRAINT fk_de_usuario FOREIGN KEY (id_usuarios) REFERENCES usuarios (id_usuarios)
    ON DELETE CASCADE
);


CREATE TABLE vehiculos
(
  id_vehiculos SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  id_titulares SMALLINT UNSIGNED,

  dominio      VARCHAR(10)                      NOT NULL,

  marca        VARCHAR(10)                      NOT NULL,

  modelo       VARCHAR(10)                      NOT NULL,

  qr           VARCHAR(100),

  CONSTRAINT pk_de_vehiculos PRIMARY KEY (id_vehiculos),

  CONSTRAINT fk_de_id_titular FOREIGN KEY (id_titulares) REFERENCES titulares (id_titulares)
    ON DELETE CASCADE
);


CREATE TABLE cuentas_corrientes
(
  id_cuentas_corrientes      SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fecha_ultima_acrualisacion DATETIME                         NOT NULL,

  maximo_credito             FLOAT UNSIGNED                   NOT NULL,

  saldo                      FLOAT UNSIGNED                   NOT NULL,

  id_vehiculos               SMALLINT UNSIGNED,

  CONSTRAINT pk_de_id_cuentas_corrientes PRIMARY KEY (id_cuentas_corrientes),

  CONSTRAINT fk_de_id_vehiculos FOREIGN KEY (id_vehiculos) REFERENCES vehiculos (id_vehiculos)
    ON DELETE CASCADE
);


CREATE TABLE sensores
(
  id_sensores   SMALLINT UNSIGNED AUTO_INCREMENT,

  fecha_alta    DATE,

  latitud       FLOAT,

  longitud      FLOAT,

  numeros_serie VARCHAR(30) UNIQUE NOT NULL,

  CONSTRAINT pk_id_sensores PRIMARY KEY (id_sensores)
);


CREATE TABLE sensores_semaforos
(
  id_sensores_semaforos SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  id_sensores           SMALLINT UNSIGNED,

  CONSTRAINT pk_de_id_sensores_semaforo PRIMARY KEY (id_sensores_semaforos),

  CONSTRAINT fk_de_id_de_sensores FOREIGN KEY (id_sensores) REFERENCES sensores (id_sensores)
    ON DELETE CASCADE
);


CREATE TABLE sensor_peajes
(
  id_sensor_peajes SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  id_sensores      SMALLINT UNSIGNED,

  CONSTRAINT pk_de_id_sensor_peajes PRIMARY KEY (id_sensor_peajes),

  CONSTRAINT fk_de_id_de_sensores_peajes FOREIGN KEY (id_sensores) REFERENCES sensores (id_sensores)
    ON DELETE CASCADE
);


CREATE TABLE eventos_multas
(
  id_eventos_multas     SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fecha_hora            DATE                             NOT NULL,

  foto                  MEDIUMBLOB,

  tipo_foto             VARCHAR(30),

  id_sensores_semaforos SMALLINT UNSIGNED,

  CONSTRAINT pf_de_id_eventos_multas PRIMARY KEY (id_eventos_multas),

  CONSTRAINT fk_de_id_de_sensores_semaforos FOREIGN KEY (id_sensores_semaforos) REFERENCES sensores_semaforos (id_sensores_semaforos)
    ON DELETE CASCADE
);


CREATE TABLE eventos_peajes
(
  id_eventos_peajes SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fecha_hora        DATE                             NOT NULL,

  foto              MEDIUMBLOB,

  tipo              VARCHAR(50),

  id_sensor_peajes  SMALLINT UNSIGNED,

  CONSTRAINT pk_de_id_evento_peajes PRIMARY KEY (id_eventos_peajes),

  CONSTRAINT fk_de_id_sensor_peajes FOREIGN KEY (id_sensor_peajes) REFERENCES sensor_peajes (id_sensor_peajes)
    ON DELETE CASCADE
);


CREATE TABLE movimientos_cuentas_corrientes
(
  id_movimientos        SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fecha_hora            DATETIME                         NOT NULL,

  inporte               FLOAT UNSIGNED                   NOT NULL,

  id_cuentas_corrientes SMALLINT UNSIGNED,

  id_eventos_peajes     SMALLINT UNSIGNED,

  id_evento_multas      SMALLINT UNSIGNED,

  CONSTRAINT pk_de_id_movimientos PRIMARY KEY (id_movimientos),

  CONSTRAINT fk_de_id_cuentas_corrientes_de_cuentas FOREIGN KEY (id_cuentas_corrientes) REFERENCES cuentas_corrientes (id_cuentas_corrientes)
    ON DELETE CASCADE,

  CONSTRAINT fk_de_id_eventos_peaje_peajes FOREIGN KEY (id_eventos_peajes) REFERENCES eventos_peajes (id_eventos_peajes)
    ON DELETE CASCADE,

  CONSTRAINT fk_de_id_evento_multa_multas FOREIGN KEY (id_evento_multas) REFERENCES eventos_multas (id_eventos_multas)
    ON DELETE CASCADE
);


CREATE TABLE pagos
(
  id_pagos       SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fecha          DATE                             NOT NULL,

  id_movimientos SMALLINT UNSIGNED,

  CONSTRAINT pk_id_pagos PRIMARY KEY (id_pagos),

  CONSTRAINT fk_de_id_movimientos FOREIGN KEY (id_movimientos) REFERENCES movimientos_cuentas_corrientes (id_movimientos)
    ON DELETE CASCADE
);


CREATE TABLE tarifas
(
  id_tarifas        SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,

  fecha_desde       DATE                             NOT NULL,

  fecha_asta        DATE,

  multa             FLOAT UNSIGNED                   NOT NULL,

  peaje_hora_normal DATE,

  peaje_hora_pico   DATE,

  CONSTRAINT pk_id_de_tarifas PRIMARY KEY (id_tarifas)
);
  
