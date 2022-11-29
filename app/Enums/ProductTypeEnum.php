<?php

namespace App\Enums;

enum ProductTypeEnum: string
{
    case livros       = 'Livros';
    case jogos        = 'Jogos';
    case roupas       = 'Roupas';
    case eletronicos  = 'Eletrónicos';
    case brinquedos   = 'Brinquedos';
    case acessorios   = 'Acessórios';
    case perfumaria   = 'Perfumária';
}