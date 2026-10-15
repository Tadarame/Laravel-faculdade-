
## Classes

- Pessoa
  - nome
  - email
  - telefone
- Aluno extends <Pessoa>
  - ra
- Professor extends <Pessoa>
  - titulacao
- Disciplina
  - nome
- Matricula
  - aluno <Aluno>
  - disciplina <Disciplina>
  - data

![Diagrama](./modelo.jpg)
