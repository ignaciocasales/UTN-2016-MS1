
INSERT INTO roles (descripcion)
VALUES ('developer'), ('empleado'), ('titular');

INSERT INTO usuarios (mail, pwd, id_roles)
VALUES
  ('ignaciocasales_nacho@hotmail.com', 'admin', '1'),
  ('dami_tano_95@hotmail.com', 'admin', '1'),
  ('davidddi.dn@gmail.com', 'navarroddi', '1'),
  ('empleado@dominio.com', 'empleado', '2'),
  ('titular@dominio.com', 'titular', '3'),
  ('cesilia37@hotmail.com','titular','3'),
  ('nacho_perez@hotmail.com','titular','3'),
  ('ezequiel_navarro@hotmail.com','titular','3'),
  ('josefa_fernandez@hotmail.com','titular','3'),
  ('matiasestrasa@gmail.com','titular','3'),
  ('lautaro_diaz','titular','3'),
  ('esteban.gonzales@gmail.com','titular','3'),
  ('natalia_nati_paolini@hotmail.com','titular','3'),
  ('agustin_del_bosque@gmail.con','titular','3'),
  ('nasarena_gusman@gmail.com','titular','3');
  
INSERT INTO titulares(id_usuarios, dni, nombre, apellido, telefono) VALUES 
  ('5','38831250','titu','lar','477-5998'),
  ('6','40301023','casales','ignacio','485-0146'),
  ('7','39301023','nacho','perez','475-1048'),
  ('8','35351623','ezequiel','navarro','489-2564'),
  ('9','21999292','josefa','fernandez','449-2308'),
  ('10','29301000','matias','estrasa','155-289311'),
  ('11','19399923','lautaro','diaz','156-840123'),
  ('12','33301243','esteban','gonzales','154-003214'),
  ('13','35301443','natalia','paolini','478-1090'),
  ('14','22333153','agustin','bosque','455-3021'),
  ('15','28111253','nasarena','gusman','467-3611');

INSERT INTO vehiculos(id_titulares,dominio,marca,modelo,qr) VALUES
('1','ark-230','renault','twingo','ark-2302'),
('1','grv-799','peugot','206','grv-799'),
('2','ab-012-kr','wolsvagen','vento','ab-012-kr'),
('2','ith-256','wolsvagen','bora','ith-256'),
('3','epk-713','wolsvagen','caddy','epk-713'),
('4','aa-404-ky','chevrolet','classic','aa-404-ky'),
('4','lou-765','peugeot','patner','lou-765'),
('5','lor-321','wolsvagen','bora','lor-321'),
('6','fgt-564','renault','clio','fgt-564'),
('6','hnk-125','peugeot','406','hnk-125'),
('7','kfl-456','nissan','370z','kfl-456'),
('7','jkl-876','mitsubishi','evolution','jkl-876'),
('8','dlk-311','toyota','hilux','dlk-311'),
('8','aak-111','audi','a3','aak-111'),
('9','aa-123-ky','toyota','etios','aa-123-ky'),
('10','aa-675-kb','audi','a6','aa-675-kb'),
('10','aa-434-rk','ford','mondeo','aa-434-rk'),
('11','lkl-123','ford','focus-exe','lkl-123');


INSERT INTO tarifas
(fecha_desde, fecha_asta, multa, peaje_hora_normal, peaje_hora_pico) VALUES 
('2014-12-28', '2015-01-01', '10', '07:00:00', '11:00:00'),
('2015-01-01', '2015-05-10', '14', '09:30:00', '12:00:00'),
('2015-05-10', '2015-08-22', '16', '012:00:00','14:30:00'),
('2015-08-22', '2016-12-01', '16', '08:00:00', '16:00:00'),
('2016-12-01', '2016-02-09', '18', '10:00:00', '15:00:00'),
('2016-02-09', '2016-04-17', '20', '05:00:00', '09:30:00'),
('2016-04-17', '2016-08-01', '22', '07:30:00', '15:18:00'),
('2016-08-01', '2016-11-05', '28', '06:00:00', '15:44:00'),
('2016-11-05', '2017-01-15', '30', '02:00:00', '06:33:00'),
('2017-01-15', '2017-04-02', '31', '010:14:00','13:25:00'),
('2017-04-02', '2017-07-19', '33', '04:00:00', '06:12:00'),
('2017-07-19', '2017-12-23', '35', '01:00:00', '05:18:00');


INSERT INTO cuentas_corrientes 
(fecha_ultima_actualizacion, maximo_credito, saldo, id_vehiculos) VALUES
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


