document.getElementById("submitButton").addEventListener("click", async function(event){

    const submitButton  = document.getElementById('submitButton');
    const csrfToken     = document.getElementById("_token").value;
    const id            = document.getElementById("id").value;
    const result_do_php = document.getElementById("result_do_php");
    const result_do_js  = document.getElementById("result_do_js");
    const result        = document.getElementById("result");
    const qtdAtual      = document.getElementById("quantity_inventory").value;

    //alert(qtdAtual)
    
    submitButton.innerHTML = 'Comprando...';
    submitButton.disabled  = true;

    event.preventDefault();

    const url = `http://localhost:8989/products/buy`;

    try {
        const response = await fetch(url, {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'accept': 'application/json'
            },
            body: JSON.stringify({
                id    : id,
                _token: csrfToken
            })
        });

        const { quantity, countShopping, error, warning, success } = await response.json();
        const buttonText = countShopping || error ? 'Comprar' : 'Remover compra';
        submitButton.innerHTML = buttonText;

        if (error) {
            swal('Erro!', error, 'error');
        } else if (warning) {
            swal('Aviso!', warning, 'warning');
            showButton(quantity);
        } else {
            result_do_php.style.display = 'none'
            result_do_js.style.display = 'block'
            showButton(quantity);
            swal('Success!', success, 'success');
        }

    } catch (error) {
        swal("Erro!", error, 'error');
    } finally {
        submitButton.disabled = false;
    }
})

const showButton = (qtd) => {
    if (qtd > 0) {
        result.innerHTML = `(${qtd}) Em estoque`
    } else { 
        result.innerHTML = `(${qtd}) Estoque vazio`
    }
}




