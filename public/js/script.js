async function statusFilter(element)
{
    document.getElementById("posts").innerHTML = '<div class="h-64 mt-3 ml-5"><img src="images/spinner.svg" style="width:45px;"></div>';

    let url = 'http://localhost:8989/products?status=' + element.value; 
    let url_show_product = 'http://localhost:8989/products/';
    let res = await fetch(url);
    let result = await res.json();
    let data = result.data;
    let html = '';

    for (let i = 0; i < data.length; i++) {
        let element = data[i];

        html += '<div class="flex items-stretch drop-shadow-xl">';
        html +=      '<div class="w-96 bg-white rounded-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700 ml-4 mt-5">' ;
        html +=         '<div class="p-5">';
        html +=             '<a href="#">';
        html +=                 '<img id="img" src="storage/ ' + element.image + ' " />';
        html +=             '</a>';
        html +=             '<p class="mb-3 font-normal text-gray-700 dark:text-gray-400">';
        html +=                 '<b>' + element.name + '</b>';
        html +=             '</p>';
        html +=              '<p class="mb-3 font-normal text-gray-700 dark:text-gray-400">'
        html +=                  element.description
        html +=             '</p>';
        html +=             '<p class="mb-3 font-normal text-gray-700 dark:text-gray-400">';
        html +=                '$ ' + element.price.toFixed(2);
        html +=            '</p>';
        html +=             '<p class="mb-3 font-normal text-gray-700 dark:text-gray-400">';
        html +=                 element.created_at
        html +=            '</p>';
        html +=             '<a href=" ' + url_show_product + element.id + ' " class="mt-3 text-indigo-500 inline-flex items-center">Ver mais'
        html +=                 '<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"'
        html +=                       'class="w-4 h-4 ml-2" viewBox="0 0 24 24">'
        html +=                  '<path d="M5 12h14M12 5l7 7-7 7"></path>'
        html +=                 '</svg>'
        html +=             '</a>'
        html +=         '</div>';
        html +=       '</div>';
        html += '</div>';
    }

    document.getElementById("p").innerHTML = '';
    document.getElementById("paginate").innerHTML = '';
    document.getElementById("posts").innerHTML = html;
}