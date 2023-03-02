//campos do formulario
const imageInput = document.getElementById('image');
const nameInput = document.getElementById('name');
const priceInput = document.getElementById('price');
const discountInput = document.getElementById('discount');
const quantityInventoryInput = document.getElementById('quantity_inventory');
const qualityInput = document.getElementById('quality');
const typeInput = document.getElementById('type');
const descriptionInput = document.getElementById('description');
const tokenInput = document.getElementById('_token');

//campos para exibir erro
const imgError = document.getElementById('imgError')
const nameErrorSpan = document.getElementById('nameErro')
const priceErrorSpan = document.getElementById('priceErro');
const inventoryErrorSpan = document.getElementById('inventoryErro');
const qualityErrorSpan = document.getElementById('qualityErro');
const typeErrorSpan = document.getElementById('typeErro');
const descErrorSpan = document.getElementById('descErro');

const form = document.getElementById("addForm");
const submitButton = document.getElementById("button");

const imagePreview = document.getElementById('imagePreview');
const showPreloader = document.getElementById('showPreloader');
imageInput.addEventListener('change', () => {
    // verificando se um arquivo de imagem foi selecionado
    if (imageInput.files && imageInput.files[0]) {

        showPreloader.style.display = 'block';
        
        const reader = new FileReader();

        setTimeout(() => {
            reader.onload = (event) => {
                // definindo o src da imagem de pré-visualização para o URL da imagem carregada
                imagePreview.src = event.target.result;
                // exibindo a imagem de pré-visualização
                imagePreview.style.display = 'block';
                showPreloader.style.display = 'none';
            };
            // lendo o arquivo de imagem como uma URL de dados
            reader.readAsDataURL(imageInput.files[0]);  
        }, 1000);
    }
});

form.addEventListener("submit", async function(event) {
    event.preventDefault();
    
    submitButton.innerHTML = 'Enviando...';
    submitButton.disabled = true;

    const url = 'http://localhost:8989/products';
    
    try {

        if (!validateImage()) {
            return;
        }

        const formData = new FormData();
        
        formData.append('image', imageInput.files[0]);
        formData.append('name', nameInput.value);
        formData.append('price', priceInput.value);
        formData.append('discount', discountInput.value);
        formData.append('quantity_inventory', quantityInventoryInput.value);
        formData.append('quality', qualityInput.value);
        formData.append('type', typeInput.value);
        formData.append('description', descriptionInput.value);
        formData.append('_token', tokenInput.value);

        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'accept': 'application/json'
            },
            body: formData
        });

        const result = await response.json();
        if (!result.errors) {
            clearErrors();
            clearInputs();
            swal("Success!", 'Produto cadastrado com sucesso!', "success");
        } else {
            showErrors(result.errors);
        }

        submitButton.innerHTML = 'Adicionar';
        submitButton.disabled = false;
    }
    catch (error) {
        alert(error.message);
    } finally {
        submitButton.innerHTML = 'Adicionar';
        submitButton.disabled = false;
    }
});

const clearErrors = () => {
  errorSpans.forEach(errorSpan => errorSpan.innerHTML = '');
};

const clearInputs = () => {
    imageInput.value             = '';
    nameInput.value              = '';
    priceInput.value             = '';
    discountInput.value          = '';
    quantityInventoryInput.value = '';
    qualityInput.value           = '';
    typeInput.value              = '';
    descriptionInput.value       = '';
    imagePreview.style.display   = 'none';
};


const fileTypes = ['image/png', 'image/jpeg', 'image/jpg'];

const validateImage = () => {
    const file = imageInput.files[0];
  
    if (!file) {
        imgError.innerHTML = 'Selecione uma imagem do produto.';
        return false;
    }

    if (!file.size > 1024 * 1024) {
        imgError.innerHTML = `Tamanho da imagem não permitido. Adicione uma imagem com tamanho máximo de ${file.size}.`;
        return false;
    }
  
    if (!fileTypes.includes(file.type)) {
        imgError.innerHTML = 'O tipo da imagem não é suportado.';
        return false;
    }
    
    imgError.innerHTML = '';
    return true;
}

// array de erros
const errorSpans = [nameErrorSpan, priceErrorSpan, inventoryErrorSpan, qualityErrorSpan, typeErrorSpan, descErrorSpan];

const showErrors = (errors) => {
    
    const errorKeys = ['name', 'price', 'quantity_inventory', 'quality', 'type', 'description'];

    errorKeys.forEach((errorKey, index) => {
        if (errors[errorKey]) {
            errorSpans[index].innerHTML = errors[errorKey];
        } else {
            switch(errorKey) {
                case 'name':
                    nameErrorSpan.innerHTML = '';
                    break;
                case 'price':
                    priceErrorSpan.innerHTML = '';
                    break;
                case 'quantity_inventory':
                    inventoryErrorSpan.innerHTML = '';
                    break;
                case 'quality':
                    qualityErrorSpan.innerHTML = '';
                    break;
                case 'type':
                    typeErrorSpan.innerHTML = '';
                    break;
                case 'description':
                    descErrorSpan.innerHTML = '';
                    break;
            }
        }
    });
}