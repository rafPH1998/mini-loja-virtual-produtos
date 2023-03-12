showPreloader();

let currentPage = 1;

// Função para buscar os dados de uma página usando AJAX
const getPageData = async (page) => {

    document.getElementById('resultLinks').innerHTML = ''
    
    try {
        const url = `http://localhost:8989/products?page=${page}`;
        const response = await fetch(url);
        const result = await response.json();

        if (result.data.data.length > 0) {  
            showResults(result, result.loggedUser.id);
        } else {
            productNotFound()
        }

        const cleanedLinks = cleanLinks(result.data.links);
        showLinks(cleanedLinks)
      
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

    } catch (error) {
        alert('caiu no erro' + error);
    } finally {
        document.body.classList.remove('loading');
    }
   
};

//Limpando os links, tirando aqueles icones sujos que voltam do laravel na paginação
const cleanLinks = (links) => {
    const cleanLinks = links.slice(); 
    cleanLinks.shift(); 
    cleanLinks.pop(); 
    return cleanLinks;
};

// Funções para exibir todos os links da paginação
const showLinks = (links) => {
    
    let html = '';
    for (let i = 0; i < links.length; i++) {
        
        const link = links[i];

        const id = i; // Define um ID exclusivo para cada link
        const linkClass = link.active === true ? 'text-blue-700' : 'text-gray-500';
        const bgClass   = link.active === true ? 'bg-blue-200' : 'bg-white';

        html +=
            `<a href="${link.url}" id="${id}" class="py-2 px-2 ml-0 
                leading-tight border border-gray-300 
                hover:bg-gray-100 hover:text-gray-700 text-xs
                dark:bg-gray-800 dark:border-gray-700
                dark:text-gray-400 dark:hover:bg-gray-700
                dark:hover:text-white ${linkClass} ${bgClass}">
                ${link.label}
            </a>`;
    }
  
    document.getElementById('resultLinks').innerHTML = html;
  
    // Adiciona o evento de clique a cada link individualmente
    for (let i = 0; i < links.length; i++) {
        const id = i
        document.getElementById(id).addEventListener('click', (event) => {
            event.preventDefault();
            document.body.classList.add('loading');
            showPreloader();

            const url = new URL(event.target.getAttribute('href')); // Obtém a URL do link clicado
            const page = url.searchParams.get('page');

            currentPage = page

            getPageData(currentPage)
        });
    }
};

// Funções para navegar para a próxima e anterior páginas
document.getElementById('previous-page').addEventListener('click', (event) => {
    document.body.classList.add('loading');
    showPreloader();
    event.preventDefault();

    if (currentPage === 0) {
        currentPage = 1
    }

    if (currentPage >= 1) {
        currentPage--;
        getPageData(currentPage);
    }

});

document.getElementById('next-page').addEventListener('click', (event) => {
    document.body.classList.add('loading');
    showPreloader();
    event.preventDefault();
    currentPage++;
    getPageData(currentPage);
});

// Carrega os dados da primeira página ao carregar a página
getPageData(currentPage);
