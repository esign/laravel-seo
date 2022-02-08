<?php

namespace Esign\Seo\Tests\Support\Models;

use Esign\Seo\Concerns\HasSeoDefaults;
use Esign\Seo\Contracts\SeoContract;
use Illuminate\Database\Eloquent\Model;

class PostWithDefaults extends Model implements SeoContract
{
    use HasSeoDefaults;

    public $timestamps = false;
    protected $guarded = [];
}
