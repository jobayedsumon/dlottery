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
                        @auth
                            <li><a class="{{ menuActive('user.home') }}" href="{{ route('user.home') }}">@lang('Dashboard')</a></li>

                            <li class="menu_has_children">
                                <a class="{{ menuActive(['user.lottery', 'user.buy.lottery', 'user.tickets', 'user.wins']) }}" href="javascript:void(0)">@lang('Lotteries')</a>
                                <ul class="sub-menu">
                                    <li><a class="{{ menuActive('user.lottery') }}" href="{{ route('user.lottery') }}">@lang('All Lotteries')</a></li>
                                    <li><a class="{{ menuActive('user.wins') }}" href="{{ route('user.wins') }}">@lang('Total Wins')</a></li>
                                    <li><a class="{{ menuActive('user.tickets') }}" href="{{ route('user.tickets') }}">@lang('Purchased Tickets')</a></li>
                                </ul>
                            </li>

                            <li class="menu_has_children">
                                <a class="{{ menuActive('user.deposit.*') }}" href="javascript:void(0)">@lang('Deposit')</a>
                                <ul class="sub-menu">
                                    <li><a class="{{ menuActive('user.deposit.index') }}" href="{{ route('user.deposit.index') }}">@lang('Deposit Now')</a></li>
                                    <li><a class="{{ menuActive('user.deposit.history') }}" href="{{ route('user.deposit.history') }}">@lang('Deposit History')</a></li>
                                </ul>
                            </li>

                            <li class="menu_has_children">
                                <a class="{{ menuActive(['user.withdraw', 'user.withdraw.history']) }}" href="javascript:void(0)">@lang('Withdraw')</a>
                                <ul class="sub-menu">
                                    <li><a class="{{ menuActive('user.withdraw') }}" href="{{ route('user.withdraw') }}">@lang('Withdraw Now')</a></li>
                                    <li><a class="{{ menuActive('user.withdraw.history') }}" href="{{ route('user.withdraw.history') }}">@lang('Withdraw History')</a></li>
                                </ul>
                            </li>

                            <li class="menu_has_children">
                                <a class="{{ menuActive('ticket.*') }}" href="javascript:void(0)">@lang('Support')</a>
                                <ul class="sub-menu">
                                    <li><a class="{{ menuActive('ticket.open') }}" href="{{ route('ticket.open') }}">@lang('Open Ticket')</a></li>
                                    <li><a class="{{ menuActive('ticket.index') }}" href="{{ route('ticket.index') }}">@lang('Support Tickets')</a></li>
                                </ul>
                            </li>

                            @if ($general->deposit_commission || $general->buy_commission || $general->win_commission)
                                <li class="menu_has_children">
                                    <a class="{{ menuActive(['user.commissions', 'user.referred']) }}" href="javascript:void(0)">@lang('Referral')</a>
                                    <ul class="sub-menu">
                                        <li><a class="{{ menuActive('user.commissions') }}" href="@if ($general->dc) {{ route('user.commissions', 'all') }}
                                            @elseif($general->buy_commission) {{ route('user.commissions') }} @else
                                            {{ route('user.commissions') }} @endif ">@lang('Commission')</a>
                                        </li>
                                        <li><a class="{{ menuActive('user.referred') }}" href="{{ route('user.referred') }}">@lang('Referred Users')</a></li>
                                    </ul>
                                </li>
                            @endif

                            <li class="menu_has_children">
                                <a class="{{ menuActive(['user.profile.setting', 'user.change.password', 'user.twofactor', 'user.transactions']) }}" href="javascript:void(0)">@lang('Account')</a>
                                <ul class="sub-menu">
                                    <li><a class="{{ menuActive('user.profile.setting') }}" href="{{ route('user.profile.setting') }}">@lang('Profile')</a></li>

                                    <li><a class="{{ menuActive('user.transactions') }}" href="{{ route('user.transactions') }}">@lang('Transactions')</a></li>

                                    <li><a class="{{ menuActive('user.change.password') }}" href="{{ route('user.change.password') }}">@lang('Change Password')</a>
                                    </li>
                                    <li><a class="{{ menuActive('user.twofactor') }}" href="{{ route('user.twofactor') }}">@lang('2FA Security')</a></li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                    <div class="nav-right">
                        @auth
                            <a class="btn btn-sm btn--danger me-sm-3 me-2 btn--capsule px-3 text-white" href="{{ route('user.logout') }}">@lang('Logout')</a>
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
