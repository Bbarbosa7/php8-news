<?php

/**
 * CONSTRUCT PROMOTION
 */

// Construção de classe com php 7.4
class Carro
{
    private string $marca;
    private string $modelo;
    private float $motor;

    public function __construct($marca, $modelo, $motor = 1.4)
    {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->motor = $motor;
    }
}

//A mesma classe de cima
//agora construída com php 8.0
class Carro
{
    public function __construct(
        private string $marca,
        private string $modelo,
        private float $motor = 1.4
    ){}
}

/**
 * NAMED ARGUMENTS
 */

//Argumentos no PHP 7.4
function calculaDescontos(
    $idFuncionario,
    $planoDeSaude = false,
    $valeRefeicao = false,
    $valeTransporte = false
)   
{
    //Implementação
}
//Chamada da função
$descontoFuncionario1 = calculaDescontos(1, false, true);
$descontoFuncionario2 = calculaDescontos(2, false, false, true);

//Argumentos no PHP 8.0
function calculaDescontos(
    $idFuncionario,
    $planoDeSaude = false,
    $valeRefeicao = false,
    $valeTransporte = false
)   
{
    //Implementação
}
//Chamada da função
$descontoFuncionario1 = calculaDescontos(
    idFuncionario: 1,
    valeRefeicao:true
);

$descontoFuncionario2 = calculaDescontos(
    idFuncionario: 2,
    valeTransporte: true
);

// O NAMED ARGUMENT TBM PODE SER USADO NAS FUNÇÕES NATIVAS DO PHP
setcookie(
    name: 'testing',
    expire: time() + 60 * 60 * 10
);

/**
 * UNION TYPES
 * Nas versões anteriores do PHP, usávamos as anotações do PHPDocs para
 * especificar combinações de tipos possíveis específicos
 */
class Numero
{
    /**@var int|float */
    private $numero;

    /**
     * @param float|int $numero
     */
    public function __construct($numero)
    {
        $this->numero = $numero;
    }
}

new Numero('NaN'); // msm passando um tipo não esperado o PHP iria aceitar

//UNION TYPES
class Numero
{
    public function __construct(
        private int|float $numero
    ){}
}

new Numero('NaN'); //TypeError: Agora com o Union Types o código quebra em tempo de execução se estiver fora do tipo declarado

/**
 * MIXED TYPES
 */
function estruturaValores(mixed $valor)
{
    //implementação
}

/**
 * ATRIBUTES
 */
//Versões anteriores
class UsuariosController
{
    /**
     * @Route("/usuarios/{id}", methods={"GET"})
     */
    public function get($id)
    {
        //implementação
    }
}

//PHP 8.0
class UsuariosController
{
    #[Route("/usuarios/{id}", methods:["GET"]   )]
    public function get($id)
    {
        //implementação
    }
}

/**
 * NULLSAFE OPERATOR
 */
//Versões anteriores
if($sessao !== null){
    $usuario = $sessao->usuario;

    if($usuario !== null){
        $pais = $usuario->getPais();
    
        if($pais !== null){
            $estado = $pais->getEstado();
        }
    }
}

//PHP 8.0
$estado = $sessao?->usuario?->getPais()?->getEstado();

/**
 * MATCH EXPRESSIONS
 */
//Versões anteriores
switch ($status) {
    case 200:
    case 300:
        $mensagem = null;
        break;
    case 400:
        $mensagem = 'Não encontrado ou não permitido';
        break;
    case 500:
        $mensagem = 'Erro de servidor';
        break;
    
    default:
        'Erro desconhecido';
        break;
}

//Match Expression - PHP 8.0
//Pode ser usado return ou echo também
$mensagem = match($status) {
    200, 300 => null,
    400 => 'Não encontrado ou não permitido',
    500 => 'Erro no servidor',
    default => 'Erro desconhecido'
};