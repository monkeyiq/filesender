<?php

include_once "pagemenuitem.php";

$maybe_display_aggregate_statistics_menu = false;


?>



<div class="col-12">
    <nav class="nav nav-pills nav-fill ">

            <?php
            
            if(!Auth::isGuest()) {
                pagemenuitem('upload');
                
                pagemenuitem('guests');
                
                pagemenuitem('transfers');
                
                if(Config::get('user_page'))
                    pagemenuitem('user');
                
                pagemenuitem('statistics');
                
                pagemenuitem('admin');

                if( $maybe_display_aggregate_statistics_menu ) {
                    if (AggregateStatistic::enabled()) {
                        pagemenuitem('aggregate_statistics');
                    }
                }
                    
            }
            
            pagemenuitem('help');
            pagemenuitem('about');
            pagemenuitem('privacy');

            if (Auth::isAuthenticated() && Auth::isSP())
            {
                $url = AuthSP::logoffURL();
                if($url) {
                    $faicon = 'fa-sign-out';
                    $icon = '<i class="fa '.$faicon.'"></i> ';
                    
                    echo '<a class="p-2 text-muted" href="'.Utilities::sanitizeOutput($url).'" id="topmenu_logoff">'.$icon.Lang::tr('logoff').'</a>';
                }
            }
            else if (!Auth::isGuest())
            {
                $faicon = 'fa-sign-in';
                $icon = '<i class="fa '.$faicon.'"></i> ';
                
                if(Config::get('auth_sp_embedded')) {
                    pagemenuitem('logon');
                }else{
                    echo '<a class="p-2 text-muted" href="'.Utilities::sanitizeOutput(AuthSP::logonURL()).'" id="topmenu_logon">'.$icon.Lang::tr('logon').'</a>';
                }
            }
        ?>

    </nav>
</div>

</header>
</div>

<div class="container">
<div id="wrap">

