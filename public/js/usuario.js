var usuarioController = new UsuarioController();

var body = document.querySelector("body");
body.onload = usuarioController.carregarUsuarios.bind(usuarioController);


var formuser = document.querySelector("#formusuario");
formuser.addEventListener("submit", usuarioController.salvar.bind(usuarioController));