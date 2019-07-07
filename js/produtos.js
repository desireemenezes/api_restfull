let body = document.querySelector("body");
body.onload = function () {
    carregarProdutos();
}

const carregarProdutos = () => {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            montarTabela(JSON.parse(this.responseText));
        }
    };
    xhttp.open("GET", "http://localhost:9000/produtos", true);
    xhttp.send();
}

const montarTabela = (produtos) => {
    let str="";

    for(let i in produtos){
        str+="<div class='col-lg-4'>";
        str+='<img class="rounded-circle" src="img/jaqueta.jpg" Generic placeholder="image" width="140" height="140">';
        str+='<h2 class="black">'+produtos[i].nome+'</h2>';
        str+='<h4>Descrição produto:</h4>';
        str+='<p>'+produtos[i].descricao+'</p>';
        str+='<label class="p3" id="preco">R$: '+produtos[i].preco+'</label>';
        str+='<p><a class="btn btn-dark" href="login.html" role="button">Comprar</a></p>';
        str+="</div>";
    } 
   
    let corpo = document.querySelector("#corpo");
    corpo.innerHTML = str;
}

const enviarProduto = (produto) => {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 201) {
            console.log(JSON.parse(this.responseText));
            carregarProdutos();
            limparFormulario();

        }
    };

    xhttp.open("POST", "http://localhost:9000/produtos", true);
    xhttp.setRequestHeader("Content-Type","application/json");
    xhttp.send(JSON.stringify(produto));
    
}

const limparFormulario = () => {
    document.querySelector("#nome").value="";
    document.querySelector("#descricao").value="";
    document.querySelector("#preco").value="";
}


let form = document.querySelector("#formprodutos");
form.onsubmit = function(event){
    event.preventDefault();
    let produto = new Produto();
    produto.nome = document.querySelector("#nome").value;
    produto.descricao = document.querySelector("#descricao").value;
    produto.preco = document.querySelector("#preco").value;
    enviarProduto(produto);
    window.location.reload();
}



