let checkboxAll = document.getElementById("checkbox-all");
let checkboxMy = document.getElementById("checkbox-my");
let clickCheck = document.getElementById("clickCheck");

const preloaderComments = document.getElementById("preloaderComments");
const formCheck = document.getElementById("formCheck");
const result = document.getElementById("result");
const resultError = document.getElementById("resultError");

const fetchComments = (id, filter) => {
    document.body.classList.add('loading');
    preloaderComments.style.display = 'block';
    formCheck.style.display = 'none';

    return fetch(`http://localhost:8989/comments/${id}/?filter=${filter}`)
        .then(response => response.json())
        .finally(() => {
            document.body.classList.remove('loading');
        });
};

const allComments = (id) => {
    checkboxMy.checked = '';

    fetchComments(id, checkboxAll.value)
        .then(result => {
            result.innerHTML = '';
            showComments(result);
        })
        .finally(() => {
            resultError.innerHTML = '';
            preloaderComments.style.display = 'none';
            formCheck.style.display = 'block';
        });
};

const myComments = (id) => {
    checkboxAll.checked = '';

    fetchComments(id, checkboxMy.value)
        .then(result => {
            if (result.error !== '') {
                showErrorCommentsEmpty(result.error);
            }

            result.innerHTML = '';
            showComments(result);
        })
        .finally(() => {
            preloaderComments.style.display = 'none';
            formCheck.style.display = 'block';
        });
};

const showComments = (res) => {
    let resultHtml = ''

    for (let i = 0; i < res.data.data.length; i++) {
        let json = res.data.data[i];   
        
        resultHtml += 
        `
        <div class="w-2/3 flex bg-gray-900 rounded-lg rounded-bl-none p-4 mt-10 shadow-2xl">
            <div class="pl-3 text-center">
                <div class="pl-3 text-center flex">`;
                    if (json.user.avatar) {
                        resultHtml += 
                        `<img
                            style="width:35px;"
                            class="rounded-full"
                            src="/storage/${json.user.avatar}"
                        >`;
                    } else {
                        resultHtml += 
                        `<img style="width:35px;" 
                            src="/images/user01.svg"
                            title="Perfil" 
                        />`;
                    }
                    resultHtml += 
                    `
                    <div class="flex">`;
                        if (res.userAuth == json.user.id)
                            resultHtml += `
                            <p class="ml-2 mt-2 text-green-500">
                                Meu usuário
                            </p>`;
                        else {
                            resultHtml += `
                            <h2 id="name" class="ml-3 mt-2 text-white text-sm">
                                ${json.user.name}
                            </h2>`;
                        }
                    
                        resultHtml += `
                        <p class="ml-8 mt-2">
                            Data postada: ${json.created_at}
                        </p>
                    </div>
                </div>
                <div class="ml-4 flex flex-row text-white mt-6">
                    <p> – ${json.description}</p>
                </div>
            </div>
        </div>`;
    }

    document.getElementById("result").innerHTML = resultHtml;
}


const showErrorCommentsEmpty = (response) => {
    let html = ''

    html += `
    <div class="w-full shadow-2xl sm:rounded-lg mt-3 bg-gray-900">
        <p class="px-8 py-8">
            ${response}
        </p>
    </div>`

    document.getElementById("resultError").innerHTML = html;

}