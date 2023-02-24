const showModal = (id) => {

    swal({
        title: "Tem certeza?",
        text: "Ao confirmar, o produto será deletado permanentemente do sistema.",
        icon: "warning",
        buttons: true,
    })
    .then((willDelete) => {
        if (willDelete) {

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
                    swal("Ok! Produto deletado do sistema.", {
                        icon: "success",
                    })
                    .then((confirmed) => {
                        if (confirmed) {
                            window.location.href = "http://localhost:8989/myProducts";
                        }
                    })
                }
            })
        }
    })
    .catch(error => {
        swal("Error!", error);
    });
}