<?php

namespace App\Enums;

enum CDS: String{
    case cda = 'CDA';
    case cdg = 'CDG';
    case cdo = 'CDO';
    case cde = 'CDE';
    case cdenc = 'CDEnc';

    public static function toArray(): array
    {
        return array_column(CDS::cases(), 'value');
    } 
}