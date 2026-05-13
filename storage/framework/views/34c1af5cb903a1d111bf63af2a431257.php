<style>
/* Enhanced Footer Styles - Premium Astrology Theme */
:root {
  --gold: #c9a84c;
  --gold-light: #e0c068;
  --gold-pale: #fdf6e3;
  --dark: #1a0e05;
  --dark-mid: #2d1a08;
  --dark-card: #261507;
  --white: #ffffff;
  --cream: #faf4ea;
  --cream-mid: #f2e8d0;
  --border: #e8d5b0;
  --border-gold: #c9a84c44;
  --text-dark: #2c1a08;
  --text-mid: #6b4c22;
  --text-muted: #b08a55;
}

/* Footer Main Container */
.footer-premium {
  background: linear-gradient(180deg, var(--dark) 0%, #0d0804 100%) !important;
  position: relative;
  overflow: hidden;
}

.footer-premium::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.footer-premium::after {
  content: '✦';
  position: absolute;
  bottom: 30px;
  right: 30px;
  font-size: 70px;
  opacity: 0.03;
  color: var(--gold);
  font-family: 'Cinzel', serif;
  pointer-events: none;
}

/* Section Headers in Footer */
.footer-premium h5 {
  font-family: 'Cinzel', serif;
  font-size: 14px;
  font-weight: 600;
  color: #f5e6c8 !important;
  letter-spacing: 1px;
  padding: 0.5rem 0;
  margin-bottom: 1rem;
  border-bottom: 1px solid rgba(201, 168, 76, 0.3) !important;
  position: relative;
  display: inline-block;
}

.footer-premium h5::before {
  content: '✦';
  color: var(--gold);
  margin-right: 6px;
  font-size: 10px;
}

/* Footer Links */
.footer-premium .footer-link {
  font-size: 12px;
  color: #7a6445;
  text-decoration: none;
  transition: all 0.3s ease;
  display: inline-block;
}

.footer-premium .footer-link:hover {
  color: var(--gold);
  transform: translateX(3px);
  text-decoration: none;
}

/* List Items */
.footer-premium ul li {
  padding: 0.25rem 0;
}

.footer-premium ul li a {
  font-size: 12px;
  color: #7a6445;
  transition: all 0.3s ease;
}

.footer-premium ul li a:hover {
  color: var(--gold);
  text-decoration: none;
  transform: translateX(3px);
  display: inline-block;
}

/* Bottom Bar */
.footer-bottom-bar {
  background: rgba(0, 0, 0, 0.4);
  padding: 1rem 0;
  border-top: 1px solid rgba(201, 168, 76, 0.15);
}

.footer-bottom-bar small {
  color: #5a4025;
  font-size: 11px;
}

/* Footer Links Container */
.footer-links-container {
  display: inline-flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 5px;
}

.footer-item {
  display: inline-block;
}

.footer-item .footer-link {
  color: #5a4025;
  font-size: 11px;
  transition: color 0.3s;
}

.footer-item .footer-link:hover {
  color: var(--gold);
  transform: translateX(0);
}

.footer-item span {
  color: #5a4025;
  margin: 0 4px;
}

/* Chat Button Enhancement */
#sf_chat_button1 button {
  transition: all 0.3s ease;
  filter: drop-shadow(0 4px 12px rgba(201, 168, 76, 0.3));
}

#sf_chat_button1 button:hover {
  transform: scale(1.05);
  filter: drop-shadow(0 6px 18px rgba(201, 168, 76, 0.5));
}

#sf_chat_button1 button a img {
  border-radius: 50%;
  border: 2px solid var(--gold);
  transition: all 0.3s ease;
}

#sf_chat_button1 button:hover a img {
  border-color: var(--gold-light);
  box-shadow: 0 0 12px rgba(201, 168, 76, 0.4);
}

