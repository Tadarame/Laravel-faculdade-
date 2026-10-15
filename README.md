# ES & TADS - 2026

Projeto exclusivo para uso didático na disciplina de **Programação Orientada a Objetos para Web (POO-WEB)** dos cursos:
- **Engenharia de Software (ES)**
- **Tecnologia em Análise e Desenvolvimento de Sistemas (TADS)**.

# Setup

## Download

Download do projeto completo

```sh
git clone git@github.com:cjchamado/tads-es-2026-poo-web.git poo-web
```

## Up

Subir os containers de serviços

```sh
cd poo-web
```

**EXECUTE APENAS UM DOS COMANDOS ABAIXO**

**Opção 1 (verbose):**
> Execute este comando na primeira execução, este formato permite que você analise se tudo está OK.

```sh
docker compose up --build
```

**Opção 2 (background):**
> Para garantir que tudo está OK, utilize este formato somente depois da primeira vez que rodar os containers.

```sh
docker compose up --build -d
```

## Check

Verificar se tudo está online (OK)

```sh
docker ps | grep poo_web
```
> Uma lista de containers em execução deve ser exibida após o comando.

## API (Laravel)

1. Acessar o container do php para execução dos comandos do laravel (artisan).

```sh
docker exec -it poo_web_php bash
```

2. Instalar as dependências
> Apenas a primeira vez ou quando novas dependências forem adicionadas

```sh
composer install
```

3. Configurar o arquivo de variáveis de ambiente (.env)
> As configurações básicas já estão definidas

```sh
cp .env.example .env
```

4. Gerar chave secreta da aplicação

```sh
php artisan key:generate
```

5. Inicializar migrations

```sh
php artisan migrate
```

## WEB (Quasar)

1. Acessar o container do quasar para execução dos comandos para web.

```sh
docker exec -it poo_web_quasar bash
```

2. Instalar as dependências
> Apenas a primeira vez ou quando novas dependências forem adicionadas

```sh
npm install
```

3. Executar a aplicação

```sh
quasar dev
```

# Acesso aos recursos web:

- [**phpMyAdmin** - http://localhost:8184](http://localhost:8184)
- [**API** - http://localhost:8182](http://localhost:8182)
- [**WEB** - http://localhost:9010](http://localhost:9010)

# Versionamento (Git / GitHub)

Após a execução bem sucedida dos passos acima, serão passadas instruções para que cada aluno faça o apontamento correto do projeto para seu repositório individual.
