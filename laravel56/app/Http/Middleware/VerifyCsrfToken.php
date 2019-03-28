<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'Admin/Goods/goods_type_add*',
        'Admin/Goods/goods_type_edit*',
        'Admin/Goods/goods_type_edit_status*',
        'Admin/Goods/goods_type_delete*'
    ];
}