/* Text Colors */
.text-gray {
  color: #9CA3AF !important;
}
.text-gray-dark {
  color: #7a6445 !important;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .footer-premium h5 {
    font-size: 13px;
    margin-bottom: 0.75rem;
  }
  
  .footer-premium .footer-link,
  .footer-premium ul li a {
    font-size: 11px;
  }
  
  .footer-bottom-bar small {
    font-size: 10px;
  }
  
  .footer-links-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    text-align: center;
    gap: 8px;
    padding-top: 5px;
  }
  
  .footer-item {
    display: block;
  }
  
  .footer-links-container span {
    display: none !important;
  }
  
  .col-6 {
    padding: 10px;
  }
}

@media (max-width: 480px) {
  .footer-premium h5 {
    font-size: 12px;
  }
  
  .footer-premium .footer-link,
  .footer-premium ul li a {
    font-size: 10px;
  }
}

/* Social Icons - if needed in future */
.social-icon {
  margin: 5px;
  transition: transform 0.3s ease, opacity 0.3s ease;
}

.social-icon:hover {
  transform: scale(1.15);
  opacity: 0.85;
}

/* Smooth transitions */
.footer-premium * {
  transition: all 0.2s ease;
}

/* Border secondary override */
.border-secondary {
  border-color: rgba(201, 168, 76, 0.3) !important;
}

.d-md-inline {
  display: inline !important;
  color: #5a4025;
}

.f-icon {
  display: flex;
}
</style>

<?php
use App\Models\AstrologerModel\AstrologerCategory;
use App\Models\AiAstrologerModel\AiAstrologer;
$getAstrologerCategory = AstrologerCategory::where('isActive',1)->orderBy('id', 'DESC')->get();
$facebook = DB::table('systemflag')->where('name', 'Facebook')->select('value')->first();
$apple = DB::table('systemflag')->where('name', 'Apple')->select('value')->first();
$website = DB::table('systemflag')->where('name', 'Website')->select('value')->first();
$youtube = DB::table('systemflag')->where('name', 'Youtube')->select('value')->first();
$linkedIn = DB::table('systemflag')->where('name', 'LinkedIn')->select('value')->first();
$pintrest = DB::table('systemflag')->where('name', 'Pintrest')->select('value')->first();
$instagram = DB::table('systemflag')->where('name', 'Instagram')->select('value')->first();
$whatsapp = DB::table('systemflag')->where('name', 'Whatsapp')->select('value')->first();
$telegram = DB::table('systemflag')->where('name', 'Telegram')->select('value')->first();
$twitter = DB::table('systemflag')->where('name', 'Twitter')->select('value')->first();
$playstore = DB::table('systemflag')->where('name', 'PlayStore')->select('value')->first();
$appstore = DB::table('systemflag')->where('name', 'AppStore')->select('value')->first();
$aiAstrologer = DB::table('systemflag')->where('name', 'AiAstrologer')->select('value')->first();
$masterAstrologer = AiAstrologer::where('type', 'master')->select('image')->first();
?>

