@if (seo()->twitter()->getType())
<meta name="twitter:card" content="{{ seo()->twitter()->getType() }}">
@endif
@if (seo()->twitter()->getTitle())
<meta name="twitter:title" content="{{ seo()->twitter()->getTitle() }}">
@endif
@if (seo()->twitter()->getDescription())
<meta name="twitter:description" content="{{ seo()->twitter()->getDescription() }}">
@endif
@if (seo()->twitter()->getImage())
<meta name="twitter:image" content="{{ seo()->twitter()->getImage() }}">
@endif