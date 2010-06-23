/* Desenvolvido em 13 de maio de 2010 - Povoamento do Banco CICCOL */

/* Povoamento da tabela TipoUsuario(id_tpuser, tipo) */
INSERT INTO TipoUsuario(id_tpuser, tipo) VALUES (1, 'Administrador');
INSERT INTO TipoUsuario(id_tpuser, tipo) VALUES (2, 'Moderador');
INSERT INTO TipoUsuario(id_tpuser, tipo) VALUES (3, 'Docente');
INSERT INTO TipoUsuario(id_tpuser, tipo) VALUES (4, 'Aluno');

/* Usuário Padrão */
INSERT INTO Usuario(cpf, nome) VALUES ('root', 'root');
INSERT INTO Autenticacao(identificador, senha, id_user, id_tpuser) VALUES ('root', '202cb962ac59075b964b07152d234b70', 1, 1);


