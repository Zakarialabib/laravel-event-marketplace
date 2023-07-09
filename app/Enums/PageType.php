<?php

declare(strict_types=1);

namespace App\Enums;

enum PageType: string
{
    case HOME = 'home';

    case ABOUT = 'about';

    case BRAND = 'brand';

    case BLOG = 'blog';

    case CATALOG = 'catalog';

    case BRANDS = 'brands';

    case CONTACT = 'contact';

    case PRODUCT = 'product';

    case PRIVACY = 'privacy';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
