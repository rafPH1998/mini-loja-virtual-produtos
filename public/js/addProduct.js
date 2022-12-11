document.getElementById("addForm").addEventListener("submit", async function(event){
    event.preventDefault()
    
    document.getElementById("button").innerHTML = 'Enviando...';
    document.getElementById("button").disabled = true;

    /*
    Valores do formulario
    */
    let name = document.getElementById('name').value;
    let price = document.getElementById('price').value;
    let quantity_inventory = document.getElementById('quantity_inventory').value;
    let quality = document.getElementById('quality').value;
    let type = document.getElementById('type').value;
    let description = document.getElementById('description').value;
    let token = document.getElementById('_token').value;

    /*
    Dados do span para exibir o erro
    */
    let nameErro = document.getElementById('nameErro')
    let priceErro = document.getElementById('priceErro')
    let inventoryErro = document.getElementById('inventoryErro')
    let qualityErro = document.getElementById('qualityErro')
    let typeErro = document.getElementById('typeErro')
    let descErro = document.getElementById('descErro')

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
            
            nameErro.innerHTML = ''
            priceErro.innerHTML = ''
            inventoryErro.innerHTML = ''
            qualityErro.innerHTML = ''
            typeErro.innerHTML = ''
            descErro.innerHTML = ''
    
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
            nameErro.innerHTML = result.errors.name;
        } else {
            nameErro.innerHTML = ''
        }

        if (result.errors.price) {
            priceErro.innerHTML = result.errors.price; 
        } else {
            priceErro.innerHTML = ''
        }

        if (result.errors.quantity_inventory) {
            inventoryErro.innerHTML = result.errors.quantity_inventory;
        } else {
            inventoryErro.innerHTML = ''
        }

        if (result.errors.quality) {
            qualityErro.innerHTML = result.errors.quality;
        } else {
            qualityErro.innerHTML = ''
        }

        if (result.errors.type) {
            typeErro.innerHTML = result.errors.type; 
        } else {
            typeErro.innerHTML = ''
        }

        if (result.errors.description) {
            descErro.innerHTML = result.errors.description;
        } else {
            descErro.innerHTML = ''
        }
    })

}); 
