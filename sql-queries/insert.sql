INSERT INTO roles (descripcion)
VALUES
  ('developer'), ('empleado'), ('titular');

INSERT INTO usuarios (mail, pwd, id_roles)
VALUES
  ('ignaciocasales_nacho@hotmail.com', 'admin', '1'),
  ('dami_tano_95@hotmail.com', 'admin', '1'),
  ('davidddi.dn@gmail.com', 'navarroddi', '1'),
  ('empleado@dominio.com', 'empleado', '2'),
  ('ArnaldoSalazar@dominio.com', '123', '3'),
  ('FacundoLeiva@dominio.com', '123', '3'),
  ('KevinSoto@dominio.com', '123', '3'),
  ('YonathanSánchez@dominio.com', '123', '3'),
  ('LouisMolina@dominio.com', '123', '3'),
  ('DannyPérez@dominio.com', '123', '3'),
  ('NehemíasTapia@dominio.com', '123', '3'),
  ('JoshuaGutiérrez@dominio.com', '123', '3'),
  ('BastíanCampos@dominio.com', '123', '3'),
  ('MathíasReyes@dominio.com', '123', '3'),
  ('KarimCarvajal@dominio.com', '123', '3');

INSERT INTO titulares (id_usuarios, dni, nombre, apellido, telefono)
VALUES
  ('5', '38831250', 'Arnaldo', 'Salazar', '555-551'),
  ('6', '40301023', 'Facundo', 'Leiva', '555-552'),
  ('7', '39301023', 'Kevin', 'Soto', '555-553'),
  ('8', '35351623', 'Yonathan', 'Sánchez', '555-554'),
  ('9', '21999292', 'Louis', 'Molina', '555-555'),
  ('10', '29301000', 'Danny', 'Pérez', '555-556'),
  ('11', '19399923', 'Nehemías', 'Tapia', '555-557'),
  ('12', '33301243', 'Joshua', 'Gutiérrez', '555-558'),
  ('13', '35301443', 'Bastían', 'Campos', '555-559'),
  ('14', '22333153', 'Mathías', 'Reyes', '555-560'),
  ('15', '28111253', 'Karim', 'Carvajal', '555-561');

INSERT INTO vehiculos (id_titulares, dominio, marca, modelo, qr)
VALUES
  ('1', 'ark-230', 'Renault', 'Twingo', 'ark-2302'),
  ('1', 'grv-799', 'Peugeot', '206', 'grv-799'),
  ('2', 'ab-012-kr', 'Volkswagen', 'Vento', 'ab-012-kr'),
  ('2', 'ith-256', 'Volkswagen', 'Bora', 'ith-256'),
  ('3', 'epk-713', 'Volkswagen', 'Caddy', 'epk-713'),
  ('4', 'aa-404-ky', 'Chevrolet', 'Classic', 'aa-404-ky'),
  ('4', 'lou-765', 'Peugeot', 'Partner', 'lou-765'),
  ('5', 'lor-321', 'Volkswagen', 'Bora', 'lor-321'),
  ('6', 'fgt-564', 'Renault', 'Clio', 'fgt-564'),
  ('6', 'hnk-125', 'Peugeot', '406', 'hnk-125'),
  ('7', 'kfl-456', 'Nissan', '370z', 'kfl-456'),
  ('7', 'jkl-876', 'Mitsubishi', 'Evolution', 'jkl-876'),
  ('8', 'dlk-311', 'Toyota', 'Hilux', 'dlk-311'),
  ('8', 'aak-111', 'Audi', 'a3', 'aak-111'),
  ('9', 'aa-123-ky', 'Toyota', 'Etios', 'aa-123-ky'),
  ('10', 'aa-675-kb', 'Audi', 'a6', 'aa-675-kb'),
  ('10', 'aa-434-rk', 'Ford', 'Mondeo', 'aa-434-rk'),
  ('11', 'lkl-123', 'Ford', 'Focus', 'lkl-123');


