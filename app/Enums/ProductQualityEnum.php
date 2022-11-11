<?php

namespace App\Enums;

enum ProductQualityEnum: string
{
    case novo       = 'Novo';
    case semi_novo  = 'Recém comprado';
    case bom        = 'Bom estado';
    case medio      = 'Ótimo estado';
}