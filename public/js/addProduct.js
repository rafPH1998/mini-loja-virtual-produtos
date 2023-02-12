const form = document.getElementById("addForm");
const submitButton = document.getElementById("button");
const nameInput = document.getElementById('name');
const priceInput = document.getElementById('price');
const quantityInventoryInput = document.getElementById('quantity_inventory');
const qualityInput = document.getElementById('quality');
const typeInput = document.getElementById('type');
const descriptionInput = document.getElementById('description');
const tokenInput = document.getElementById('_token');
const nameErrorSpan = document.getElementById('nameErro');
const priceErrorSpan = document.getElementById('priceErro');
const inventoryErrorSpan = document.getElementById('inventoryErro');
const qualityErrorSpan = document.getElementById('qualityErro');
const typeErrorSpan = document.getElementById('typeErro');
const descErrorSpan = document.getElementById('descErro');
const errorSpans = [nameErrorSpan, priceErrorSpan, inventoryErrorSpan, qualityErrorSpan, typeErrorSpan, descErrorSpan];

form.addEventListener("submit", async function(event) {

    event.preventDefault();

    submitButton.innerHTML = 'Enviando...';
    submitButton.disabled = true;

    const url = 'http://localhost:8989/products';
    
    try {
        const response = await fetch(url, {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'accept': 'application/json'
            },
            body: JSON.stringify({
                name:               nameInput.value,
                price:              priceInput.value,
                quantity_inventory: quantityInventoryInput.value,
                quality:            qualityInput.value,
                type:               typeInput.value,
                description:        descriptionInput.value,
                _token:             tokenInput.value
            })
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
};

const showErrors = (errors) => {
  const errorKeys = ['name', 'price', 'quantity_inventory', 'quality', 'type', 'description'];
  
  errorKeys.forEach((errorKey, index) => {
    if (errors[errorKey]) {
        errorSpans[index].innerHTML = errors[errorKey];
    }
  });
};
