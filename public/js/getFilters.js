const statusFilter = (element) => {
    showPreloader();
    
    fetch(`http://localhost:8989/products?status=${element.value}`)
    .then(response => {
        return response.json()
    })
    .then(result => {
        
        if (result.error !== '') {
            swal("Erro!", `${result.error}`, "error");
            clearPreloader();
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

                <div class="w-96 bg-gray-900 shadow-lg rounded-lg dark:bg-gray-800 dark:border-gray-700 ml-4 mt-5">
                    <div class="p-5">
                        <p class="mb-3 font-normal text-white">
                            <b> ${element.name} </b>
                        </p>
                        <p class="mb-3 font-normal text-white">
                            $  ${element.price.toFixed(2)}
                        </p>
                        <p class="mb-3 font-normal text-white">
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


const showPreloader = () => {
    document.getElementById("posts").innerHTML = '<div class="h-64 mt-3 ml-5"><img src="images/spinner.svg" style="width:45px;"></div>';
}

const clearPreloader = () => {
    document.getElementById("posts").innerHTML = '';
}

let checkboxAll = document.getElementById("checkbox-all");
let checkboxMy = document.getElementById("checkbox-my");
let clickCheck = document.getElementById("clickCheck");

const allComments = (id) => {

    document.getElementById("preloader").style.display = 'block'
    document.getElementById("formCheck").style.display = 'none'

    checkboxMy.checked = ''

    fetch(`http://localhost:8989/comments/${id}/?filter=${checkboxAll.value}`)
    .then(response => {
        return response.json()
    })
    .then(result => {
        document.getElementById("result").innerHTML = ''
        showMyCommentsResults(result)
    })
    .finally(() => {
        document.getElementById("preloader").style.display = 'none'
        document.getElementById("formCheck").style.display = 'block'
    })
}

const myComments = (id) => {
    document.getElementById("preloader").style.display = 'block'
    document.getElementById("formCheck").style.display = 'none'

    checkboxAll.checked = ''

    fetch(`http://localhost:8989/comments/${id}/?filter=${checkboxMy.value}`)
    .then(response => {
        return response.json()
    })
    .then(result => {
        showMyCommentsResults(result)
    })
    .finally(() => {
        document.getElementById("preloader").style.display = 'none'
        document.getElementById("formCheck").style.display = 'block'
    })
}

const showMyCommentsResults = (res) => {
    let resultHtml = ''

        resultHtml += 
        `
        <div class="container px-5 mx-auto">    
            <div class="flex flex-wrap">`;
                for (let i = 0; i < res.data.data.length; i++) {
                    let json = res.data.data[i];    

                    resultHtml += 
                    `
                    <div class="p-4 md:w-1/3">
                        <div class="flex rounded-lg h-full bg-gray-100 p-8 flex-col shadow-xl">
                            <div class="flex-grow">
                                <div class="flex items-center mb-3">`;
                                    if (json.user.avatar) {
                                        resultHtml += 
                                        `<img
                                            style="width:35px;"
                                            class="rounded-full"
                                            src="{{ url("storage/{$comments->user->avatar}") }}" 
                                        >`
                                    } else {
                                        resultHtml += 
                                        `<img style="width:35px;" 
                                            src="images/user.png" 
                                            title="Perfil" 
                                        />`;
                                    }
                                    if (json.id == json.user.id)
                                        resultHtml += 
                                        `<p class="ml-2">
                                            Meu usuário
                                        </p>`;
                                    else {
                                        resultHtml += `
                                        <h2 class="ml-3 text-gray-900 text-lg title-font font-medium">
                                            ${json.user.name}
                                        </h2>`;
                                    }
                                    resultHtml += 
                                `</div>
                                <div class="flex-grow">
                                    <P style="font-size: 14px;">
                                        Data postada: ${json.created_at}
                                    </P>
                                    <p class="leading-relaxed text-base mt-10">
                                        ${json.description}
                                    </p>
                                </div>
                            </div>
                        </div> 
                    </div>`;
                }
                resultHtml += `
            </div>
        </div>`;

    document.getElementById("result").innerHTML = resultHtml;
}

