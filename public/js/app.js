var produtoController = new ProdutoController();


var body = document.querySelector("body");
body.onload = produtoController.carregarProdutos.bind(produtoController);

var formprod = document.querySelector("#formprodutos");
formprod.addEventListener("submit", produtoController.salvar.bind(produtoController));







