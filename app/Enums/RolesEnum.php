<?php

namespace App\Enums;

enum RolesEnum: string
{
    case ContentManager = 'ContentManager';
    case SuperAdmin = 'SuperAdmin';
    case User = 'User';
}
