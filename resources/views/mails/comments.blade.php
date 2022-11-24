<x-mail::message>
# Introduction

Um novo comentário foi feito para o produto {{ $product->name }}

<x-mail::button :url="''">
    Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
