const likedPost = async (event, user, id, button) => {

    event.preventDefault(); 

    button.innerHTML = '...'
    button.disabled  = true;

    const url       = 'http://localhost:8989/products/like';
    const csrfToken = document.querySelector('input[name="_token"]').value;

    const config = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'accept': 'application/json'
        },
        body: JSON.stringify({
            id,
            _token: csrfToken
        })
    };

    try {
        const response = await fetch(url, config);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const responseJson = await response.json();
        const isUserAction = responseJson.product_id === id && user === responseJson.user_id;

        if (responseJson.created === true && isUserAction) {

            swal("Sucesso!", 'Você curtiu esse produto', 'success');
            button.innerHTML = `<button class="text-red-500 text-sm border-none focus:outline-none">descurtir</button>`;

        } else if (responseJson.deleted === true && isUserAction) {
            swal("Aviso!", 'Você deixou de curtir o produto', 'warning');
            button.innerHTML = `<button class="text-green-500 text-sm border-none focus:outline-none">curtir</button>`;
        }
    } catch (error) {
        swal("Erro!", error, 'error');
    } finally {
       button.disabled = false;
    }
}

