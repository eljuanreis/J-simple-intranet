# J-Simple Intranet
## _Uma Intranet desenvolvida com Laravel_

[![Laravel](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)](https://laravel.com/)

## Recursos (Features)
- Sistema de autenticação 
- Cadastro/edição/exclusão de departamentos
- Cadastro/edição/exclusão de usuários
- Relacionamento de usuários com departamentos
- Edição do próprio perfil


> Foi pensando em facilitar a vida do administrador e também demonstrar a facilidade que o framework Laravel nos fornece no desenvolvimento Web que elaborei este projeto p/ um processo seletivo -
 _Juan Reis_

## Tecnologias

As tecnologias usaadas nas construção do sistema

- Bootstrap 5.1 - Para estilização do front-end
- Jquery - Para elaboração de requisições assíncronas (AJAX)
- Laravel 8 - Para elaboração de todo sistema

## Instalação e execução

- Requisitos: Composer/Laravel 8/PHP (>= PHP 7.4.22)
1. Clone o repositório usando: git clone

2. Instale as dependências utilizando o: `composer install` (dentro da pasta do projeto)

3. Crie um banco de dados e faça a configuração de acesso ao banco de dados no arquivo .env (variáveis de ambiente)

4. Acesse o projeto via terminal/console e use o: `php artisan migrate` para geração das tabelas dentro do banco de dados

5. Acesse o projeto via terminal/console e use o: `php artisan db:seed` para geração dos usuários iniciais.

##### Usuários iniciais:
- Administrador
###### E-mail: juan@gmail.com - Senha: 123456

- Membro
###### E-mail: userinicial@gmail.com - Senha: 123456

## Licença

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