INSERT INTO tarifas (fecha_desde, fecha_hasta, multa, peaje_hora_normal, peaje_hora_pico)
VALUES
  ('2016-11-01', '2016-11-27', '1000', '10', '25'),
  ('2016-11-28', '2016-11-28', '1000', '8', '8'),
  ('2016-11-29', '2016-12-7', '1000', '10', '25'),
  ('2016-12-8', '2016-12-9', '1000', '8', '8'),
  ('2016-12-10', '2016-12-24', '1000', '10', '25'),
  ('2016-12-25', '2016-12-25', '1000', '8', '8'),
  ('2016-12-26', '2016-12-31', '1000', '10', '25');


INSERT INTO cuentas_corrientes (fecha_ultima_actualizacion, maximo_credito, saldo, id_vehiculos)
VALUES
  ('2015-04-10 10:30:13', '2000', '200', '1'),
  ('2015-04-10 10:30:13', '2000', '200', '2'),
  ('2015-01-14 08:08:23', '1500', '400', '3'),
  ('2015-01-14 08:08:23', '1500', '400', '4'),
  ('2015-09-20 14:35:00', '3300', '200', '5'),
  ('2015-04-10 07:55:10', '1900', '500', '6'),
  ('2015-04-10 07:55:10', '1900', '500', '7'),
  ('2015-05-10 12:00:55', '1200', '350', '8'),
  ('2015-06-10 10:30:04', '2300', '300', '9'),
  ('2015-06-10 10:30:04', '2300', '300', '10'),
  ('2015-07-10 10:11:13', '2600', '550', '11'),
  ('2015-07-10 10:11:13', '2600', '550', '12'),
  ('2015-09-22 09:30:13', '4200', '500', '13'),
  ('2015-09-22 09:30:13', '4200', '500', '14'),
  ('2015-09-17 12:00:33', '1000', '200', '15'),
  ('2015-10-10 10:30:13', '1950', '300', '16'),
  ('2015-10-10 10:30:13', '1950', '300', '17'),
  ('2015-12-21 08:17:23', '1050', '330', '18');


INSERT INTO sensores (fecha_alta, latitud, longitud, numeros_serie)
VALUES
  ('2015-01-01', '-38.05261', '-57.56142', '399912354'),
  ('2015-01-10', '-38.06079', '-57.57120', '333312354'),
  ('2015-01-22', '-38.04470', '-57.57180', '393432354'),
  ('2015-01-28', '-38.22261', '-53.52142', '499912354'),
  ('2015-02-02', '-33.03261', '-53.53142', '565612354'),
  ('2015-02-08', '-34.03461', '-55.56142', '699464354'),
  ('2015-02-13', '-38.25261', '-55.56122', '797465735'),
  ('2015-02-19', '-34.04261', '-47.46132', '394563227'),
  ('2015-03-25', '-38.55261', '-77.56142', '399456454'),
  ('2015-03-26', '-18.05261', '-17.56143', '411111114'),
  ('2015-04-29', '-35.05251', '-23.26144', '321312124'),
  ('2015-05-12', '-22.22261', '-32.33142', '312312312'),
  ('2015-05-15', '-14.75787', '-23.54562', '123231211'),
  ('2015-05-17', '-18.56261', '-34.56142', '555323131'),
  ('2016-01-19', '-23.43269', '-57.23446', '324324324'),
  ('2016-01-11', '-41.25769', '-56.56562', '664534121'),
  ('2016-02-16', '-23.05668', '-87.67632', '767876556'),
  ('2016-03-01', '-58.35961', '-86.35412', '654567890'),
  ('2016-04-15', '-38.35263', '-44.43432', '098765432'),
  ('2016-06-22', '-68.85261', '-33.12357', '345678876'),
  ('2016-06-22', '-68.59961', '-23.23574', '123456123'),
  ('2016-06-29', '-38.85991', '-33.23467', '457634110'),
  ('2016-07-30', '-66.05551', '-44.23567', '005434565'),
  ('2016-07-30', '-45.65641', '-36.54354', '232454577'),
  ('2016-08-18', '-65.45661', '-56.53455', '777645634'),
  ('2016-09-22', '-98.55661', '-89.34590', '465413456'),
  ('2016-09-22', '-68.55555', '-90.45789', '457645321');


INSERT INTO tipos_sensores (descripcion)
VALUES
  ('Peaje'),
  ('Multa');


