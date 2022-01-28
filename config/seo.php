<?php

return [
    /**
     * The class that will be used when you call the Seo facade or the seo helper method.
     * The configured class must extend the `Esign\Seo\Seo` class.
     */
    'seo' => \Esign\Seo\Seo::class,

    /**
     * Tags are used to represent their own set of specific attributes.
     * The configured tags must extend their corresponding base class.
     */
    'tags' => [
        'meta' => \Esign\Seo\Tags\Meta::class,
        'open_graph' => \Esign\Seo\Tags\OpenGraph::class,
        'twitter_card' => \Esign\Seo\Tags\TwitterCard::class,
        'json_ld' => \Esign\Seo\Tags\JsonLd::class,
    ],
];
