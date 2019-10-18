class UsuarioController{
    constructor(){}

    salvar(event){
        event.preventDefault();
        var usuario = new Usuario();
        usuario.nome = document.querySelector("#nome_usuario").value;
        usuario.login = document.querySelector("#usuario").value;
        usuario.senha = document.querySelector("#senha").value;
   
        console.log(this);
        this.enviarUsuario(usuario);
    }

    enviarUsuario(usuario){
        var self = this;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 201) {
                console.log(JSON.parse(this.responseText));
                self.carregarUsuarios();
                self.limparFormularioUsuario();
    
            }
        };
        xhttp.open("POST", "http://localhost:9000/usuarios", true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(JSON.stringify(usuario));
        
    }

    carregarUsuarios() {
        var self = this;
        console.log("carregando usuarios ...");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                console.log(self);
                self.montarTabela(JSON.parse(this.responseText));
            }
        };
        xhttp.open("GET", "http://localhost:9000/usuarios", true);
        xhttp.send();
    }

   /* montarTabela (usuarios) {
    var str="";

    for(var i in usuarios){
        str+="<div class='col-lg-4'>";
        str+='<h2 class="black">'+usuarios[i].nome+'</h2>';
        str+='<p>'+usuarios[i].login+'</p>';
        str+='<label>'+usuarios[i].senha+'</label>';
        str+="</div>";
    } 
   
    var body = document.querySelector("#body");
    body.innerHTML = str;
    }*/
}



