@component('mail::message')
# Establishment delete requested

User {{ $user->name }} requested to delete establishment <strong>{{ $establishment->business_name }}</strong> ({{ $establishment->id }})


{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
