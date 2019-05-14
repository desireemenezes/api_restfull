CREATE TABLE produto (
    id SERIAL PRIMARY KEY NOT NULL,
    nome VARCHAR(30) NOT NULL,
    preco NUMERIC(10,2) NOT NULL,
    descricao VARCHAR(300) NOT NULL

);

create table usuario (
    id serial NOT NULL PRIMARY KEY,
    nome character varying(30) NOT NULL,
    login character varying(30) NOT NULL,
    senha character varying(30) NOT NULL
);

        
CREATE TABLE itemsacola (
    id serial NOT NULL PRIMARY KEY,
    data_compra DATE not NULL,
    cod_prod INTEGER NOT NULL,
    cod_cli INTEGER NOT NULL,
FOREIGN KEY(cod_prod)
    REFERENCES PRODUTO(id),
FOREIGN KEY(cod_cli)
    REFERENCES USUARIO(id)
);

