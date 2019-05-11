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

