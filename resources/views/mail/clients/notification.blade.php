<x-mail::message>
# Introduction
Hey {{ $client['name'] }},<br>
{{$message}}

<x-mail::button :url="''">
Test Button
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
