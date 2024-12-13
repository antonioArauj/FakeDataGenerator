# FakeDataGenerator

Este projeto tem como objetivo gerar arquivos CSV com dados falsos para simulação de usuários, endereços e recargas. É útil para testes de sistemas, desenvolvimento e automação de processos em ambientes de testes.

## Estrutura do Projeto

O projeto contém três scripts principais:

1. **users.php**: Gera um arquivo CSV com dados de usuários fictícios.
2. **address.php**: Gera um arquivo CSV com dados de endereços fictícios associados a cada usuário.
3. **recargas.php**: Gera um arquivo CSV com dados de recargas de celular associadas aos usuários.

Além disso, o projeto utiliza a biblioteca **Faker** para a geração de dados aleatórios.

## Pré-requisitos

- PHP 7.4 ou superior
- Composer para gerenciamento de dependências

## Instalação

1. Clone o repositório para sua máquina local:

   ```bash
   git clone git@github.com:antonioArauj/FakeGeneretorData.git
   ```

2. Navegue até o diretório do projeto:

   ```bash
   cd FakeDataGenerator
   ```

3. Instale as dependências usando o Composer:

   ```bash
   composer install
   ```

   Isso irá baixar e instalar a biblioteca **Faker**, que é utilizada para gerar os dados aleatórios.

   Caso você ainda não tenha o Composer instalado, siga as instruções no site oficial: [https://getcomposer.org/download/](https://getcomposer.org/download/)

4. Instale o **Faker** via Composer (se você não o tiver instalado anteriormente):

   ```bash
   composer require fzaninotto/faker
   ```

## Como Usar

### Gerar Arquivo de Usuários

Para gerar o arquivo `users-fake.csv` com dados de usuários fictícios, execute o script `users.php`:

```bash
php users.php
```

Isso irá gerar um arquivo CSV com os seguintes campos:

- Nome Completo
- CPF
- Data de nascimento
- Gênero
- E-mail
- Número de Celular
- Código de indicação utilizado (sempre vazio neste caso)

### Gerar Arquivo de Endereços

Para gerar o arquivo `address-and-users-fake.csv` com dados de endereços fictícios, execute o script `address.php`:

```bash
php address.php
```

Este script cria endereços aleatórios para os usuários presentes no arquivo `users-fake.csv`. Os campos gerados incluem:

- Nome Completo
- CPF
- CEP
- Endereço Secundário
- Plus Code
- Número
- Estado
- Cidade
- Endereço Principal
- Se é favoritado ou não

### Gerar Arquivo de Recargas

Para gerar o arquivo `recargas-fake.csv` com dados de recargas de celular, execute o script `recargas.php`:

```bash
php recargas.php
```

Este script cria registros de recargas associadas aos usuários do arquivo `users-fake.csv`. Os campos gerados incluem:

- Nome Completo
- CPF
- Pedido Recarga (UUID)
- Número da Transação
- Status (FINISHED, PENDING, FAILED)
- Data e Hora do Pedido
- Forma de Pagamento (PIX, CREDIT_CARD, DEBIT_CARD)
- Total (valor inteiro)
- Celular Recarregado

## Exemplo de Saída

### users-fake.csv

```csv
Nome Completo;CPF;Data de nascimento;Genero;E-mail;Numero de Celular;Codigo de indicacao utilizado
João Silva;12345678901;12/03/1985;MALE;joao@email.com;9876543210;
```

### address-and-users-fake.csv

```csv
Nome Completo;CPF;CEP;Endereco Secundario;Plus Code;Numero;Estado;Cidade;Endereco Principal;Favoritado como
João Silva;12345678901;98765432;apartamento;;202;RJ;Rio de Janeiro;Avenida Teste;true
```

### recargas-fake.csv

```csv
Nome Completo;CPF;Pedido Recarga;Numero da Transacao;Status;Data e Hora do Pedido;Forma de Pagamento;Total;Celular Recarregado
João Silva;12345678901;d01a14bf-df13-4314-b5c4-c9d91fa6d1ab;572328123456;PENDING;2023-01-12 14:22:11 -0400;CREDIT_CARD;1000;9876543210
```

## Contribuindo

1. Faça um fork deste repositório.
2. Crie uma branch para suas alterações (`git checkout -b minha-branch`).
3. Faça commit das suas alterações (`git commit -am 'Adicionando nova funcionalidade'`).
4. Envie para o repositório remoto (`git push origin minha-branch`).
5. Abra um pull request.

## Contato

Caso tenha dúvidas, sugestões ou queira colaborar, entre em contato pelo e-mail: **antoniogaraujo63@email.com**.
