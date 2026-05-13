<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar" style="background-color:#426f7f">
        <a href="" class="flex mr-auto">
            <?php
                $logo = DB::table('systemflag')
                    ->where('name', 'AdminLogo')
                    ->select('value')
                    ->first();
            ?>
            <img alt="Midone - HTML Admin Template" class="w-6" src="/<?php echo e($logo->value); ?>">
        </a>
        <a href="javascript:;" class="mobile-menu-toggler">
            <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
    </div>
    <div class="scrollable">
        <a href="javascript:;" class="mobile-menu-toggler">
            <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
        <ul class="scrollable__content py-2">
            <?php
                  $appName = DB::table('systemflag')
                    ->where('name', 'professionTitle')
                    ->select('value')
                    ->first();

                    $side_menu = [];
                    $user = auth()->user();
                    $teamMember = DB::table('teammember')
                        ->where('userId', $user->id)
                        ->first();
                    $pages = [];
                    if ($teamMember) {
                        $rolePages = DB::table('rolepages')
                            ->join('adminpages', 'adminpages.id', 'rolepages.adminPageId')
                            ->where('teamRoleId', $teamMember->teamRoleId)
                            ->select('adminpages.*')
                            ->get();
                        $pageGroup = DB::table('adminpages')
                            ->whereNull('pageGroup')
                            ->get();
                        for ($i = 0; $i < count($pageGroup); $i++) {
                            $pages = DB::table('adminpages')
                                ->where('pageGroup', $pageGroup[$i]->id)
                                ->get();
                            $pageGroup[$i]->sub_menu = [];
                            if ($pages && count($pages) > 0) {
                                for ($j = 0; $j < count($rolePages); $j++) {
                                    $id = $rolePages[$j]->id;
                                    $result = array_filter(json_decode($pages), function ($event) use ($id) {
                                        return $event->id === $id;
                                    });
                                    if ($result && count($result) > 0) {
                                        array_push($pageGroup[$i]->sub_menu, $rolePages[$j]);
                                    }
                                }
                            }
                        }
                        for ($i = 0; $i < count($pageGroup); $i++) {
                            if ($pageGroup[$i]->sub_menu && count($pageGroup[$i]->sub_menu) > 0) {
                                array_push($side_menu, $pageGroup[$i]);
                            }
                        }
                        $parentPages = DB::table('rolepages')
                            ->join('adminpages', 'adminpages.id', 'rolepages.adminPageId')
                            ->where('teamRoleId', $teamMember->teamRoleId)
                            ->whereNull('adminpages.pageGroup')
                            ->select('adminpages.*')
                            ->get();
                        $side_menu = array_merge($side_menu, json_decode($parentPages));
                    } else {
                        $pageGroup = DB::table('adminpages')
                            ->whereNull('pageGroup')
                            ->get();
                        for ($i = 0; $i < count($pageGroup); $i++) {
                            $pages = DB::table('adminpages')
                                ->where('pageGroup', $pageGroup[$i]->id)
                                ->get();
                            $pageGroup[$i]->sub_menu = [];
                            if ($pages && count($pages) > 0) {
                                $pageGroup[$i]->sub_menu = $pages;
                            }
                        }
                        $side_menu = $pageGroup;
                    }
                    $side_menu = collect( $side_menu);
                    $side_menu =  $side_menu->sortBy('displayOrder');
                ?>
            <?php $__currentLoopData = $side_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuKey => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($menu == 'devider'): ?>
                    <li class="menu__devider my-6"></li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo e(isset($menu->route) ? route($menu->route) : 'javascript:;'); ?>"
                            class="<?php echo e($first_level_active_index == $menuKey ? 'menu menu--active' : 'menu'); ?>">
                            <div class="menu__icon">
                                <i data-lucide="<?php echo e($menu->icon); ?>"></i>
                            </div>
                            <div class="menu__title">
                                <?php if($menu->pageName=='Astrologers'): ?>
                                <?php echo e($appName->value); ?>

                                <?php else: ?>
                                <?php echo e($menu->pageName); ?>

                                <?php endif; ?>
                                <?php if(isset($menu->sub_menu) && count($menu->sub_menu) > 0): ?>
                                    <i data-lucide="chevron-down"
                                        class="menu__sub-icon <?php echo e($first_level_active_index == $menuKey ? 'transform rotate-180' : ''); ?>"></i>
                                <?php endif; ?>
                            </div>
                        </a>
                        <?php if(isset($menu->sub_menu)): ?>
                            <ul class="<?php echo e($first_level_active_index == $menuKey ? 'menu__sub-open' : ''); ?>">
                                <?php $__currentLoopData = $menu->sub_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subMenuKey => $subMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(isset($subMenu->route) ? route($subMenu->route) : 'javascript:;'); ?>"
                                            class="<?php echo e($second_level_active_index == $subMenuKey ? 'menu menu--active' : 'menu'); ?>">
                                            <div class="menu__icon">
                                                <i data-lucide="<?php echo e($subMenu->icon); ?>"></i>
                                            </div>
                                            <div class="menu__title">
                                                <?php if(preg_match('/Astrologer(s)?/i', $subMenu->pageName)): ?>
                                                <?php echo e(preg_replace('/Astrologer(s)?/i',$appName->value, $subMenu->pageName)); ?>

                                                <?php else: ?>
                                                    <?php echo e($subMenu->pageName); ?>

                                                <?php endif; ?>
                                                <?php if(isset($subMenu->sub_menu)): ?>
                                                    <i data-lucide="chevron-down"
                                                        class="menu__sub-icon <?php echo e($second_level_active_index == $subMenuKey ? 'transform rotate-180' : ''); ?>"></i>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                        <?php if(isset($subMenu->sub_menu)): ?>
                                            <ul
                                                class="<?php echo e($second_level_active_index == $subMenuKey ? 'menu__sub-open' : ''); ?>">
                                                <?php $__currentLoopData = $subMenu->sub_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lastSubMenuKey => $lastSubMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e(isset($lastSubMenu->route) ? route($lastSubMenu->route) : 'javascript:;'); ?>"
                                                            class="<?php echo e($third_level_active_index == $lastSubMenuKey ? 'menu menu--active' : 'menu'); ?>">
                                                            <div class="menu__icon">
                                                                <i data-lucide="zap"></i>
                                                            </div>
                                                            <div class="menu__title"><?php echo e($lastSubMenu->pageName); ?></div>
                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<!-- END: Mobile Menu -->
<?php /**PATH /home/happylifevastu/public_html/resources/views////layout/components/mobile-menu.blade.php ENDPATH**/ ?>