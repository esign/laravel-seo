@foreach (seo()->jsonLd()->getTypes() as $type)
{!! $type->toScript() !!}
@endforeach