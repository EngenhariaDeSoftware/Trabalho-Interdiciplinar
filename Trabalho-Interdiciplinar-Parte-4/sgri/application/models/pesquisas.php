<?php
//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
* Classe: Pesquisas
* Finalidade: Pesquisar registros globais em todas as tabelas
* Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
* Data de Criação: 17/03/2012
*/
class Pesquisas extends CI_Model {

    private $campo = null;

    /**
    * Pesquisa em todas tabelas registros referente ao valor do parêmtro
    * $objeto = Dados a serem pesquisados
    * @retorna <objeto>
    */
    public function glob($objeto) {
        
        $sql = "
            SELECT 
                *,
                pessoas.nome      AS pessoaNome,
                acessos.nome      AS acessoNome,
                cidades.nome      AS cidadeNome,
                equipamentos.nome AS equipamentoNome
            FROM  
                salas, equipamentos, pessoas
            LEFT JOIN
                cidades
            ON
                pessoas.cidade = cidades.idCidade
            INNER JOIN
                usuarios
            ON
                pessoas.idPessoa = usuarios.idPessoa
            INNER JOIN
                acessos
            ON
                usuarios.idAcesso = acessos.idAcesso
            WHERE
                pessoas.nome          like '%$objeto->campo%' ||
                pessoas.email         like '%$objeto->campo%' ||
                pessoas.telefone      like '%$objeto->campo%' ||
                pessoas.celular       like '%$objeto->campo%' ||
                pessoas.cpf           like '%$objeto->campo%' ||
                pessoas.dataNacimento like '%$objeto->campo%' ||
                pessoas.cep           like '%$objeto->campo%' ||
                pessoas.cidade        like '%$objeto->campo%' ||
                pessoas.bairro        like '%$objeto->campo%' ||
                pessoas.endereco      like '%$objeto->campo%' ||
                
                salas.predio    like '%$objeto->campo%' ||
                salas.andar     like '%$objeto->campo%' ||
                salas.numero    like '%$objeto->campo%' ||
                salas.tipoSala  like '%$objeto->campo%' ||
                
                equipamentos.nome      like '%$objeto->campo%' ||
                equipamentos.descricao like '%$objeto->campo%' ||
                
                cidades.nome like '%$objeto->campo%' ||
                cidades.uf   like '%$objeto->campo%' ||
                
                acessos.nome like '%$objeto->campo%'
               
                group by 
                    pessoas.email, 
                    pessoas.nome
            ";
        
        $query = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Pesquisa em todas tabelas registros referente ao valor do parêmtro
    * $objeto = Dados a serem pesquisados
    * @retorna <objeto>
    */
    public function autoCompletar($objeto) {
        
        $sql = "
            SELECT 
                pessoas.nome AS pessoaNome
            FROM  
                salas, equipamentos, pessoas
            LEFT JOIN
                cidades
            ON
                pessoas.cidade = cidades.idCidade
            INNER JOIN
                usuarios
            ON
                pessoas.idPessoa = usuarios.idPessoa
            INNER JOIN
                acessos
            ON
                usuarios.idAcesso = acessos.idAcesso
            WHERE
                pessoas.nome          like '%$objeto->campo%' ||
                pessoas.email         like '%$objeto->campo%' ||
                pessoas.telefone      like '%$objeto->campo%' ||
                pessoas.celular       like '%$objeto->campo%' ||
                pessoas.cpf           like '%$objeto->campo%' ||
                pessoas.dataNacimento like '%$objeto->campo%' ||
                pessoas.cep           like '%$objeto->campo%' ||
                pessoas.cidade        like '%$objeto->campo%' ||
                pessoas.bairro        like '%$objeto->campo%' ||
                pessoas.endereco      like '%$objeto->campo%' ||
                
                salas.predio    like '%$objeto->campo%' ||
                salas.andar     like '%$objeto->campo%' ||
                salas.numero    like '%$objeto->campo%' ||
                salas.tipoSala  like '%$objeto->campo%' ||
                
                equipamentos.nome      like '%$objeto->campo%' ||
                equipamentos.descricao like '%$objeto->campo%' ||
                
                cidades.nome like '%$objeto->campo%' ||
                cidades.uf   like '%$objeto->campo%' ||
                
                acessos.nome like '%$objeto->campo%'
               
                group by 
                    pessoas.idPessoa
            ";
        
        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Obtem Valor
    * $campo = nome do campo
    * @retorna <campo>
    */
    public function get($campo) {
        return $this->$campo;
    }

    /**
    * Seta um valor
    * $campo = nome do Campo, $valor = valor do campo
    * @retorna
    */
    public function set($campo, $valor) {
        $this->$campo = $valor;
    }
}

?>