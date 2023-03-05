
document.getElementById("buyProduct").addEventListener("click", function(event){

    const loadingButton = document.getElementById("loading-button");
    const buyProduct = document.getElementById("buyProduct");
    const csrfToken   = document.getElementById("_token");
    const id          = document.getElementById("id");
    const description = document.getElementById("description");
    
    event.preventDefault();

    loadingButton.style.display = 'inline';
    buyProduct.disabled = true;

    const url = `http://localhost:8989/comment`;

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'accept': 'application/json'
        }, 
        body: JSON.stringify({
            id         : id.value,
            _token     : csrfToken.value,
            description: description.value
        })
    })
    .then(response => response.json())
    .then(result => {
        if (result.errors) {
            swal("Erro!", result.message, "error");
        } else {
            swal("Success!", `Comentário criado para produto ${result.product.name}`, "success");
            description.value = ''
        }
    })
    .catch(error => swal("Erro!", error, "error"))
    .finally(() => {
        loadingButton.style.display = 'none';
        buyProduct.disabled = false;
    });

})
