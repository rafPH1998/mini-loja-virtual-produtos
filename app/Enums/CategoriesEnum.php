<?php

namespace App\Enums;

enum CategoriesEnum: string
{
    case livros       = 'Livros';
    case jogos        = 'Jogos';
    case games        = 'Games';
    case roupas       = 'Roupas';
    case eletronicos  = 'Eletrónicos';
    case brinquedos   = 'Brinquedos';
    case acessorios   = 'Acessórios';
    case perfumaria   = 'Perfumária';
}