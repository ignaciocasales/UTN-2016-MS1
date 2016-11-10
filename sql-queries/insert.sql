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

