# tci-tech-test

Crie o banco de dados (MySQL) com o seguinte código:

```
create database contacts_app;
       
use contacts_app;

create table contacts(
    id bigint unsigned auto_increment
    ,name varchar(255) not null unique
    ,alias varchar(55) not null
    ,document varchar(11) not null unique
    ,phone varchar(55) not null unique
    ,email varchar(255) not null unique
    ,created_at timestamp default current_timestamp
    ,updated_at timestamp
    ,primary key(id)
);
```

Instale as dependências do projeto
```
composer update
```
 
Inicie o backend via terminal com o código: 
``` 
php -S 127.0.0.1:3000
```

Acesse 
```
127.0.0.1:3000/contacts/
```
