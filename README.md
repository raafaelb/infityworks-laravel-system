# InfityWorks - Laravel 

Sistema acadêmico desenvolvido em Laravel seguindo boas práticas de arquitetura, separação de responsabilidades e testes automatizados.

---

## 📌 Objetivo

Aplicação para gerenciamento de:

- Cursos
- Professores
- Alunos
- Disciplinas
- Matrículas
- Dashboard do estudante
- Relatórios estatísticos por curso

---

## 🏗 Arquitetura

O projeto foi estruturado utilizando:

- Service Layer para regras de negócio
- Form Requests para validação
- Controllers enxutos
- Eloquent Models com relacionamentos definidos
- Middleware para controle de acesso por role
- Blade para interface administrativa
- Chart.js para relatórios gráficos
- Testes automatizados com SQLite in-memory

---

## 📂 Camadas e Services

### Models

Responsáveis pelos relacionamentos e regras simples de domínio.

### Services

Contêm regra de negócio isolada:

- CourseService
- StudentService
- TeacherService
- SubjectService
- EnrollmentService
- ReportService

Os Controllers apenas delegam para os Services.

---

## 🔐 Controle de Acesso

Sistema de roles:

- admin
- student

Middlewares:

- EnsureAdmin
- EnsureStudent

Permissões validadas com testes automatizados.

---

## 📊 Funcionalidades de Relatório

Relatório por curso contendo:

- Média de idade
- Aluno mais novo
- Aluno mais velho
- Visualização gráfica com Chart.js

---

## 🎓 Dashboard do Estudante

Exibe:

- Cursos matriculados
- Professores vinculados
- Informações relacionadas ao estudante logado

Relacionamentos carregados via eager loading.

---

## 🧪 Testes Automatizados

Cobertura inclui:

- StudentService completo
- EnrollmentService com proteção contra duplicidade
- SubjectService
- TeacherService
- ReportService com validação de estatísticas
- Permissões Admin vs Student
- Dashboard do estudante
- Fluxo completo de autenticação

Executar os testes:

```bash
php artisan test

Banco de testes configurado com SQLite in-memory.

Total atual: 30 testes passando.

---

## ⚙️ Instalação

```bash
git clone https://github.com/raafaelb/infityworks-laravel-system.git
cd infityworks-laravel-system
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve



---

## 👤 Usuário Admin

Criar manualmente via Tinker:

php artisan tinker

Dentro do Tinker executar:

User::create([
    'name' => 'Admin',
    'email' => 'admin@test.com',
    'password' => bcrypt('123456'),
    'role' => 'admin'
]);

Login:

Email: admin@test.com  
Senha: 123456

---

## 🏆 Diferenciais Técnicos

- Arquitetura com Service Layer
- Separação clara de responsabilidades
- Regras de negócio isoladas
- Testes automatizados relevantes
- Proteção contra duplicidade de matrícula
- Controle de acesso testado
- Dashboard estruturado
- Relatório estatístico com visualização gráfica
- SQLite in-memory para testes rápidos

---

## 🚀 Possíveis Evoluções

- API REST versionada
- Policies ao invés de middleware manual
- Dockerização
- CI/CD com GitHub Actions
- Cobertura de testes acima de 90%

---

## 👨‍💻 Desenvolvido por

Rafael Branco
