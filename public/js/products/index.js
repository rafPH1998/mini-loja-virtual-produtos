
showPreloader();

let currentPage = 1;

// Função para buscar os dados de uma página usando AJAX
const getPageData = async (page) => {

    try {
        const url = `http://localhost:8989/products?page=${page}`;
        const response = await fetch(url);
        const result = await response.json();

        if (result.data.prev_page_url == null) {
            document.getElementById('previous-page').style.display = 'none';
        } else {
            document.getElementById('previous-page').style.display = 'inline';
        }
        
        if (result.data.next_page_url == null) {
            document.getElementById('next-page').style.display = 'none';
        } else {
            document.getElementById('next-page').style.display = 'inline';
        }
        
        showResults(result, result.loggedUser.id);
    } catch (error) {
        alert('caiu no erro' + error);
    }
};

// Funções para navegar para a próxima e anterior páginas
document.getElementById('previous-page').addEventListener('click', (event) => {
    showPreloader();
    event.preventDefault();
    if (currentPage > 1) {
        currentPage--;
        getPageData(currentPage);
    }
});

document.getElementById('next-page').addEventListener('click', (event) => {
    showPreloader();
    event.preventDefault();
    currentPage++;
    getPageData(currentPage);
});

// Carrega os dados da primeira página ao carregar a página
getPageData(currentPage);

