<header class="header">
    <div class="header__bottom">
        <div class="container-fluid px-lg-5">
            <nav class="navbar navbar-expand-xl align-items-center p-0">
                <a class="site-logo site-title" href="<?php echo e(route('home')); ?>"><img
                        src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="logo"></a>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu-toggle"></span>
                </button>
                <div class="collapse navbar-collapse mt-lg-0 mt-3" id="navbarSupportedContent">
                    <ul class="navbar-nav main-menu me-auto">
                        <?php if(auth()->guard()->check()): ?>
                            <li><a class="<?php echo e(menuActive('user.home')); ?>" href="<?php echo e(route('user.home')); ?>"><?php echo app('translator')->get('Dashboard'); ?></a></li>

                            <li class="menu_has_children">
                                <a class="<?php echo e(menuActive(['user.lottery', 'user.buy.lottery', 'user.tickets', 'user.wins'])); ?>" href="javascript:void(0)"><?php echo app('translator')->get('Lotteries'); ?></a>
                                <ul class="sub-menu">
                                    <li><a class="<?php echo e(menuActive('user.lottery')); ?>" href="<?php echo e(route('user.lottery')); ?>"><?php echo app('translator')->get('All Lotteries'); ?></a></li>
                                    <li><a class="<?php echo e(menuActive('user.wins')); ?>" href="<?php echo e(route('user.wins')); ?>"><?php echo app('translator')->get('Total Wins'); ?></a></li>
                                    <li><a class="<?php echo e(menuActive('user.tickets')); ?>" href="<?php echo e(route('user.tickets')); ?>"><?php echo app('translator')->get('Purchased Tickets'); ?></a></li>
                                </ul>
                            </li>

                            <li class="menu_has_children">
                                <a class="<?php echo e(menuActive('user.deposit.*')); ?>" href="javascript:void(0)"><?php echo app('translator')->get('Deposit'); ?></a>
                                <ul class="sub-menu">
                                    <li><a class="<?php echo e(menuActive('user.deposit.index')); ?>" href="<?php echo e(route('user.deposit.index')); ?>"><?php echo app('translator')->get('Deposit Now'); ?></a></li>
                                    <li><a class="<?php echo e(menuActive('user.deposit.history')); ?>" href="<?php echo e(route('user.deposit.history')); ?>"><?php echo app('translator')->get('Deposit History'); ?></a></li>
                                </ul>
                            </li>

                            <li class="menu_has_children">
                                <a class="<?php echo e(menuActive(['user.withdraw', 'user.withdraw.history'])); ?>" href="javascript:void(0)"><?php echo app('translator')->get('Withdraw'); ?></a>
                                <ul class="sub-menu">
                                    <li><a class="<?php echo e(menuActive('user.withdraw')); ?>" href="<?php echo e(route('user.withdraw')); ?>"><?php echo app('translator')->get('Withdraw Now'); ?></a></li>
                                    <li><a class="<?php echo e(menuActive('user.withdraw.history')); ?>" href="<?php echo e(route('user.withdraw.history')); ?>"><?php echo app('translator')->get('Withdraw History'); ?></a></li>
                                </ul>
                            </li>

                            <li class="menu_has_children">
                                <a class="<?php echo e(menuActive('ticket.*')); ?>" href="javascript:void(0)"><?php echo app('translator')->get('Support'); ?></a>
                                <ul class="sub-menu">
                                    <li><a class="<?php echo e(menuActive('ticket.open')); ?>" href="<?php echo e(route('ticket.open')); ?>"><?php echo app('translator')->get('Open Ticket'); ?></a></li>
                                    <li><a class="<?php echo e(menuActive('ticket.index')); ?>" href="<?php echo e(route('ticket.index')); ?>"><?php echo app('translator')->get('Support Tickets'); ?></a></li>
                                </ul>
                            </li>

                            <?php if($general->deposit_commission || $general->buy_commission || $general->win_commission): ?>
                                <li class="menu_has_children">
                                    <a class="<?php echo e(menuActive(['user.commissions', 'user.referred'])); ?>" href="javascript:void(0)"><?php echo app('translator')->get('Referral'); ?></a>
                                    <ul class="sub-menu">
                                        <li><a class="<?php echo e(menuActive('user.commissions')); ?>" href="<?php if($general->dc): ?> <?php echo e(route('user.commissions', 'all')); ?>

                                            <?php elseif($general->buy_commission): ?> <?php echo e(route('user.commissions')); ?> <?php else: ?>
                                            <?php echo e(route('user.commissions')); ?> <?php endif; ?> "><?php echo app('translator')->get('Commission'); ?></a>
                                        </li>
                                        <li><a class="<?php echo e(menuActive('user.referred')); ?>" href="<?php echo e(route('user.referred')); ?>"><?php echo app('translator')->get('Referred Users'); ?></a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <li class="menu_has_children">
                                <a class="<?php echo e(menuActive(['user.profile.setting', 'user.change.password', 'user.twofactor', 'user.transactions'])); ?>" href="javascript:void(0)"><?php echo app('translator')->get('Account'); ?></a>
                                <ul class="sub-menu">
                                    <li><a class="<?php echo e(menuActive('user.profile.setting')); ?>" href="<?php echo e(route('user.profile.setting')); ?>"><?php echo app('translator')->get('Profile'); ?></a></li>

                                    <li><a class="<?php echo e(menuActive('user.transactions')); ?>" href="<?php echo e(route('user.transactions')); ?>"><?php echo app('translator')->get('Transactions'); ?></a></li>

                                    <li><a class="<?php echo e(menuActive('user.change.password')); ?>" href="<?php echo e(route('user.change.password')); ?>"><?php echo app('translator')->get('Change Password'); ?></a>
                                    </li>
                                    <li><a class="<?php echo e(menuActive('user.twofactor')); ?>" href="<?php echo e(route('user.twofactor')); ?>"><?php echo app('translator')->get('2FA Security'); ?></a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <div class="nav-right">
                        <?php if(auth()->guard()->check()): ?>
                            <a class="btn btn-sm btn--danger me-sm-3 me-2 btn--capsule px-3 text-white" href="<?php echo e(route('user.logout')); ?>"><?php echo app('translator')->get('Logout'); ?></a>
                        <?php else: ?>
                            <a class="btn btn-sm btn--base me-sm-3 me-2 btn--capsule px-3" href="<?php echo e(route('user.login')); ?>"><?php echo app('translator')->get('Login'); ?></a>
                            <a class="fs--14px me-sm-3 me-2 text-white" href="<?php echo e(route('user.register')); ?>"><?php echo app('translator')->get('Register'); ?></a>
                        <?php endif; ?>
                        <select class="language-select langSel">
                            <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->code); ?>" <?php if(session('lang') == $item->code): ?> selected <?php endif; ?>>
                                    <?php echo e(__($item->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </nav>
        </div>
    </div><!-- header__bottom end -->
</header>
<?php /**PATH /Users/jobayedsumon/Client/dlottery/core/resources/views/templates/basic/partials/auth_header.blade.php ENDPATH**/ ?>