document.getElementById("addAddress").addEventListener("submit", async function(event){
    event.preventDefault()
    
    document.getElementById("button").innerHTML = 'Enviando...';
    document.getElementById("button").disabled = true;

    /*
    Valores do formulario
    */
    let address             = document.getElementById('address').value;
    let street              = document.getElementById('street').value;
    let number              = document.getElementById('number').value;
    let district            = document.getElementById('district').value;
    let phone               = document.getElementById('phone').value;
    let cellphone           = document.getElementById('cellphone').value;
    let token               = document.getElementById('_token').value;

    /*
    Dados do span para exibir o erro
    */
    let camposInputs = [
        document.getElementById('addressErro'),
        document.getElementById('streetErro'),
        document.getElementById('numberErro'),
        document.getElementById('districtErro'),
        document.getElementById('phoneErro'),
        document.getElementById('cellphoneErro'),
    ];

    let url = 'http://localhost:8989/address';

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'accept': 'application/json'
        },
        body: JSON.stringify({
            address: address,
            street: street,
            number: number,
            district: district,
            phone: phone,
            cellphone: cellphone,
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
                'Endereço cadastrado com sucesso!', 
                "success"
            );
            
            clearErrorsSpan(camposInputs);

            document.getElementById('address').valuquality
            quality = ''
            document.getElementById('district').value = ''
            document.getElementById('phone').value = ''
            document.getElementById('cellphone').value = ''
        }

        document.getElementById("button").innerHTML = 'Adicionar';
        document.getElementById("button").disabled = false;    

        if (result.errors.address) {
            camposInputs[0].innerHTML = result.errors.address;
        } else {
            camposInputs[0].innerHTML = ''
        }

        if (result.errors.street) {
            camposInputs[1].innerHTML = result.errors.street; 
        } else {
            camposInputs[1].innerHTML = ''
        }

        if (result.errors.number) {
            camposInputs[2].innerHTML = result.errors.number;
        } else {
            camposInputs[2].innerHTML = ''
        }

        if (result.errors.district) {
            camposInputs[3].innerHTML = result.errors.district;
        } else {
            camposInputs[3].innerHTML = ''
        }

        if (result.errors.phone) {
            camposInputs[4].innerHTML = result.errors.phone; 
        } else {
            camposInputs[4].innerHTML = ''
        }

        if (result.errors.celphone) {
            camposInputs[5].innerHTML = result.errors.celphone;
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
