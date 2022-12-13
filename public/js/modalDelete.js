const modal = document.getElementById('popup-modal');
const closeModal = document.querySelector('.close-modal');
const closeModalIcon = document.getElementById('close-modal-icon');
const button = document.getElementById('button-delete');

const showModal = (id) => {
    modal.classList.remove('hidden')

    let confirm = document.getElementById('confirm');
    confirm.addEventListener('click', function() {
        
        document.getElementById("container").innerHTML = '<div class=""><img src="images/spinner.svg" style="width:65px;"></div>';

        let url = `http://localhost:8989/products/${id}`;
        let token = document.getElementById('_token').value;

        fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'accept': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                _token: token
            })
        })
        .then(result => {
            if (result.status === 204) {
                document.getElementById("container").innerHTML = ''

                swal(
                    "Success!", 
                    'Produto deletado com sucesso!', 
                    "success"
                );

                setTimeout(() => {
                    window.location.reload(true);
                }, 1000);
            }

            modal.classList.add('hidden')
        })
    })
    
}

closeModal.addEventListener('click', function() {
    modal.classList.add('hidden')
})

closeModalIcon.addEventListener('click', function() {
    modal.classList.add('hidden')
})
