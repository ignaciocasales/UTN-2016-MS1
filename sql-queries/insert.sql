INSERT INTO roles (descripcion)
VALUES ('testing'), ('empleado'), ('titular');

INSERT INTO usuarios (mail, pwd, id_roles)
VALUES
  ('ignaciocasales@hotmail.com', MD5('admin'), '1'),
  ('dami@mail.com', MD5('admin'), '1'),
  ('davidddi@gmail.com', MD5('navarroddi'), '1'),
  ('empleado@dominio.com', MD5('empleado'), '2'),
  ('titular@dominio.com', MD5('titular'), '3');