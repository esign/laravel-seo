@if (seo()->meta()->getTitle())
<title>{{ seo()->meta()->getTitle() }}</title>
@endif
@if (seo()->meta()->getDescription())
<meta name="description" content="{{ seo()->meta()->getDescription() }}">
@endif
@if (seo()->meta()->getRobots())
<meta name="robots" content="{{ seo()->meta()->getRobots() }}">
@endif
@if (seo()->meta()->getUrl())
<link rel="canonical" href="{{ seo()->meta()->getUrl() }}">
@endif
@if (seo()->meta()->getNext())
<link rel="next" href="{{ seo()->meta()->getNext() }}">
@endif
@if (seo()->meta()->getPrev())
<link rel="prev" href="{{ seo()->meta()->getPrev() }}">
@endif
@foreach (seo()->meta()->getAlternateUrls() as $locale => $url)
<link rel="alternate" hreflang="{{ $locale }}" href="{{ $url }}">
@endforeach