## Desenvolva um programa para um mercado que permita:

- Cadastro dos produtos;
- Cadastro dos tipos de cada produto;
- Cadastro dos valores percentuais de imposto dos tipos de produtos;
- A tela de venda, onde serão informados os produtos e quantidades adquiridas;
- O sistema deve apresentar o valor de cada item multiplicado pela quantidade adquirida e a quantidade pago de imposto em cada item, um totalizador do valor da compra e um totalizador do valor dos impostos;
- A venda deverá ser salva;
  O sistema deverá ser desenvolvido utilizando:
- PHP 7.4 ou superior
- PostgreSQL ou MSSQL Server

### O sistema poderá ser desenvolvido utilizando:

- Bibliotecas frontend como Bootstrap e Material Design
- Frameworks de frontend como React, Angular e Vue (nesses casos já enviar o build)

Você deve usar o servidor nativo do PHP usando o comando php -S localhost:8080 na raiz web do
seu projeto, mas se precisarmos fazer alguma coisa além de iniciar o servidor, nos ensine como para
que possamos fazer o seu projeto funcionar corretamente.
Nesse desafio também queremos te incentivar a demonstrar seus conhecimentos técnicos além de
cumprir o objetivo inicial que é desenvolver sistema do mercado com as regras apresentadas, se
souber utilizar design patterns e/ou testes unitários nos mostre no código do mercado para que
possamos conhecer melhor suas habilidades.
Não queremos que você use um framework tipo o Laravel, Symfony, CodeIgniter porque eles
resolvem a grande parte dos problemas que gostaríamos de ver como que você resolve. Mas, se
quiser usar uma biblioteca ou outra para facilitar o desenvolvimento, não há problemas.

### Deverão ser enviados para análise:

- Repositório no GitHub com acesso público para clonarmos o seu projeto;
- O repositório deverá conter um README com as instruções para inicialização;
- O backup do banco de dados pode estar na raiz do repositório.
- Caso tenha feito deploy em algum servidor, enviar também a URL (não obrigatório)

### Dicas:

- Para exportar o banco use o comando pg_dump;
- Antes de nos enviar, faça um pg_restore para ver se foi tudo exportado como deveria.

This is a [Next.js](https://nextjs.org/) project bootstrapped with [`create-next-app`](https://github.com/vercel/next.js/tree/canary/packages/create-next-app).

## Getting Started

### Deployment in Production:

### Development server:

```bash
docker-compose up -d --build
composer install
cp .env.example .env
php console.php generate:key
alias migrations='./vendor/bin/doctrine-migrations'
migrations migrate
php console.php db:seed
php -S localhost:8080
```

Open [http://localhost:8080](http://localhost:8080) with your browser to see the result.

## FRONT

Open [https://github.com/diones-souza/test-next-soft-expert](https://github.com/diones-souza/test-next-soft-expert)
