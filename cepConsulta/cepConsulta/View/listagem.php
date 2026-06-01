<?php
require_once '../Model/Endereco.php';

// Chama o método estático — retorna array com todos os registros do banco
$enderecos = Endereco::listar();



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="script.js" defer></script>
    <title>Endereços Salvos</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after 
        { 
         box-sizing: border-box;
         margin: 0; 
         padding: 0;
         }

        :root { 
            --bg:#0f0f0f;
            --surface:#181818; 
            --border:#2a2a2a;
            --accent:#c8f060; 
            --text:#f0f0f0;
            --muted:#555;
             }

        body {

            background:var(--bg);
            color:var(--text);
            font-family:'DM Mono',monospace;
            padding:2rem;

             }

        h1 { 
            font-family:'Syne',sans-serif; 
            font-size:1.8rem;
            font-weight:800;
            margin-bottom:.3rem;
             }

        h1 span { 
            color:var(--accent); 
        }

        p.sub { 
            color:var(--muted); 
            font-size:.8rem; 
            margin-bottom:2rem;
         }

        a { 

        color:var(--accent); 
        font-size:.8rem;
        display:inline-block;
        margin-bottom:1.5rem;
        text-decoration:none; 

        }

        table { 

            width:100%;
            border-collapse:collapse;
            font-size:.85rem;

             }

        th { 

        background:var(--surface);
        border:1px solid var(--border);
        padding:.5rem .8rem;
        color:var(--accent);
        font-size:.7rem; 
        letter-spacing:.08em;
        text-transform:uppercase; 
        text-align:left;

         }
        td { 
            border:1px solid var(--border); 
            padding:.5rem .8rem;
            color:#ccc; 
            }

        tr:nth-child(even) td {
             background:#141414;
             }

        .vazio { color:var(--muted); padding:1rem; }

        .ButaoDoDelet{
        background-color: #941E0C;
        border: none;
        border-radius: 20px;
        width: 70px;
        }

        .ButaoDoDelet:hover{
            background-color: #7A7979;
            transition: 1s;

        }
    </style>
</head>
<body>
    <h1>Endereços <span>Salvos</span></h1>
    <p class="sub">// registros do banco de dados</p>
    <a href="index.html">←← Voltar</a>

    <table>
        <thead><tr><th>Id</th><th>CEP</th><th>Logradouro</th><th>Bairro</th><th>Cidade</th><th>UF</th></tr></thead>
        <tbody>

        <?php if (empty($enderecos)): ?>

            <!-- Se o array vier vazio, exibe uma mensagem -->
            <tr><td colspan="5" class="vazio">Nenhum endereço cadastrado.</td></tr>

        <?php else: ?>
            <!-- foreach percorre cada registro e gera uma linha da tabela -->
            <?php foreach ($enderecos as $row): ?>
            <tr>
                <!-- ?= é igual a um ?php echo; -->                
                <td><?= htmlspecialchars($row['id'])  ?></td>
                <td><?= htmlspecialchars(substr($row['cep'], 0, 5) . '-' . substr($row['cep'], 5))?></td>
                <td><?= htmlspecialchars($row['logradouro'])  ?></td>
                <td><?= htmlspecialchars($row['bairro'])      ?></td>
                <td><?= htmlspecialchars($row['cidade'])      ?></td>
                <td><?= htmlspecialchars($row['uf'])          ?></td>
             <td><button class="ButaoDoDelet"onclick="deletarCep('<?= $row['id'] ?>')"><font size="2" color="white">Deletar</font></button></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    <h2>Digite um CEP para buscar no banco de dados</h2>
    <input type="text" id="cepParaBuscar" placeholder="Ex: 12345-678"></input> <button onclick="buscarCep(document.getElementById('cepParaBuscar').value)">Buscar</button>
    <br><br><br><br>
      <table>
        <thead><tr><th>Id</th><th>CEP</th><th>Logradouro</th><th>Bairro</th><th>Cidade</th><th>UF</th></tr></thead>
        <tbody  id="resultadoBusca">

       
        </tbody>
    </table>           

</body>
</html>