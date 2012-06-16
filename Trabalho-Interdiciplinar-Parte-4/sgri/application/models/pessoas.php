<?php
//Bloqueia se tetar acessar o arquivo diretamente
if (!defined('BASEPATH'))
    exit('Acesso Negado');

/**
* Classe: Pessoas
* Finalidade: Inserir, atualizar, pesquisar registros das pessoas
* Autor: Grupo PSI - Diego Rodrigues|Graziella Arca|Leonardo Miyamoto|Marcos Soares
* Data de Criação: 17/03/2012
*/
class Pessoas extends CI_Model {

    private $idPessoa      = null;
    private $nome          = null;
    private $email         = null;
    private $telefone      = null;
    private $celular       = null;
    private $cpf           = null;
    private $dataNacimento = null;
    private $cep           = null;
    private $cidade        = null;
    private $bairro        = null;
    private $endereco      = null;
    private $dataCadastro  = null;
    public  $opcao         = "nome";

    /**
    * Insere registros
    * $objeto = dados a serem inseridos
    * @retorna <O ultimo ID do usuario inserido no banco>
    */
    public function inserir($objeto) {
        
        $objeto->dataNacimento = $this->query->dateEua($objeto->dataNacimento);
        
        $sql = "
            INSERT INTO
                pessoas
             values(
                '',
                '$objeto->nome',
                '$objeto->email',
                '$objeto->telefone',
                '$objeto->celular',
                '$objeto->cpf',
                '$objeto->dataNacimento',
                '$objeto->cep',
                '$objeto->cidade',
                '$objeto->bairro',
                '$objeto->endereco',
                '$objeto->dataCadastro'
                )
        ";

        $query     = $this->query->setQuery($sql);
        $resultado = $this->obterIdPessoa();
        return $resultado;
    }

    /**
    * Obtem a ultima pessoa no banco
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterIdPessoa() {
        
        $sql    = "SELECT MAX(idPessoa) AS idPessoa FROM pessoas";
        $query  = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Verifica se o email é repetido
    * $objeto = dados do email, $campo = o nome do campo
    * @retorna <boleano>
    */
    public function verificaEmailExiste($objeto, $campo) {

        $sql = "
            SELECT *
                FROM
             pessoas, usuarios
                WHERE
             pessoas.email    = '$objeto->email' or
             usuarios.usuario = '$campo'
        ";

        $query     = $this->query->setQuery($sql);
        $resultado = $this->query->numRows($query);
        
        if ( $resultado == '0' ) {
            return true;
        } else {
            return false;
        }
    }

