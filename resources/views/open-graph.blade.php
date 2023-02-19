@if (seo()->og()->getType())
<meta property="og:type" content="{{ seo()->og()->getType() }}">
@endif
@if (seo()->og()->getSiteName())
<meta property="og:site_name" content="{{ seo()->og()->getSiteName() }}">
@endif
@if (seo()->og()->getTitle())
<meta property="og:title" content="{{ seo()->og()->getTitle() }}">
@endif
@if (seo()->og()->getDescription())
<meta property="og:description" content="{{ seo()->og()->getDescription() }}">
@endif
@if (seo()->og()->getImage())
<meta property="og:image" content="{{ seo()->og()->getImage() }}">
@endif
@if (seo()->og()->getUrl())
<meta property="og:url" content="{{ seo()->og()->getUrl() }}">
@endif