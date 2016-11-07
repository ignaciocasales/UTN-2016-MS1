INSERT INTO roles (descripcion)
VALUES ('developer'), ('empleado'), ('titular');

INSERT INTO usuarios (mail, pwd, id_roles)
VALUES
  ('ignaciocasales_nacho@hotmail.com', 'admin', '1'),
  ('dami@mail.com', 'admin', '1'),
  ('davidddi@gmail.com', 'navarroddi', '1'),
  ('empleado@dominio.com', 'empleado', '2'),
  ('titular@dominio.com', 'titular', '3');