    /**
    * Obtem todas as pessoas
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterPessoasXml() {
        
        $sql = "
            SELECT 
                *
                FROM
             pessoas 
                WHERE
             idPessoa
                NOT IN
                (
                    SELECT 
                        idPessoa
                    FROM
                        usuarios
                )
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Obtem todas as pessoas
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterPessoas() {
        
        $sql = "
            SELECT 
                *,
                cidades.nome AS cidadeNome,
                pessoas.nome AS pessoaNome,
                acessos.nome AS acessoNome
                FROM
             pessoas 
                INNER JOIN
             usuarios
                ON
             pessoas.idPessoa = usuarios.idPessoa
                INNER JOIN
             cidades
                ON
             pessoas.cidade   = cidades.idCidade
                INNER JOIN
             acessos
                ON
             usuarios.idAcesso = acessos.idAcesso
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Obtem uma unica pessoa para detalhe
    * $objeto = Objeto com id da pessoa
    * @retorna <objeto>
    */
    public function detalhe($objeto) {
        
        $sql = "
            SELECT 
            *,
            cidades.nome AS cidadeNome,
            pessoas.nome AS pessoaNome,
            acessos.nome AS acessoNome
                FROM
            pessoas
                LEFT JOIN
            cidades
                ON
            pessoas.cidade = cidades.idCidade
                INNER JOIN
            usuarios
                ON
            usuarios.idPessoa = pessoas.idPessoa
                INNER JOIN
            acessos
                ON
            usuarios.idAcesso = acessos.idAcesso
                WHERE
            pessoas.idPessoa = '$objeto->idPessoa'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Deleta um Usuario
    * $objeto = Objeto com id da Pessoa
    * @retorna <objeto>
    */
    public function deletar($objeto) {
        
        $sql = "
            DELETE FROM
                pessoas
            WHERE
             idPessoa = '$objeto->idPessoa'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Obtem uma unica pessoa
    * $objeto = Objeto com o id da pessoa
    * @retorna <objeto>
    */
    public function obterPorPessoas($objeto) {
        
        $sql = "
            SELECT 
                *,
                pessoas.nome AS pessoaNome,
                cidades.nome AS cidadeNome,
                acessos.nome AS acessoNome
            FROM 
                pessoas
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
                pessoas.idPessoa = '$objeto->idPessoa'";

        $query = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Atualiza registros
    * $objeto = objeto para ser atualizado
    * @retorna <objeto>
    */
    public function atualizar($objeto) {
        
        $objeto->dataNacimento = $this->query->dateEua($objeto->dataNacimento);
        
        $sql = "
            UPDATE 
                pessoas
            SET
                nome          = '$objeto->nome',
                email         = '$objeto->email',
                telefone      = '$objeto->telefone',
                celular       = '$objeto->celular',
                cpf           = '$objeto->cpf',
                dataNacimento = '$objeto->dataNacimento',
                cep           = '$objeto->cep',
                cidade        = '$objeto->cidade',
                bairro        = '$objeto->bairro',
                endereco      = '$objeto->endereco'
            WHERE
                idPessoa = '$objeto->idPessoa'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Pesquisa pessoas
    * $objeto = dados da pesquisa
    * @retorna <objeto>
    */
    public function pesquisar($objeto) {

        $sql = "
            SELECT 
                *,
                pessoas.nome AS pessoaNome,
                cidades.nome AS cidadeNome,
                acessos.nome AS acessoNome
            FROM 
                pessoas
            LEFT JOIN
                cidades
            ON
                pessoas.cidade    = cidades.idCidade
            INNER JOIN
                usuarios
            ON
                pessoas.idPessoa  = usuarios.idPessoa
            INNER JOIN
                acessos
            ON
                usuarios.idAcesso = acessos.idAcesso
            WHERE 
                $objeto->opcao LIKE '%$objeto->nome%'
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }

    /**
    * Lista a ultima pessoa cadastrada
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterUltimasPessoas() {
        
        
        $sql = "
            SELECT 
                *,
                pessoas.nome AS pessoaNome,
                acessos.nome AS acessoNome
            FROM
                pessoas
            INNER JOIN
                usuarios
            ON
                pessoas.idPessoa = usuarios.idPessoa
            INNER JOIN
                acessos
            ON
                usuarios.idAcesso = acessos.idAcesso
            ORDER BY pessoas.idPessoa DESC
            LIMIT 0 , 4
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }
    
    /**
    * Lista a ultima pessoa cadastrada
    * Sem parametros
    * @retorna <objeto>
    */
    public function obterProfessor() {
        
        $sql = "
            SELECT 
                *,
                pessoas.nome AS pessoaNome,
                acessos.nome AS acessoNome,
                pessoas.idPessoa AS pessoaIdPessoa
            FROM
                pessoas
            INNER JOIN
                usuarios
            ON
                pessoas.idPessoa = usuarios.idPessoa
            INNER JOIN
                acessos
            ON
                usuarios.idAcesso = acessos.idAcesso
            WHERE
                acessos.idAcesso = '3'
            ORDER BY pessoas.nome ASC
            
        ";

        $query = $this->query->setQuery($sql);
        return $query;
    }

    
    public function importar($xml){
        
        $i = 0;
        foreach($xml as $valor)
        {
            
            $nome           = $valor["Nome"];
            $DataNascimento = $valor["DataNascimento"]; //converter data EUA
            $dataCadastro   = $valor["dataCadastro"];   //converter data EUA
            $Cpf            = $valor["Cpf"];
            $Telefone       = $valor["Telefone"];
            $celular        = $valor["celular"];
            $Email          = $valor["Email"];
            $Cep            = $valor["Cep"];
            $Cidade         = $valor["Cidade"]; //consulta SQL
            $Estado         = $valor["Estado"];
            $Bairro         = $valor["Bairro"];
            $Endereco       = $valor["Endereco"];

            $DataNascimento = $this->query->dateEua($DataNascimento);
            $dataCadastro   = $this->query->dateEua($dataCadastro);
            
            
            //Select idCidade
            $sql = "
                SELECT 
                    idCidade
                FROM
                    cidades
                WHERE
                    nome like '$Cidade' and
                    uf   like '$Estado'
            ";
            $query     = $this->query->setQuery($sql);
            foreach($query->result() as $valor)
            {$idCidade = $valor->idCidade;}
            //Select idCidade

            $sql = "
                INSERT INTO
                    pessoas
                values(
                    '',
                    '$nome',
                    '$Email',
                    '$Telefone',
                    '$celular',
                    '$Cpf',
                    '$DataNascimento',
                    '$Cep',
                    '$idCidade',
                    '$Bairro',
                    '$Endereco',
                    '$dataCadastro'
                    )
            ";

            $query     = $this->query->setQuery($sql);
            $resultado = $this->obterIdPessoa();
            
            foreach($resultado->result() as $val)
            {
                $ar[$i] = $val->idPessoa;
            }
            
            $i++;
        }
        return $ar;
        
    }
    
    public function saveOnXml($xml){
        
 
        $i = 0;
        foreach($xml as $valor){
            
            $nome           = $valor["PessoasNome"];
            $email          = $valor["PessoasEmail"];
            
            $sql = "
                INSERT 
                    INTO
                pessoas
                (
                    idPessoa, 
                    nome, 
                    email, 
                    cidade
                )
                values
                (
                    '',
                    '$nome',
                    '$email',
                    '1'
                )
            ";

            $query     = $this->query->setQuery($sql);
            $resultado = $this->obterIdPessoa();
            
            foreach($resultado->result() as $val){
                $idPessoa[$i] = $val->idPessoa;
            }
            
            $i++;
        }
        
        $j = 0;
        foreach($xml as $valor){
            
            $nome           = $valor["PessoasNome"];
            $senha          = md5($nome);
            $sql = "
                INSERT 
                    INTO
                usuarios
                (
                    idUsuario, 
                    usuario, 
                    senha, 
                    idPessoa,
                    idAcesso
                )
                values
                (
                    '',
                    '$nome',
                    '$senha',
                    '$idPessoa[$j]',
                    '3'
                )
            ";

            $query     = $this->query->setQuery($sql);
            $j++;
        }
        
        
        
        
        $ii=0;
        foreach($xml as $valor){
            $DisciplinasNome        = $valor["DisciplinasNome"];
            $DisciplinasTurno       = $valor["DisciplinasTurno"];
            $DisciplinasHoraInicial = $valor["DisciplinasHoraInicial"];
            $DisciplinasHoraFinal   = $valor["DisciplinasHoraFinal"];
            $DisciplinasIdCurso     = $valor["DisciplinasIdCurso"];
            
            $sql = "
                INSERT 
                    INTO
                disciplinas
                values
                (
                    '',
                    '$DisciplinasNome',
                    '$DisciplinasTurno',
                    '$DisciplinasHoraInicial',
                    '$DisciplinasHoraFinal',
                    '16'
                )
            ";

            $query = $this->query->setQuery($sql);
            $resultado = $this->obterUltimoDisciplina();
            
            foreach($resultado->result() as $val){
                $idDisciplina[$ii] = $val->idDisciplina;
            }
            $ii++;
        }
        
        $k=0;
        foreach($xml as $valor){
            $sql = "
                INSERT 
                    INTO
                professores_disciplinas
                values
                (
                    '',
                    '$idPessoa[$k]',
                    '$idDisciplina[$k]'
                )
            ";
            $k++;
            $query = $this->query->setQuery($sql);
            
            
        }
        
        
        
        
        $x=0;
        foreach($xml as $valor){
            $TurmasNome  = $valor["TurmasNome"];
            $TurmasGrupo = $valor["TurmasGrupo"];
            
            $sql = "
                INSERT 
                    INTO
                turmas
                values
                (
                    '',
                    '$TurmasNome',
                    '$TurmasGrupo',
                    '$idPessoa[$x]',
                    '$idDisciplina[$x]'
                )
            ";
            $x++;

            $query = $this->query->setQuery($sql);
        }
        
        $kj = 0;
        foreach($xml as $valor){
            $dataCadastro = "2012-04-15 01:44:13";
            
            $SalasPredio     = $valor["SalasPredio"];
            $SalasAndar      = $valor["SalasAndar"];
            $SalasTipoSala   = $valor["SalasTipoSala"];
            $SalasCapacidade = $valor["SalasCapacidade"];
            $SalasNumero     = $valor["SalasNumero"];
            
            $sql = "
                INSERT 
                    INTO
                salas
                values
                (
                    '',
                    '$SalasPredio',
                    '$SalasAndar',
                    '$SalasNumero',
                    '$SalasTipoSala',
                    '$SalasCapacidade',
                    '$dataCadastro'
                )
            ";

            $query = $this->query->setQuery($sql);
            $resultado = $this->obterUltimaSala();
            
            foreach($resultado->result() as $val){
                $idSala[$kj] = $val->idSala;
            }
            $kj++;
        }
        
        $xy = 0;
        foreach($xml as $valor){
            $sql = "
                INSERT 
                    INTO
                salas_professores_disciplinas
                values
                (
                    '',
                    '$idSala[$xy]',
                    '$idPessoa[$xy]',
                    '$idDisciplina[$xy]'
                )
            ";
            $xy++;
            $query = $this->query->setQuery($sql);
            
        }
        
    }
    
    public function obterUltimaSala(){
        $sql    = "SELECT MAX(idSala) AS idSala FROM salas";
        $query  = $this->query->setQuery($sql);
        return $query;
    }
    
    public function obterUltimoDisciplina(){
        $sql    = "SELECT MAX(idDisciplina) AS idDisciplina FROM disciplinas";
        $query  = $this->query->setQuery($sql);
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