// esempio di closure

var saluta = function (nome) {
    let saluto = "ciao"
    let domanda = "comu ti senti?"
    function salutaNome() {
        return saluto + ' ' + nome + ' ' + domanda
    }
    return salutaNome(nome)
}

// **********************

function makeAdder(x) {
    return function (y) {
        return x + y;
    };
}

//prima chiamata per ottenere/inizializzare funzione interna
var add5 = makeAdder(5);
var add10 = makeAdder(10);

//seconda la usa
console.log(add5(2));  // 7
console.log(add10(2)); // 12
