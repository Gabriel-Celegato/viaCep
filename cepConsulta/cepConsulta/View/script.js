async function consultarCep() {
    const cep = document.getElementById('cep').value;
    const btn = document.querySelector('button');

    btn.innerText = "Carregando...";
    btn.disabled  = true;
    try {
        // Monta o caminho base dinamicamente, sem hardcodar o domínio
        const response = await fetch(`../Controller/CepAPI.php?cep=${cep}`);
        const data = await response.json();

        if (data.erro) {
            alert("CEP não encontrado!");
        } else {
            document.getElementById('logradouro').value = data.logradouro;
            document.getElementById('bairro').value = data.bairro;
            document.getElementById('cidade').value = data.localidade;
        }
    } catch (error) {
        console.error("Erro na requisição:", error);
        alert("Erro ao consultar o servidor.");
    } finally {
        btn.innerText = "Consultar";
        btn.disabled = false;
    }
}

async function deletarCep(id) {

    try {
        // Monta o caminho base dinamicamente, sem hardcodar o domínio
        const response = await fetch(`../Controller/EnderecoApi.php?id=${id}`, {method: 'DELETE'});
        const data = await response.json();

        if (data.erro) {
            alert("CEP não encontrado!"); 
           // Recarrega a página para atualizar a lista
        } else {
          alert("Cep deletado com sucesso!");
          location.reload();
        }
    } catch (error) {
        console.error("Erro na requisição:", error);
        alert("Erro ao consultar o servidor.");
    } 
}

async function buscarCep(cepParaBuscar){


    try {
        // Monta o caminho base dinamicamente, sem hardcodar o domínio
        cepParaBuscar = cepParaBuscar.replace(/\D/g, '');
        const response = await fetch(`../Controller/BuscarCep.php?cepParaBuscar=${cepParaBuscar}`);
        const data = await response.json();
        document.getElementById('resultadoBusca').innerHTML = '';

        if (data.erro) {
            alert("CEP não encontrado! Erro aqui kkkkk");
        } else {

const endereco = data[0]; // pega o primeiro
document.getElementById('resultadoBusca').innerHTML = `
    <tr>
        <td>${endereco.id}</td>
        <td>${endereco.cep}</td>
        <td>${endereco.logradouro}</td>
        <td>${endereco.bairro}</td>
        <td>${endereco.cidade}</td>
        <td>${endereco.uf}</td>
    </tr>
`;
        }
    } catch (error) {
        console.error("Erro na requisição:", error);
        alert("Erro ao consultar o servidor.");
    }

}