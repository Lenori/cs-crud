## Instalação

Por favor, confira a documntação oficial do Laravel antes de iniciar sua instalação. [Documentação oficial](https://laravel.com/docs/5.4/installation#installation)

Clone o respositório

    git clone https://github.com/Lenori/cs-crud

Entre na pasta do repositório

    cd cs-crud

Instale todas as dependências usando o composer

    composer install

Faça uma cópia do arquivo de exemplo env e faça as configurações necessárias de conexão ao MySql (DB_HOST, DB_USERNAME, DB_PASSWORD & DB_DATABASE)

    cp .env.example .env

Execute as migrations do banco de dados (**Configure a conexão antes de fazer a migration**)

    php artisan migrate

Inicie seu servidor

    php artisan serve
	
## Usando o sistema

A url /produtos é o seu ponto de partida. Lá você vai poder criar novos produtos e comprar caso os mesmos tenham estoque suficiente.

Nesta mesma tela você vai poder editar e excluir os pedidos existentes no seu banco de dados.