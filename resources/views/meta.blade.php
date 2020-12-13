<title>{{ seo()->get('title') . seo()->get('titleSeparator') . seo()->get('titleSuffix') }}</title>
<meta name="description" content="{{ seo()->get('description') }}">
<meta name="robots" content="{{ seo()->get('robots') }}">
<link rel="canonical" href="{{ seo()->get('canonical') }}">
<link rel="next" href="{{ seo()->get('next') }}">
<link rel="prev" href="{{ seo()->get('prev') }}">