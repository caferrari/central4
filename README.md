# Central 4
[![Build Status](https://travis-ci.org/secom-tocantins/central4.png?branch=develop)](https://travis-ci.org/secom-tocantins/central4) [![Coverage Status](https://coveralls.io/repos/secom-tocantins/central4/badge.png?branch=develop)](https://coveralls.io/r/secom-tocantins/central4?branch=develop)

CMS do Governo do Tocantins

## Dependências

Este projeto possui as seguintes dependências:

 * Postgres >= 9.1
 * PHP >= 5.4
 * Git

## Configurando uma maquina para desenvolvimento no Ubuntu

Instale as dependências:

```sh
sudo apt-get install postgresql php5-cli php5-curl php5-pgsql php5-intl curl git
```

### Configuração do Postgres

Edite o arquivo

```sh
sudo nano /etc/postgresql/9.1/main/pg_hba.conf
```

Na linha que contêm o seguinte host:

```sh
host    all             all             127.0.0.1/32            md5
```

Altere o md5 para trust, ficando assim:

```sh
host    all             all             127.0.0.1/32            trust
```

Em seguida reinicie o postgres

```sh
sudo service postgresql restart
```


### Instalando o projeto

Clone o projeto do github para sua maquina:

```sh
git clone git://github.com/secom-tocantins/central4.git
```

Agora entramos na pasta do projeto utilizamos o make para configurar tudo

```sh
cd central4
make setup
```

Aguarde o composer atualizar e instalar as dependências e estará tudo pronto.

### Para rodar o projeto com o servidor built-in do php, use o comando:

```sh
make server
```

