@auth
    {{-- logged --}}
    <div class="mb-3">
        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
    </div>

    <div class="mb-3">
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="button" onclick="event.preventDefault();
            this.closest('form').submit();">{{ __('Log out') }}</button>
        </form>
    </div>
@endauth

@guest
    {{-- not login --}}
    <a href="{{ route('login') }}">Login</a>
@endguest