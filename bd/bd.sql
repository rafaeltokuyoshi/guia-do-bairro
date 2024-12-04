-- Criação da tabela 'usuarios'
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  sobrenome VARCHAR(100) NOT NULL,
  senha VARCHAR(255) NOT NULL,
  email VARCHAR(40) UNIQUE NOT NULL,
  tipoac VARCHAR(15)
);
CREATE TABLE empresas (
    id_empresas INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    tel_numero VARCHAR(15),
    wpp_numero VARCHAR(15),
    instagram VARCHAR(100),
    facebook VARCHAR(100),
    categoria varchar(100),
    destaque varchar (50)
);
CREATE TABLE endereco (
    id_endereco INT AUTO_INCREMENT PRIMARY KEY,
    rua VARCHAR(100) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    cidade VARCHAR(50) NOT NULL,
    estado VARCHAR(50) NOT NULL,
    numero VARCHAR(10),
    complemento VARCHAR(100),
    cep VARCHAR(10) NOT NULL,
    id_empresas INT,
    FOREIGN KEY (id_empresas) REFERENCES empresas(id_empresas)
);

CREATE TABLE fotos_empresas (
  id_foto INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  path VARCHAR(255) NOT NULL,
  data_upload DATE NOT NULL,
  id_empresas INT,
  FOREIGN KEY (id_empresas) REFERENCES empresas(id_empresas)
);

CREATE TABLE categoriaEmp (
	id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nomeCategoria varchar (200)
);

CREATE TABLE fotos_site(
  id_foto INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  path VARCHAR(255) NOT NULL,
  lugar varchar(100)NOT NULL,
  data_upload DATE NOT NULL
);