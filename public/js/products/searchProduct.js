
searchProduct.addEventListener("submit", async (event) => {
    document.body.classList.add('loading');
    showPreloader();

    event.preventDefault();
    
    const filterValue = document.getElementById("filter").value;

    try {
        const url = `http://localhost:8989/products?filter=${filterValue}`;
        const response = await fetch(url);
        const result = await response.json();

        if (result.data.data.length > 0) {  
            showResults(result, result.loggedUser.id);
        } else {
            productNotFound()
        }

    } catch (error) {
        alert('caiu no erro' + error);
    } finally {
        document.body.classList.remove('loading');
    }
});

const productNotFound = () => {
    let html = ''

    html += 
    `<div class="w-full shadow-2xl sm:rounded-lg mt-3 bg-gray-900">
        <p class="px-8 py-8">
            Nenhum produto encontrado com esse nome no sistema!
        </p>
    </div>`; 

    document.getElementById("posts").innerHTML = html;
}