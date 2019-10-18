class ProdutoController {
    constructor() { }

    salvar(event) {
        var self = this;
        event.preventDefault();
        var produto = new Produto();
      
        produto.id = document.querySelector("#id").value;
        produto.foto = document.querySelector("#foto").value;
        produto.nome = document.querySelector("#nome").value;
        produto.preco = document.querySelector("#preco").value;
        produto.descricao = document.querySelector("#descricao").value;
     
        self.enviarProduto(produto);
    }

    limparFormulario(){
        
        document.querySelector("#foto").value="";
        document.querySelector("#nome").value="";
        document.querySelector("#descricao").value="";
        document.querySelector("#preco").value="";
    }

    carregarProdutos() {
        var self = this;
        console.log("carregando produtos ...");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                self.montarTabela(JSON.parse(this.responseText));
            }
        };
        xhttp.open("GET", "http://localhost:9000/produtos", true);
        xhttp.send();
    }

    editarProduto(produto) {
        console.log("buscando produtos..." + produto.id);
        console.log(produto);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
           if (this.readyState === 4 && this.status === 200) {
             
                var produto = JSON.parse(this.responseText);
                document.querySelector("#id").value = produto.id;
                document.querySelector("#foto").value = produto.foto;
                document.querySelector("#nome").value = produto.nome;
                document.querySelector("#preco").value = produto.preco;
                document.querySelector("#descricao").value = produto.descricao;
                  
           }
          
       };

       xhttp.open("GET", "http://localhost:9000/produtos/" + produto.id, true);
       xhttp.send(JSON.stringify(produto));
   } 

    deletarProduto(produto) {
      
        var self = this;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                self.carregarProdutos();                       
            }
           
        };
       
        xhttp.open("DELETE", "http://localhost:9000/produtos/" + produto.id, true);
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.send(JSON.stringify(produto));
    }


    enviarProduto(produto) {
        var self = this;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 201) {
                self.carregarProdutos();
                self.limparFormulario();
            }
           
        };
        
        if (produto.id === "") {
            xhttp.open("POST", "http://localhost:9000/produtos", true);
            xhttp.setRequestHeader("Content-Type", "application/json");
            xhttp.send(JSON.stringify(produto));

        } else {

            console.log(produto);
            xhttp.open("PUT", "http://localhost:9000/produtos/" + produto.id, true);
            xhttp.setRequestHeader("Content-Type", "application/json");
            xhttp.send(JSON.stringify(produto));

        }
    }

    montarTabela(produtos) {
        var str = "";
        for (var i in produtos) {
            str += "<div class='col-lg-4'>";
            str += '<img class="rounded-circle" src="../img/jaqueta.jpg" Generic placeholder="image" width="140" height="140">';
            str += '<h2 class="black">' + produtos[i].nome + '</h2>';
            str += '<label class="p3" id="preco">R$: ' + produtos[i].preco + '</label>';
            str += '<p>Descrição produto:</br>';
            str += '' + produtos[i].descricao + '</p>';
            str += '<p><button class="btn btn-secondary" data-toggle="modal" data-target="#ModalCadastrarProduto" id="editarProduto'+produtos[i].id+'" role="button">Editar</button> <button class="btn btn-danger" id="deletaProduto'+produtos[i].id+'" role="button">Excluir</button> </p>';
            str += "</div>";
        }
        
        var corpo = document.querySelector("#corpo");
        corpo.innerHTML = str;


        for (var i in produtos) {
        var deletaProduto = document.querySelector("#deletaProduto" + produtos[i].id);
        deletaProduto.addEventListener("click", this.deletarProduto.bind(this,produtos[i]));
        
        }

        for (var i in produtos) {
        var edita = document.querySelector("#editarProduto" + produtos[i].id);
        edita.addEventListener("click", this.editarProduto.bind(this,produtos[i]));

        }
      
    }

   


    
}