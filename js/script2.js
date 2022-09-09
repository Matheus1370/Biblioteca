var input = document.querySelector("#name");
var texto = input.value;
console.log(texto);

const btn = document.querySelector("#name");

btn.addEventListener("click",function(e){
    e.preventDefault();

    var input = document.querySelector("cod_livro");
    var texto = input.value;
    console.log(texto);
});