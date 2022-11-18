<title>{{ seo()->meta()->getTitle() }}</title>
<meta name="description" content="{{ seo()->meta()->getDescription() }}">
<meta name="robots" content="{{ seo()->meta()->getRobots() }}">
<link rel="canonical" href="{{ seo()->meta()->getUrl() }}">
<link rel="next" href="{{ seo()->meta()->getNext() }}">
<link rel="prev" href="{{ seo()->meta()->getPrev() }}">
@foreach (seo()->meta()->getAlternateUrls() as $locale => $url)
@if ($loop->first && count(seo()->meta()->getAlternateUrls()) > 1)
<link rel="alternate" hreflang="x-default" href="{{ $url }}"/>
@endif
<link rel="alternate" hreflang="{{ $locale }}" href="{{ $url }}">
@endforeach