<!-- FOOTER START -->
<div id="footer" class="footer-premium" style="background: linear-gradient(180deg, #1a0e05 0%, #0d0804 100%);">
    <section class="pt-5 pb-4">
        <div class="container">
            <div class="row text-md-left g-4">
                <!-- MENU Column -->
                <div class="col-md-3 col-6 mb-4">
                    <h5 class="text-white p-2 font-16 border-bottom border-secondary">MENU</h5>
                    <ul class="list-unstyled" style="font-size: 14px">
                        <li class="p-1"><a class="footer-link" href="<?php echo e(route('front.getproducts')); ?>">Products</a></li>
                    </ul>
                     <!-- PUJARI Section - Conditional Display -->
                    <?php
                        $pujariSession = session('pujari');
                    ?>
                    
                    <?php if(!$pujariSession): ?>
                    <h5 class="text-white p-2 font-16 mt-4 border-bottom border-secondary">Pujari Section</h5>
                    <ul class="list-unstyled mt-1" style="font-size: 14px">
                        <li class="p-1"><a class="footer-link" href="<?php echo e(route('front.pujariLogin')); ?>">Pujari Login</a></li>
                        <li class="p-1"><a class="footer-link" href="<?php echo e(route('front.pujariRegister')); ?>">Pujari Registration</a></li>
                    </ul>
                    <?php else: ?>
                    <h5 class="text-white p-2 font-16 mt-4 border-bottom border-secondary">Pujari Portal</h5>
                    <ul class="list-unstyled mt-1" style="font-size: 14px">
                        <li class="p-1"><a class="footer-link" href="<?php echo e(route('front.pujariDashboard')); ?>">My Dashboard</a></li>
                        <li class="p-1"><a class="footer-link" href="<?php echo e(route('front.pujariLogout')); ?>" onclick="return confirm('Are you sure you want to logout?')">Logout</a></li>
                    </ul>
                    <?php endif; ?>
                </div>

                <!-- LINKS Column -->
                <div class="col-md-3 col-6 mb-4">
                    <h5 class="text-white p-2 font-16 border-bottom border-secondary">LINKS</h5>
                    <ul class="list-unstyled" style="font-size: 14px">
                        <li class="p-1"><a class="footer-link" href="<?php echo e(route('front.getBlog')); ?>">Go to Blog</a></li>
                        <li class="p-1"><a class="footer-link" href="<?php echo e(route('front.contact')); ?>">Contact Us</a></li>
                    </ul>
 
                    <?php if(!authcheck()): ?>
                    <h5 class="text-white p-2 font-16 mt-4 border-bottom border-secondary"><?php echo e(ucfirst($professionTitle)); ?> Section</h5>
                    <ul class="list-unstyled mt-1" style="font-size: 14px">
                        <li class="p-1"><a class="footer-link" href="<?php echo e(route('front.astrologerlogin')); ?>"><?php echo e(ucfirst($professionTitle)); ?> Login</a></li>
                        <li class="p-1"><a class="footer-link" href="<?php echo e(route('front.astrologerregister')); ?>"><?php echo e(ucfirst($professionTitle)); ?> Registration</a></li>
                    </ul>
                    <?php endif; ?>
 
                   
                </div>
 
                <!-- FEATURES Column -->
                <div class="col-md-3 col-6 mb-4">
                    <h5 class="text-white p-2 font-16 border-bottom border-secondary">GET ADVICE ON</h5>
                    <ul class="list-unstyled" style="font-size: 14px">
                        <?php $__currentLoopData = $getAstrologerCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="p-1"><a class="footer-link" href="<?php echo e(route('front.chatList',['astrologerCategoryId'=>$category->id])); ?>"><?php echo e($category->name); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

                <!-- ABOUT Column -->
                
            </div>
        </div>
    </section>

    <?php
    $isProfileComplete=false;
    if(authcheck()){
        $user = authcheck()['name'];
        $dob = authcheck()['birthDate'];
        $place_of_birth= authcheck()['birthPlace'];
        $isProfileComplete = $user && $dob && $place_of_birth;
    }
    ?>

    <?php if(!empty($aiAstrologer->value)): ?>
    <div id="sf_chat_button1" role="button" class="sf_chat_button1">
        <button data-bs-toggle="tooltip" title="Chat with master Astrologer" data-bs-placement="top" class="rounded-circle border-0 bg-transparent">
            <a class="shadow-md d-inline checkBalance" id="checkBalance">
                <img src="<?php echo e(asset($masterAstrologer->image)); ?>" width="50" height="53" alt="">
            </a>
        </button>
    </div>
    <?php endif; ?>

    <div class="footer-bottom-bar text-center py-3">
        <small class="text-gray-dark">
            Copyright © 2020-<?php echo e(date('Y')); ?>

            <?php echo e(ucfirst($appname)); ?>. All Rights Reserved |
        </small>

        <ul class="footer-links-container list-unstyled d-inline-block m-0 p-0">
            <?php $__currentLoopData = $footerPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="footer-item d-inline-block mx-1">
                <a class="text-gray-dark footer-link" href="<?php echo e($page->type ? url($page->type) : '#'); ?>">
                    <?php echo e($page->title); ?>

                </a>
                <?php if(!$loop->last): ?>
                    <span class="d-none d-md-inline">|</span>
                <?php endif; ?>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>

