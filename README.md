# Voar Mais Alto

Projeto da PAP (Prova de Aptidão Profissional) do Curso Profissional de Técnico de Gestão e Programação de Sistemas Informáticos.

- **Escola:** Escola Secundária José Saramago, Mafra
- **Ano letivo:** 2020/2021
- **Aluno:** Tiago Cabaça, nº21, PI3
- **Professor orientador:** Marco Silva

![Página inicial](docs/screenshots/pagina-index-parte-1.png)

## Sobre o projeto

O Voar Mais Alto é o site de uma agência de viagens. A ideia surgiu durante a pandemia, numa altura em que quase não se podia viajar.

No site qualquer pessoa pode ver as viagens disponíveis e os detalhes de cada uma. Quem tiver conta pode reservar uma viagem, escolhendo as datas, o número de quartos, adultos e crianças, e passar para o pagamento.

O administrador tem um backoffice onde gere as viagens, os destinos e os utilizadores e vê as vendas.

## Funcionalidades

**Site**

- Página inicial com as últimas viagens
- Lista de viagens com filtro por destino
- Página de detalhes de cada viagem
- Páginas de serviços e sobre nós, com formulário de contacto
- Registo e login
- Reserva de viagens (datas, quartos, adultos e crianças)
- Pagamento por cartão, PayPal ou transferência bancária (é só uma simulação, não é feito nenhum pagamento)

**Backoffice**

- Adicionar, alterar e eliminar viagens (com imagem)
- Adicionar, alterar e eliminar destinos
- Adicionar e listar utilizadores
- Lista das viagens vendidas

## Feito com

- PHP
- MySQL
- HTML, CSS e JavaScript
- Bootstrap e jQuery
- XAMPP

## Como usar

1. Instalar o XAMPP e ligar o Apache e o MySQL
2. Copiar a pasta do projeto para `C:\xampp\htdocs\voar-mais-alto`
3. Abrir o phpMyAdmin (http://localhost/phpmyadmin) e importar o ficheiro `db/bd_voarmaisalto.sql`
4. Abrir no browser http://localhost/voar-mais-alto

A ligação à base de dados está no ficheiro `db/config.php` (utilizador `root` sem password, como vem no XAMPP).

**Contas para testar**

| Tipo | Email | Password |
|---|---|---|
| Administrador | admin@voarmaisalto.pt | admin |
| Cliente | ana.ferreira@example.com | teste123 |

Todos os outros clientes da base de dados também têm a password `teste123`.

## Base de dados

A base de dados chama-se `bd_voarmaisalto` e tem 4 tabelas:

- **login**: os utilizadores (clientes e administradores)
- **categoria**: os destinos
- **produto**: as viagens (nome, descrição, preço, stock, imagem e destino)
- **carrinho**: as reservas feitas pelos clientes

![Base de dados](docs/screenshots/base-de-dados-relacoes-entre-as-tabelas.png)

## Pastas

```
admin/        páginas do backoffice
admin/img_produtos/   imagens das viagens
assets/       template (css, js, imagens)
css/          css das páginas
db/           ligação e ficheiro da base de dados
forms/        formulário de contacto
vendor/       Bootstrap e jQuery
```

## Imagens

**Viagens**

![Viagens](docs/screenshots/pagina-viagens.png)

**Detalhes da viagem**

![Detalhes da viagem](docs/screenshots/pagina-sobre-os-detalhes-da-viagem.png)

**Reserva**

![Reserva](docs/screenshots/pagina-dos-detalhes-da-reserva.png)

**Pagamento**

![Pagamento](docs/screenshots/pagina-do-pagamento.png)

**Backoffice**

![Backoffice](docs/screenshots/backoffice-produtos.png)

## Créditos

- Template do site baseado em templates gratuitos da BootstrapMade e da Start Bootstrap
- Imagens do Unsplash, Pixabay e Pexels
- Ícones do Flaticon e do Font Awesome
