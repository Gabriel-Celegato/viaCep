GRUPO: Gabriel Henrique, Miguel Manochio e João Cruz.

CEP Consulta
Sistema web que consome a API do ViaCEP permitindo consultar endereços, salvar no banco de dados e executar operações de deleção.

Funcionalidades
Buscar endereço por CEP através da API ViaCEP

Salvar endereços automaticamente no banco de dados

Listar todos os endereços salvos

Deletar endereços cadastrados

Validação de formato de CEP

Tratamento de erros para CEPs inválidos

Tecnologias utilizadas
PHP com PDO

MySQL

HTML5 e CSS3

JavaScript com Fetch API

Estrutura do Projeto
CepConsulta/
├── Controller/
│   └── BuscarCep.php
│   └── CepAPI.php
│   └── EnderecoApi.php
│   └── EnderecoPost.php
├── imagens/
├── Model/
│   ├── Conexao.php
│   └── Endereco.php
├── View/
│   ├── index.html
│   └── listagem.php
│   └── script.js
├── MySql.sql
└── README.md

Descrição dos diretórios
Controller: Responsável por receber as requisições, processar a lógica e retornar as respostas

Model: Gerencia a conexão com o banco de dados e as operações de CRUD

View: Contém a interface do usuário, páginas de exibição e scripts JavaScript responsáveis pela interação com o sistema.

MySql.sql: Script SQL para criação da tabela no banco de dados

Imagens: Armazena ícones e recursos visuais utilizados pela interface.

Como instalar e executar?

1 - Baixar o arquivo compactado cepConsulta.zip

2 - Extraia o arquivo CepConsulta

3 - Copie a pasta extraída

4 - Localize o diretório do XAMPP no seu computador

5 - Abra a pasta htdocs dentro do XAMPP

6 - Cole a pasta CepConsulta dentro de htdocs

7 - Inicie o XAMPP e ative os serviços Apache e MySQL

8 - Acesse o phpMyAdmin através do link http://localhost/phpmyadmin

9 - Crie um novo banco de dados com o nome pwiiib

10 - Abra o arquivo MySql.text localizado dentro da pasta do projeto

11 - Copie todo o conteúdo deste arquivo

12 - No phpMyAdmin, selecione o banco pwiiib

13 - Vá na aba SQL e cole o conteúdo copiado

14 - Execute o comando clicando no botão Executar

15 - No navegador, acesse http://localhost/cepConsulta/View/index.html

Como utilizar

Consultar um CEP:
Digite o CEP desejado no campo de busca (formato: 00000000 ou 00000-000)

Clique no botão "Consultar"

Os dados do endereço serão exibidos automaticamente

O endereço será salvo no banco de dados

Listar endereços salvos:
Após consultar alguns CEPs, a lista de endereços salvos será exibida automaticamente na parte inferior da página

Cada endereço aparecerá com suas informações completas

Deletar um endereço:
Na lista de endereços salvos, localize o endereço desejado

Clique no botão "Deletar" ao lado do endereço

O endereço será removido do banco de dados e a lista será atualizada automaticamente

CEPs para teste
01001000 - Praça da Sé, São Paulo

01310100 - Avenida Paulista, São Paulo

20040030 - Centro do Rio de Janeiro

22041001 - Praia de Copacabana, Rio de Janeiro

30140010 - Praça da Liberdade, Belo Horizonte

Tratamento de erros
CEP vazio: O sistema exibe mensagem solicitando um CEP válido

CEP inválido: O sistema informa que o formato do CEP está incorreto

CEP não encontrado: O sistema informa que o CEP não existe na base da API

Falha na API: O sistema tenta buscar no banco de dados local

Erro de conexão com banco: O sistema exibe mensagem de erro adequada

Observações importantes
O banco de dados deve ter o nome exato "pwiiib" conforme configurado no projeto

O arquivo MySql.text contém toda a estrutura da tabela necessária para o funcionamento

Certifique-se de que o XAMPP esteja com Apache e MySQL ativados antes de acessar o sistema

Caso ocorra erro de conexão, verifique se o MySQL está rodando na porta padrão 3306
