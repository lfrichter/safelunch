@impersonating
    <div class="alert alert-warning pt-1 pb-1 mb-0">
        {{-- @php($logged_in_user_name = isset($logged_in_user) && $logged_in_user ? $logged_in_user->name : '') --}}
        {{-- @lang('You are currently logged in as :name.', ['name' => $logged_in_user_name]) <a href="{{ route('impersonate.leave') }}">@lang('Return to your account')</a>. --}}
    </div><!--alert alert-warning-->
@endImpersonating
