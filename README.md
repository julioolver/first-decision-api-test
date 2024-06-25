# Projeto para teste - First Decision PHP/Laravel API REST

Este repositório contém uma API desenvolvida em Laravel para gerenciamento de usuários. A API inclui operações de CRUD (Create, Read, Update, Delete) e foi criada utilizando boas práticas de desenvolvimento e testes.

Este projeto segue as melhores práticas de design e arquitetura de software, aplicando SOLID, clean code, calistenia de objetos, entre outros conceitos e patterns conhecidos.

O projeto utiliza um padrão de design com Services e Repositories para abstrair a lógica de negócios e a camada de acesso a dados. Além disso, conta com FormRequest, Resource, Contacts/Interfaces e testes unitários e de feature.

## Tecnologias Utilizadas

- **Laravel**: Framework PHP para construção de aplicações web.
- **PHP**: Linguagem de programação utilizada.
- **Docker**: Ferramenta de contêinerização.
- **PostgreSQL**: Banco de dados utilizado.
- **Vue 3**: Framework JavaScript para construção da interface.
- **Vuetify**: Biblioteca de componentes UI para Vue.

## Pré-requisitos

- Docker
- Docker Compose


## Estrutura do Projeto

O projeto se encontra dentro da pasta `Src`, foi feito desta maneira para sepagar o Docker (infra) da aplicação. Dentro do diretório App, o projeto inclui:

-   **Services**: Contém a lógica de negócios e as regras da aplicação.
-   **Repositories**: Fornece uma camada de abstração sobre o acesso a dados, permitindo uma maneira mais flexível de interagir com o banco de dados. Também, existe no diretório os contracts (interfaces).
-   **Config**: Diretório para arquivos de configuração da aplicação.

## Configuração e Instalação

A seguir, passo a passo para rodar o sistema em ambiente local.

### Pré-requisitos

Instruções para configurar e instalar o projeto:

-   Docker configurado no sistema operacional

-   Fazer uma cópia do .env.exemple para .env

### Instalação

Para emular o ambiente de desenvolvimento, foi utilizado o Docker e Docker-compose.

Rodar dentro da raiz do repositório (não precisa acessar a pasta src, no docker já deixei mapeado a pasta src para subir a aplicação)

```
docker-compose up --build -d
```

Caso seja necessário instalar as dependências novamente:

```
docker exec laravel-app sh
```

Após isso, o sistema se torna acessível via:

`http://localhost:8088`

## Rodar documentação da API

Para o projeto, foi realizada a documentação das rotas com o Swagger UI.

Acesse a seguinte URL para ter acesso a documentação:

`http://localhost:8088/api/documentation/`

## Rodando os testes

Para rodar os testes criados, basta executar:

```
docker exec laravel-app sh
```

```
php artisan test
```
## Front-end

Por se tratar de uma API REST, o Front-end foi desenvolvido em outro repositório, separando a responsabilidade de ambos:

[Github Front-End](https://github.com/julioolver/first-decision-front-end-test)


## TODO

Deixo anotado aqui, com um TODO para ser feito ainda dentro deste projeto:

-   Adicionar no Swagger para documentação os erros que a API poderá retornar

## Autores

-   **Julio Cesar Oliveira da Silva**
