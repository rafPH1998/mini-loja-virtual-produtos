const statusFilter = (element) => {
    document.body.classList.add('loading');
    showPreloader();
    
    try {
        fetch(`http://localhost:8989/products?status=${element.value}`)
        .then(response => {
            return response.json()
        })
        .then(result => {

            if (result.error !== '') {
                clearPreloader();
                swal({
                    icon: "error",
                    title: "Erro!",
                    text: `${result.error}`,
                    type: "error",
                    confirmButtonText: "OK"
                }).then((confirmed) => {
                    if (confirmed) {
                        window.location.href = "http://localhost:8989/products";
                    }
                });
                const swalOverlay = document.querySelector('.swal-overlay');
                swalOverlay.addEventListener('click', () => {
                    window.location.href = "http://localhost:8989/products";
                });
                
            } else {    
                document.body.classList.remove('loading');

                showResults(result, result.loggedUser.id);
            }
        })
    } catch (error) {
        console.log(error)
    }

    document.getElementById("p").innerHTML = '';
    document.getElementById("paginate").innerHTML = '';
}

const showResults = (json, user) => {

    let url_product = 'http://localhost:8989/';

    let html = 
    `<div class="flex items-stretch drop-shadow-xl">`;
            for (let i = 0; i < json.data.data.length; i++) {

                let element = json.data.data[i];     
                
                var createdAt = new Date(element.created_at);
                var now = new Date();
                var diffInMs = now - createdAt;
                var diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));

                html += `
                <div class="w-96
                    shadow-lg 
                    transition ease-in-out delay-150
                    bg-gray-700 hover:-translate-y-1 
                    hover:scale-110 duration-300
                    rounded-lg ml-4 mt-5">

                    <div class="shadow hover:shadow-lg transition duration-300 
                        ease-in-out xl:mb-0 lg:mb-0 md:mb-0 mb-6 cursor-pointer group">
                        <img class="w-full h-64" 
                            src="/storage/${element.image}" alt="image"
                            />
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between">
                            <p class="mb-3 font-normal text-white">`;
                                if (element.name.length > 15) {
                                    html += `<b> ${element.name.substr(0, 15 - 3) + '...' }</b>`;
                                } else {
                                    html += `<b>${element.name}</b>`;
                                }
                                if (diffInDays <= 3) {
                                    html += `<img class="h-8 w-8" src="images/new.png"></img>`;
                                } 
                            html += `
                            </p>
                            <div>
                                <span class="rounded py-1 px-3 text-xs 
                                    font-bold ${element.quantity_inventory > 0 ? 'bg-green-400 ' : 'bg-red-400 '}"> 
                                    ${element.quantity_inventory > 0 ? 'Em estoque' : 'Sem estoque'}
                                </span>
                            </div>
                        </div>`;
                        if (element.user.id === user) {
                            html += `
                            <p class="text-green-500 text-xs">
                                (meu produto) 
                            </p>`;
                        }
                        html += `
                        <div class="flex">
                            <p class="mt-3 text-xs text-white">$ ${element.price.toFixed(2)} </p>  
                            <p class="mt-3 ml-2 text-xs text-red-600 line-through">$15.00</p>
                        </div>   
                        <p style="font-size: 12px;" class="mb-1 text-sm mt-2 text-white">
                            Criado em: ${element.date} 
                        </p>
                        <div class="mt-5">
                            <a href="${url_product}comments/${element.id}" 
                                class="font-medium text-blue-600 hover:underline">
                                Avaliações (${element.comments.length})
                            </a>
                        </div>
                        <a href="${url_product}products/${element.id}" class="mt-2 text-indigo-500 inline-flex items-center">Ver mais
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        <form action="#" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">`;
                                if (element.user_id !== element.user.id) {
                                    html += 
                                    `<button onclick="likedPost(event, ${element.user_id}, ${element.id}, this)"
                                        class="focus:outline-none text-sm border transition 
                                        ease-in-out delay-150 hover:-translate-y-1 p-1 rounded-md 
                                        ${!element.hasLikedByUser(element.user_id) ? 'text-green-500' : 'text-red-500'}">                
                                        ${element.hasLikedByUser(element.user_id) ? 'descurtir' : 'curtir'}
                                    </button>`
                                }
                        html += `
                        </form>
                    </div>
                </div>
        </div>`
        }

    document.getElementById("posts").innerHTML = html;
}


const showPreloader = () => {
    document.getElementById("posts").innerHTML = '<div class="loader flex"><img src="images/spinner.svg" style="width:75px;"><p class="mt-6 ml-3">Carregando..</p></div>';
}

const clearPreloader = () => {
    document.getElementById("posts").innerHTML = '';
}
