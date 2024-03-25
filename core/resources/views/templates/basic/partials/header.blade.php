<header class="header">
    <div class="header__bottom">
        <div class="container-fluid px-lg-5">
            <nav class="navbar navbar-expand-xl align-items-center p-0">
                <a class="site-logo site-title" href="{{ route('home') }}"><img
                        src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="logo"></a>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu-toggle"></span>
                </button>
                <div class="collapse navbar-collapse mt-lg-0 mt-3" id="navbarSupportedContent">
                    <ul class="navbar-nav main-menu me-auto">
                        <li><a class="{{ menuActive('home') }}" href="{{ route('home') }}">@lang('Home')</a></li>
                        <li><a class="{{ menuActive('pages', ['about']) }}" href="{{ route('pages', 'about') }}">@lang('About')</a></li>
                        <li><a class="{{ menuActive(['lottery', 'lottery.details']) }}" href="{{ route('lottery') }}">@lang('Lotteries')</a></li>

                        @if (@$pages)
                            @foreach ($pages as $k => $data)
                                <li><a class="{{ menuActive('pages', [$data->slug]) }}" href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a></li>
                            @endforeach
                        @endif

                        <li><a class="{{ menuActive('blog') }}" href="{{ route('pages', ['blog']) }}">@lang('Blog')</a></li>
                        <li><a class="{{ menuActive('contact') }}" href="{{ route('contact') }}">@lang('Contact')</a></li>
                    </ul>
                    <div class="nav-right">
                        @auth
                            <a class="btn btn-sm btn--base me-sm-3 me-2 btn--capsule {{ menuActive('user.home') }} px-3" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                            <a class="fs--14px me-sm-3 me-2 text-white" href="{{ route('user.logout') }}">@lang('Logout')</a>
                        @else
                            <a class="btn btn-sm btn--base me-sm-3 me-2 btn--capsule px-3" href="{{ route('user.login') }}">@lang('Login')</a>
                            <a class="fs--14px me-sm-3 me-2 text-white" href="{{ route('user.register') }}">@lang('Register')</a>
                        @endauth
                        <select class="language-select langSel">
                            @foreach ($language as $item)
                                <option value="{{ $item->code }}" @if (session('lang') == $item->code) selected @endif>
                                    {{ __($item->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </nav>
        </div>
    </div><!-- header__bottom end -->
</header>
