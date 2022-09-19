<script type="text/javascript">
    //Scroll through socials
    (function($) {

        $(document).ready(function() {
            var socials = $('#main-socials-block').find('.main-socials');
            var socialsDots = $('#main-social-dots').find('.main-social-dot');
            var i = 0;
            setInterval(function() {
                if (i == socials.length) {
                    i = 0;
                }
                var j;
                if (i == socials.length - 1) {
                    
                    j = 0;
                } else {
                    j = i + 1;
                }
                var currentElement = $(socials[i]);
                var currentDot = $(socialsDots[i]);
                var nextElement = $(socials[j]);
                var nextDot = $(socialsDots[j]);

                currentElement.hide();
                currentDot.attr('style', 'background-color: #bbb;');
                nextElement.show();
                nextDot.attr('style', 'background-color: var(--text-colour);');

                i++;
            }, 15000);
        });

    })( jQuery );
</script>

<div id="main-sidebar" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 d-none d-lg-block d-xl-block d-xxl-block">
    <div id="main-discord" class="main-side-block text-center border border-light border-2 rounded-2">
        <h4><?php _e("Join our Discord server!"); ?></h3>
        <p><?php _e("We have interesting Asian Kung-Fu Generation related discussions there, and more!"); ?></p>
        <a href="https://discord.gg/mQJ4TcjM3h" target="_blank"><button type="button" class="btn btn-discord mb-2"><i class="bi bi-discord"></i><span class="main-btn-text">Join</span></button></a>
    </div>

    <div id="main-socials-block" class="main-side-block text-center border border-light border-2 rounded-2">
        <div id="main-social-1" class="main-socials">
            <a class="twitter-timeline" data-width="300" data-height="400" data-dnt="true" href="https://twitter.com/AkfgfragmentsEn?ref_src=twsrc%5Etfw">Tweets by AkfgfragmentsEn</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 
        </div>
        <div id="main-social-2" class="main-socials">
            <a class="twitter-timeline" data-width="300" data-height="400" data-dnt="true" href="https://twitter.com/AKG_information?ref_src=twsrc%5Etfw">Tweets by AKG_information</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <div id="main-social-3" class="main-socials">
            <a class="twitter-timeline" data-width="300" data-height="400" data-dnt="true" href="https://twitter.com/gotch_akg?ref_src=twsrc%5Etfw">Tweets by gotch_akg</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <div id="main-social-4" class="main-socials">
            <a class="twitter-timeline" data-width="300" data-height="400" data-dnt="true" href="https://twitter.com/kiyoshiakg?ref_src=twsrc%5Etfw">Tweets by kiyoshiakg</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <div id="main-social-dots">
            <span class="main-social-dot"></span>
            <span class="main-social-dot"></span>
            <span class="main-social-dot"></span>
            <span class="main-social-dot"></span>
        </div>
    </div>

    <script type="text/javascript">
        //Click through socials
        (function($) {

            $('.main-social-dot').on('click', function() {
                var socials = $('#main-socials-block').find('.main-socials');
                var socialsDots = $('#main-social-dots').find('.main-social-dot');

                var index = $('.main-social-dot').index(this);

                var currentIndex;
                socials.each(function() {
                    if($(this).is(':visible')) {
                        currentIndex = $(socials).index(this);
                    }
                });

                $(socials[currentIndex]).hide();
                $(socialsDots[currentIndex]).attr('style', 'background-color: #bbb;');
                $(socials[index]).show();
                $(socialsDots[index]).attr('style', 'background-color: var(--text-colour);');
            });

        })( jQuery );
    </script>

    <div id="main-ajikan-project" class="main-side-block text-center border border-light border-2 rounded-2">
        <a href="https://ajikanproject.com" target="_blank"><img class="rounded-2" src="/wp-content/themes/akfgfragments/assets/img/ajikan_project_logo.png" width="300px" height="300px"/></a>
    </div>
</div>