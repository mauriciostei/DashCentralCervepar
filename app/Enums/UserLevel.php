<?php

namespace App\Enums;

enum UserLevel: int
{
    case Miembro = 0;
    case Admin = 1;
}