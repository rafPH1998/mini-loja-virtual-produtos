async function statusFilter(element)
{
    document.getElementById("posts").innerHTML = '<div class="h-64 mt-3 ml-5"><img src="images/spinner.svg" style="width:45px;"></div>';
    
    fetch(`http://localhost:8989/products?status=${element.value}`)
    .then(response => {
        return response.json()
    })
    .then(result => {
        
        if (result.error !== '') {
            swal("Erro!", `${result.error}`, "error");
            document.getElementById("posts").innerHTML = '';
        } else {
            showResults(result)
        }
    })

    document.getElementById("p").innerHTML = '';
    document.getElementById("paginate").innerHTML = '';
}

const showResults = (json) => {
    let url_product = 'http://localhost:8989/';

    let html = 
    `<div class="flex items-stretch drop-shadow-xl">`;
            for (let i = 0; i < json.data.length; i++) {
                let element = json.data[i];               

                html += `

                <div class="w-96 bg-white rounded-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700 ml-4 mt-5">
                    <div class="p-5">
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            <b> ${element.name} </b>
                        </p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            $  ${element.price.toFixed(2)}
                        </p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            ${element.created_at} 
                        </p>
                        <div class="mt-5">
                            <a href="${url_product}comments/${element.id}" 
                                class="font-medium text-blue-600 text-blue-500 hover:underline">
                                Avaliações (${element.comments.length})
                            </a>
                        </div>
                        <a href="${url_product}products/${element.id}" class="mt-3 text-indigo-500 inline-flex items-center">Ver mais
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
        </div>`
        }

    document.getElementById("posts").innerHTML = html;
}