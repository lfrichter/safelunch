@component('mail::message')
# Authority delete requested

User {{ $user->name }} requested to delete authority <strong>{{ $authority->name }}</strong> ({{ $authority->id }})


{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
