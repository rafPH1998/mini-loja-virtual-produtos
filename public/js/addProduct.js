document.getElementById("addForm").addEventListener("submit", async function(event){
    event.preventDefault()
    
    document.getElementById("button").innerHTML = 'Enviando...';
    document.getElementById("button").disabled = true;

    /*
    Valores do formulario
    */
    let name               = document.getElementById('name').value;
    let price              = document.getElementById('price').value;
    let quantity_inventory = document.getElementById('quantity_inventory').value;
    let quality            = document.getElementById('quality').value;
    let type               = document.getElementById('type').value;
    let description        = document.getElementById('description').value;
    let token              = document.getElementById('_token').value;

    /*
    Dados do span para exibir o erro
    */
    let camposInputs = [
        document.getElementById('nameErro'),
        document.getElementById('priceErro'),
        document.getElementById('inventoryErro'),
        document.getElementById('qualityErro'),
        document.getElementById('typeErro'),
        document.getElementById('descErro'),
    ];

    let url = 'http://localhost:8989/products';

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'accept': 'application/json'
        },
        body: JSON.stringify({
            name: name,
            price: price,
            quantity_inventory: quantity_inventory,
            quality: quality,
            type: type,
            description: description,
            _token: token
        })
    })
    .then(response => {
        return response.json()
    })
    .then(result => {
        if (!result.errors) {
            swal(
                "Success!", 
                'Produto cadastrado com sucesso!', 
                "success"
            );
            
            clearErrorsSpan(camposInputs);
    
            document.getElementById('name').value = ''
            document.getElementById('price').value = ''
            document.getElementById('quantity_inventory').value = ''
            document.getElementById('quality').value = ''
            document.getElementById('type').value = ''
            document.getElementById('description').value = ''
        }

        document.getElementById("button").innerHTML = 'Adicionar';
        document.getElementById("button").disabled = false;    

        if (result.errors.name) {
            camposInputs[0].innerHTML = result.errors.name;
        } else {
            camposInputs[0].innerHTML = ''
        }

        if (result.errors.price) {
            camposInputs[1].innerHTML = result.errors.price; 
        } else {
            camposInputs[1].innerHTML = ''
        }

        if (result.errors.quantity_inventory) {
            camposInputs[2].innerHTML = result.errors.quantity_inventory;
        } else {
            camposInputs[2].innerHTML = ''
        }

        if (result.errors.quality) {
            camposInputs[3].innerHTML = result.errors.quality;
        } else {
            camposInputs[3].innerHTML = ''
        }

        if (result.errors.type) {
            camposInputs[4].innerHTML = result.errors.type; 
        } else {
            camposInputs[4].innerHTML = ''
        }

        if (result.errors.description) {
            camposInputs[5].innerHTML = result.errors.description;
        } else {
            camposInputs[5].innerHTML = ''
        }
    })

}); 

const clearErrorsSpan = (param) => {
    for(let i = 0; i < param.length; i++) {
        let htmlError = param[i];    
        htmlError.innerHTML = ''
    }
}
