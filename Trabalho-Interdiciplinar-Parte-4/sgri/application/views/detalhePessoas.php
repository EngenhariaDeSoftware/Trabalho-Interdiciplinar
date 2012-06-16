<?php foreach ($pessoas as $valor): ?>
    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
        <thead>
            <tr>
                <td colspan="1">Nome</td>
                <td colspan="1">Email</td>
                <td colspan="1">Telefone</td>
                <td colspan="1">Celular</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="1"><?php echo $valor->pessoaNome; ?></td>
                <td colspan="1"><?php echo $valor->email; ?></td>
                <td colspan="1"><?php echo $valor->telefone; ?></td>
                <td colspan="1"><?php echo $valor->celular; ?></td>
            </tr>
        </tbody>
    </table>

    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
        <thead>
            <tr>
                <td colspan="1">CPF</td>
                <td colspan="1">Data Nacimento</td>
                <td colspan="1">CEP</td>
                <td colspan="1">Data Cadastro</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="1"><?php echo $valor->cpf; ?></td>
                <td colspan="1"><?php echo $valor->dataNacimento; ?></td>
                <td colspan="1"><?php echo $valor->cep; ?></td>
                <td colspan="1"><?php echo $valor->dataCadastro; ?></td>                
            </tr>
        </tbody>
    </table>

    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
        <thead>
            <tr>
                <td colspan="1">Cidade</td>
                <td colspan="1">UF</td>
                <td colspan="1">Bairro</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="1"><?php echo $valor->cidadeNome; ?></td>
                <td colspan="1"><?php echo $valor->uf; ?></td>
                <td colspan="1"><?php echo $valor->bairro; ?></td>
            </tr>
        </tbody>
    </table>
    
    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
        <thead>
            <tr>
                <td colspan="2">Endereço</td>
                <td colspan="2">Tipo Pessoa</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2"><?php echo $valor->endereco; ?></td>
                <td colspan="2"><?php echo $valor->acessoNome; ?></td>
            </tr>
        </tbody>
    </table>
<?php endforeach; ?>
