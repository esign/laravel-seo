<?php

namespace Esign\Seo\Tests\Support\Models;

use Esign\Seo\Concerns\HasSeoDefaults;
use Esign\Seo\Contracts\SeoAble;
use Illuminate\Database\Eloquent\Model;

class PostWithDefaults extends Model implements SeoAble
{
    use HasSeoDefaults;

    public $timestamps = false;
    protected $guarded = [];
}
