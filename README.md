# Sistema de Gestão de Atividades

Um sistema web desenvolvido em PHP para gestão de atividades escolares/académicas, permitindo o registo, visualização, edição e eliminação de atividades.

## 🚀 Funcionalidades

- Registo de novas atividades
- Listagem de todas as atividades
- Visualização detalhada de cada atividade
- Edição de atividades existentes
- Eliminação de atividades
- Pesquisa dinâmica de atividades
- Registo e visualização de erros do sistema

## 💻 Tecnologias Utilizadas

- PHP 7.4+
- MySQL
- Bootstrap 5.3.2
- jQuery 3.6.0
- Font Awesome 4.6.2
- SweetAlert

## 📋 Pré-requisitos

- Servidor web (Apache/Nginx)
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Extensão mysqli do PHP ativada

## 🔧 Instalação

1. Clone o repositório:
```bash
git clone https://github.com/smpsandro1239/projatividades_crud_bootstrap_php.git
```

2. Importe o arquivo SQL para criar a base de dados:
```sql
CREATE DATABASE gestao_atividades;
USE gestao_atividades;

CREATE TABLE atividades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    modalidade VARCHAR(100),
    dinamizadores VARCHAR(255),
    data DATE,
    local VARCHAR(255),
    destinatarios VARCHAR(255),
    numero_participantes INT,
    custo DECIMAL(10,2)
);
```

3. Configure a conexão com a base de dados em `config.php`:
```php
define('DB_NAME', 'gestao_atividades');
define('DB_USER', 'seu_usuario');
define('DB_PASSWORD', 'sua_senha');
define('DB_HOST', 'localhost');
```

## 📦 Estrutura do Projeto

```
projatividades_crud_bootstrap_php/
│
├── atividades/
│   ├── add.php
│   ├── delete.php
│   ├── edit.php
│   ├── functions.php
│   ├── index.php
│   ├── modal.php
│   └── view.php
│
├── css/
│   └── style.css
│
├── erros/
│   ├── index.php
│   └── erros.log
│
├── inc/
│   ├── database.php
│   ├── footer.php
│   └── header.php
│
├── config.php
└── index.php
```

## 🛠️ Funcionalidades Detalhadas

### Dashboard
- Visão geral do sistema
- Acesso rápido às principais funcionalidades
- Indicadores de estado do sistema

### Gestão de Atividades
- Formulário completo para registo de atividades
- Validação de dados
- Sanitização de inputs
- Gestão de datas
- Controlo de custos

### Sistema de Erros
- Registo de erros do sistema
- Interface para visualização de logs
- Monitoramento de exceções

## 🔒 Segurança

- Proteção contra SQL Injection
- Sanitização de inputs
- Validação de dados
- Escape de output HTML
- Gestão de sessões

## ✨ Melhorias Futuras

- [ ] Implementação de sistema de login
- [ ] Exportação de dados para Excel/PDF
- [ ] Sistema de notificações
- [ ] Relatórios estatísticos
- [ ] Interface responsiva para dispositivos móveis

## 👥 Autor

* **Paula Fernandes** - *Desenvolvimento Inicial*

## 📄 Licença

Este projeto está sob a licença MIT - veja o arquivo [LICENSE.md](LICENSE.md) para detalhes.

## 🎁 Agradecimentos

* Agradeço a todos que contribuíram para o desenvolvimento deste projeto
* Inspiração
* etc

---
⌨️ com ❤️ por [Paula Fernandes](https://github.com/smpsandro1239/) 😊
```

Este README.md fornece:
- Uma visão geral clara do projeto
- Instruções de instalação detalhadas
- Estrutura do projeto
- Requisitos do sistema
- Funcionalidades
- Informações sobre segurança
- Planos futuros
- Créditos e licença

Para usar, basta:
1. Criar um arquivo `README.md` na raiz do seu projeto
2. Copiar este conteúdo
3. Personalizar conforme necessário
4. Adicionar ao seu repositório Git

Lembre-se de:
- Atualizar os links para seu usuário do GitHub
- Ajustar os requisitos conforme seu ambiente
- Modificar a licença se necessário
- Adicionar ou remover seções conforme relevante para seu projeto
