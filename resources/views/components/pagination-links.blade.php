@props(['class'])

<section {{ $attributes->merge(['class'=>'mt-3 d-flex justify-content-center align-items-center']) }}>
    {{ $class->links() }}
</section>