<!-- Additional styles for remaining elements -->
<style>
.text-gray {
    color: #D1D5DB !important;
}
.text-gray-dark {
    color: #9CA3AF !important;
}
.d-md-inline {
    display: inline !important;
    color: #5a4025;
}
#sf_chat_button1 {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}
.f-icon {
    display: flex;
}
.footer-link {
    font-size: 14px;
}
.social-icon {
    margin: 5px;
    transition: transform 0.3s ease, opacity 0.3s ease;
}
.social-icon:hover {
    transform: scale(1.15);
    opacity: 0.85;
}
#footer h5 {
    font-size: 16px;
    letter-spacing: 0.5px;
}
@media (max-width: 768px) {
    .social-icon img {
        width: 26px;
        height: 26px;
    }
}
</style>

<script>
    $('.checkBalance').on('click', function(e) {
        e.preventDefault();

        var isProfileComplete = <?php echo json_encode($isProfileComplete, 15, 512) ?>;

        if (!isProfileComplete) {
            // Profile incomplete, show SweetAlert
            Swal.fire({
                title: 'Profile Incomplete',
                text: 'Your profile is incomplete. Please provide your Date of Birth and Place of Birth.',
                icon: 'warning',
                confirmButtonText: 'Update Profile',
                showCancelButton: true,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to profile update page
                    window.location.href = "<?php echo e(route('front.getMyAccount')); ?>"; // Adjust to your profile update route
                }
            });

        }else{

        $.ajax({
            url: '<?php echo e(route("check.user.balance")); ?>',
            method: 'GET',
            success: function(response) {

                localStorage.removeItem('masterSubmitting');
                localStorage.removeItem('refreshRedirectMaster');
                localStorage.removeItem('timer');
                localStorage.removeItem('balance');
                localStorage.removeItem('reloadAftSubmit');

                if (response.status === 'success') {

                    console.log(response.balance)
                    if(response.balance !== null){
                        Swal.fire({
                            icon: 'question',
                            title: 'Confirm Action',
                            text: response.message,
                            showCancelButton: true,
                            confirmButtonText: 'OK',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Hold on!',
                                    text: 'Please do not refresh the page.',
                                    showCancelButton: true,
                                    confirmButtonText: 'OK',
                                    cancelButtonText: 'Cancel'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "<?php echo e(route('master.chat.page')); ?>";
                                    }
                                });
                            }
                        });
                    }else{
                        Swal.fire({
                            icon: 'warning',
                            title: 'Hold on!',
                            text: 'Please do not refresh the page.',
                            showCancelButton: true,
                            confirmButtonText: 'OK',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "<?php echo e(route('master.chat.page')); ?>";
                            }
                        });
                    }
                } else if (response.status === 'warning') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: response.message
                    });
                } else if (response.status === 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Access Denied',
                        text: response.message,
                        confirmButtonText: 'Log In',
                        showCancelButton: true,
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#loginSignUp').modal('show');
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong',
                    text: 'Please try again later.'
                });
            }
        });
        }
    });

</script>
<script>
    window.onload = function() {
    // if (localStorage.getItem('removeRemainingTime')) {
        localStorage.removeItem('remainingTime'); // Remove the item
        localStorage.removeItem('removeRemainingTime'); // Clear the flag
        localStorage.removeItem('refreshRedirect'); // Clear the flag
    // Other initialization code...
};

</script>
<!-- FOOTER END --><?php /**PATH /home/happylifevastu/public_html/resources/views/frontend/layout/footer.blade.php ENDPATH**/ ?>