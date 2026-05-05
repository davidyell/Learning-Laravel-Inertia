<x-mail::message>
# Congratulations {{ $adoption['user']['name'] }}

Your pet adoption application for {{ $adoption['animal']['name'] }} has been approved!

Please contact us to confirm the next steps.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