INSERT INTO tipos_eventos (descripcion)
VALUES
  ('multa'),
  ('peaje');


INSERT INTO modelos_marcas (modelos, marcas)
VALUES
  ('ford', 'focus'),
  ('ford', 'fiesta'),
  ('ford', 'fiesta-exe'),
  ('ford', 'taunus'),
  ('ford', 'falcon'),
  ('ford', 'mondeo'),
  ('ford', 'escort'),
  ('ford', 'sierra'),
  ('ford', 'ka'),
  ('audi', 'a1'),
  ('audi', 'a3'),
  ('audi', 'a5'),
  ('audi', 'a6'),
  ('audi', 'a7'),
  ('audi', 'a8'),
  ('audi', 'q2'),
  ('audi', 'q3'),
  ('audi', 'q7'),
  ('audi', 'tt'),
  ('hyundai', 'alentra'),
  ('hyundai', 'i40'),
  ('hyundai', 'loniq'),
  ('hyundai', 'ix20'),
  ('hyundai', 'tucson'),
  ('hyundai', 'veloster'),
  ('hyundai', 'santa fe'),
  ('chevrolet', 'corsa'),
  ('chevrolet', 'classic'),
  ('chevrolet', 'corsa classic'),
  ('chevrolet', 'agile'),
  ('chevrolet', 'camaro'),
  ('chevrolet', 'captiva'),
  ('chevrolet', 'cruze'),
  ('chevrolet', 'cobalt'),
  ('chevrolet', 'montana'),
  ('chevrolet', 'onix'),
  ('chevrolet', 's10'),
  ('chevrolet', 'sonic'),
  ('nissan', '370z'),
  ('nissan', 'micra'),
  ('nissan', 'navara'),
  ('nissan', 'note'),
  ('nissan', 'pulsar'),
  ('mitsubishi', 'l-200'),
  ('mitsubishi', 'montero'),
  ('mitsubishi', 'autlander'),
  ('mitsubishi', 'lancer'),
  ('mitsubishi', 'evolution'),
  ('volvo', 's60'),
  ('volvo', 's90'),
  ('volvo', 'v40'),
  ('volvo', 'v60'),
  ('volvo', 'v90'),
  ('volvo', 'xc60'),
  ('honda', 'civic'),
  ('honda', 'cr-v'),
  ('honda', 'hr-v'),
  ('honda', 'jass'),
  ('honda', 'nsx'),
  ('honda', 'citi'),
  ('suzuki', 'beleno'),
  ('suzuki', 'celerio'),
  ('suzuki', 's-cross'),
  ('suzuki', 'swift'),
  ('suzuki', 'vitara'),
  ('toyota', 'prius'),
  ('toyota', 'hilux'),
  ('toyota', 'verso'),
  ('toyota', 'corrolla'),
  ('toyota', 'etios'),
  ('renault', 'kangoo'),
  ('renault', 'twingo'),
  ('renault', 'clio'),
  ('renault', 'sandero'),
  ('renault', 'duster'),
  ('peugeot', '207'),
  ('peugeot', '206'),
  ('peugeot', '308'),
  ('peugeot', 'patner'),
  ('peugeot', '508'),
  ('peugeot', '505'),
  ('peugeot', '504'),
  ('peugeot', '405'),
  ('peugeot', '406'),
  ('fiat', '600'),
  ('fiat', 'duna'),
  ('fiat', 'siena'),
  ('fiat', '500'),
  ('fiat', 'palio'),
  ('fiat', 'punto'),
  ('fiat', '147'),
  ('fiat', '128'),
  ('fiat', 'uno'),
  ('fiat', 'doblo'),
  ('fiat', 'idea'),
  ('volkswagen', 'bora'),
  ('volkswagen', 'vento'),
  ('volkswagen', 'pasat'),
  ('volkswagen', 'gol'),
  ('volkswagen', 'gol-tend'),
  ('volkswagen', 'golf'),
  ('volkswagen', 'caddy'),
  ('volkswagen', 'pointer'),
  ('volkswagen', 'polo'),
  ('volkswagen', 'up'),
  ('volkswagen', 'tiguan');
  
  

  
