//campos do formulario
const imageInput = document.getElementById('image');
const nameInput = document.getElementById('name');
const priceInput = document.getElementById('price');
const quantityInventoryInput = document.getElementById('quantity_inventory');
const qualityInput = document.getElementById('quality');
const typeInput = document.getElementById('type');
const descriptionInput = document.getElementById('description');
const tokenInput = document.getElementById('_token');

//campos para exibir erro
const nameErrorSpan = document.getElementById('nameErro')
const imgError = document.getElementById('imgError')
const priceErrorSpan = document.getElementById('priceErro');
const inventoryErrorSpan = document.getElementById('inventoryErro');
const qualityErrorSpan = document.getElementById('qualityErro');
const typeErrorSpan = document.getElementById('typeErro');
const descErrorSpan = document.getElementById('descErro');

// array de erros
const errorSpans = [nameErrorSpan, imgError, priceErrorSpan, inventoryErrorSpan, qualityErrorSpan, typeErrorSpan, descErrorSpan];

const form = document.getElementById("addForm");
const submitButton = document.getElementById("button");

form.addEventListener("submit", async function(event) {
    event.preventDefault();

    submitButton.innerHTML = 'Enviando...';
    submitButton.disabled = true;

    const url = 'http://localhost:8989/products';
    
    try {
        const formData = new FormData();

        formData.append('name', nameInput.value);
        formData.append('image', imageInput.files[0]);
        formData.append('price', priceInput.value);
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
            clearInputs();
            clearErrors();
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
  nameInput.value              = '';
  priceInput.value             = '';
  quantityInventoryInput.value = '';
  qualityInput.value           = '';
  typeInput.value              = '';
  descriptionInput.value       = '';
  imageInput.value             = ''
};

const showErrors = (errors) => {
  const errorKeys = ['name', 'image', 'price', 'quantity_inventory', 'quality', 'type', 'description'];
  
  errorKeys.forEach((errorKey, index) => {
    if (errors[errorKey]) {
        errorSpans[index].innerHTML = errors[errorKey];
    }
  });
};
