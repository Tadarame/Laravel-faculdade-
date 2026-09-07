<?php

require __DIR__ . '/classes/Pessoa.php';
require __DIR__ . '/classes/Aluno.php';
require __DIR__ . '/classes/Professor.php';
require __DIR__ . '/classes/Disciplina.php';
require __DIR__ . '/classes/Matricula.php';

// $pessoa1 = new Pessoa();
// $pessoa1->nome = 'João';
// $pessoa1->telefone = '553377666655';
// $pessoa1->email = 'joao@email.com';

$aluno1 = new Aluno();
$aluno1->nome = 'João';
$aluno1->telefone = '553377666655';
$aluno1->email = 'joao@email.com';
$aluno1->ra = 'ABC126262662';
// $aluno1->matriculas = [];

$professor1 = new Professor();
$professor1->nome = 'Profe A';
$professor1->email = 'profe@email.com';
$professor1->telefone = '5539933883883';
$professor1->titulacao = 'Mestre';

$disciplina1 = new Disciplina();
$disciplina1->nome = 'Programação Orientada a Objetos';

$disciplina2 = new Disciplina();
$disciplina2->nome = 'Banco de dados';


$matricula1 = new Matricula();
$matricula1->data = '10/08/2026';
$matricula1->aluno = $aluno1;
$matricula1->disciplina = $disciplina2;

var_dump($matricula1);

die;
