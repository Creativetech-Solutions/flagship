<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-anu/init.php");
  
  if (!$user->levelCheck("1,2,3,4,5,6,7,9"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

include_once('header.php');

site_header('Dashboard');
?>
                    <?php include ('profile.php'); ?>
                    <?php include ('navigation.php'); ?>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">                     
                <?php include ('vert-navigation.php'); ?>
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>                    
                    <li class="active">Dashboard</li>
                    <li>ANU</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <!-- START WIDGETS -->                    
                    <div class="row">
                        <div class="col-md-12">

                            <div class="alert alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <strong>Important!</strong> Press on any icon to get code.
                            </div>

                            <!-- START FONT AWESOME ICONS -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Font Awesome</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">

                                    <ul class="icons-list">
                                        <li><i class="fa fa-adjust"></i> fa-adjust</li>

                                        <li><i class="fa fa-anchor"></i> fa-anchor</li>

                                        <li><i class="fa fa-archive"></i> fa-archive</li>

                                        <li><i class="fa fa-arrows"></i> fa-arrows</li>

                                        <li><i class="fa fa-arrows-h"></i> fa-arrows-h</li>

                                        <li><i class="fa fa-arrows-v"></i> fa-arrows-v</li>

                                        <li><i class="fa fa-asterisk"></i> fa-asterisk</li>

                                        <li><i class="fa fa-ban"></i> fa-ban</li>

                                        <li><i class="fa fa-bar-chart-o"></i> fa-bar-chart-o</li>

                                        <li><i class="fa fa-barcode"></i> fa-barcode</li>

                                        <li><i class="fa fa-bars"></i> fa-bars</li>

                                        <li><i class="fa fa-beer"></i> fa-beer</li>

                                        <li><i class="fa fa-bell"></i> fa-bell</li>

                                        <li><i class="fa fa-bell-o"></i> fa-bell-o</li>

                                        <li><i class="fa fa-bolt"></i> fa-bolt</li>

                                        <li><i class="fa fa-book"></i> fa-book</li>

                                        <li><i class="fa fa-bookmark"></i> fa-bookmark</li>

                                        <li><i class="fa fa-bookmark-o"></i> fa-bookmark-o</li>

                                        <li><i class="fa fa-briefcase"></i> fa-briefcase</li>

                                        <li><i class="fa fa-bug"></i> fa-bug</li>

                                        <li><i class="fa fa-building-o"></i> fa-building-o</li>

                                        <li><i class="fa fa-bullhorn"></i> fa-bullhorn</li>

                                        <li><i class="fa fa-bullseye"></i> fa-bullseye</li>

                                        <li><i class="fa fa-calendar"></i> fa-calendar</li>

                                        <li><i class="fa fa-calendar-o"></i> fa-calendar-o</li>

                                        <li><i class="fa fa-camera"></i> fa-camera</li>

                                        <li><i class="fa fa-camera-retro"></i> fa-camera-retro</li>

                                        <li><i class="fa fa-caret-square-o-down"></i> fa-caret-square-o-down</li>

                                        <li><i class="fa fa-caret-square-o-left"></i> fa-caret-square-o-left</li>

                                        <li><i class="fa fa-caret-square-o-right"></i> fa-caret-square-o-right</li>

                                        <li><i class="fa fa-caret-square-o-up"></i> fa-caret-square-o-up</li>

                                        <li><i class="fa fa-certificate"></i> fa-certificate</li>

                                        <li><i class="fa fa-check"></i> fa-check</li>

                                        <li><i class="fa fa-check-circle"></i> fa-check-circle</li>

                                        <li><i class="fa fa-check-circle-o"></i> fa-check-circle-o</li>

                                        <li><i class="fa fa-check-square"></i> fa-check-square</li>

                                        <li><i class="fa fa-check-square-o"></i> fa-check-square-o</li>

                                        <li><i class="fa fa-circle"></i> fa-circle</li>

                                        <li><i class="fa fa-circle-o"></i> fa-circle-o</li>

                                        <li><i class="fa fa-clock-o"></i> fa-clock-o</li>

                                        <li><i class="fa fa-cloud"></i> fa-cloud</li>

                                        <li><i class="fa fa-cloud-download"></i> fa-cloud-download</li>

                                        <li><i class="fa fa-cloud-upload"></i> fa-cloud-upload</li>

                                        <li><i class="fa fa-code"></i> fa-code</li>

                                        <li><i class="fa fa-code-fork"></i> fa-code-fork</li>

                                        <li><i class="fa fa-coffee"></i> fa-coffee</li>

                                        <li><i class="fa fa-cog"></i> fa-cog</li>

                                        <li><i class="fa fa-cogs"></i> fa-cogs</li>

                                        <li><i class="fa fa-comment"></i> fa-comment</li>

                                        <li><i class="fa fa-comment-o"></i> fa-comment-o</li>

                                        <li><i class="fa fa-comments"></i> fa-comments</li>

                                        <li><i class="fa fa-comments-o"></i> fa-comments-o</li>

                                        <li><i class="fa fa-compass"></i> fa-compass</li>

                                        <li><i class="fa fa-credit-card"></i> fa-credit-card</li>

                                        <li><i class="fa fa-crop"></i> fa-crop</li>

                                        <li><i class="fa fa-crosshairs"></i> fa-crosshairs</li>

                                        <li><i class="fa fa-cutlery"></i> fa-cutlery</li>

                                        <li><i class="fa fa-dashboard"></i> fa-dashboard <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-desktop"></i> fa-desktop</li>

                                        <li><i class="fa fa-dot-circle-o"></i> fa-dot-circle-o</li>

                                        <li><i class="fa fa-download"></i> fa-download</li>

                                        <li><i class="fa fa-edit"></i> fa-edit <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-ellipsis-h"></i> fa-ellipsis-h</li>

                                        <li><i class="fa fa-ellipsis-v"></i> fa-ellipsis-v</li>

                                        <li><i class="fa fa-envelope"></i> fa-envelope</li>

                                        <li><i class="fa fa-envelope-o"></i> fa-envelope-o</li>

                                        <li><i class="fa fa-eraser"></i> fa-eraser</li>

                                        <li><i class="fa fa-exchange"></i> fa-exchange</li>

                                        <li><i class="fa fa-exclamation"></i> fa-exclamation</li>

                                        <li><i class="fa fa-exclamation-circle"></i> fa-exclamation-circle</li>

                                        <li><i class="fa fa-exclamation-triangle"></i> fa-exclamation-triangle</li>

                                        <li><i class="fa fa-external-link"></i> fa-external-link</li>

                                        <li><i class="fa fa-external-link-square"></i> fa-external-link-square</li>

                                        <li><i class="fa fa-eye"></i> fa-eye</li>

                                        <li><i class="fa fa-eye-slash"></i> fa-eye-slash</li>

                                        <li><i class="fa fa-female"></i> fa-female</li>

                                        <li><i class="fa fa-fighter-jet"></i> fa-fighter-jet</li>

                                        <li><i class="fa fa-film"></i> fa-film</li>

                                        <li><i class="fa fa-filter"></i> fa-filter</li>

                                        <li><i class="fa fa-fire"></i> fa-fire</li>

                                        <li><i class="fa fa-fire-extinguisher"></i> fa-fire-extinguisher</li>

                                        <li><i class="fa fa-flag"></i> fa-flag</li>

                                        <li><i class="fa fa-flag-checkered"></i> fa-flag-checkered</li>

                                        <li><i class="fa fa-flag-o"></i> fa-flag-o</li>

                                        <li><i class="fa fa-flash"></i> fa-flash <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-flask"></i> fa-flask</li>

                                        <li><i class="fa fa-folder"></i> fa-folder</li>

                                        <li><i class="fa fa-folder-o"></i> fa-folder-o</li>

                                        <li><i class="fa fa-folder-open"></i> fa-folder-open</li>

                                        <li><i class="fa fa-folder-open-o"></i> fa-folder-open-o</li>

                                        <li><i class="fa fa-frown-o"></i> fa-frown-o</li>

                                        <li><i class="fa fa-gamepad"></i> fa-gamepad</li>

                                        <li><i class="fa fa-gavel"></i> fa-gavel</li>

                                        <li><i class="fa fa-gear"></i> fa-gear <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-gears"></i> fa-gears <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-gift"></i> fa-gift</li>

                                        <li><i class="fa fa-glass"></i> fa-glass</li>

                                        <li><i class="fa fa-globe"></i> fa-globe</li>

                                        <li><i class="fa fa-group"></i> fa-group <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-hdd-o"></i> fa-hdd-o</li>

                                        <li><i class="fa fa-headphones"></i> fa-headphones</li>

                                        <li><i class="fa fa-heart"></i> fa-heart</li>

                                        <li><i class="fa fa-heart-o"></i> fa-heart-o</li>

                                        <li><i class="fa fa-home"></i> fa-home</li>

                                        <li><i class="fa fa-inbox"></i> fa-inbox</li>

                                        <li><i class="fa fa-info"></i> fa-info</li>

                                        <li><i class="fa fa-info-circle"></i> fa-info-circle</li>

                                        <li><i class="fa fa-key"></i> fa-key</li>

                                        <li><i class="fa fa-keyboard-o"></i> fa-keyboard-o</li>

                                        <li><i class="fa fa-laptop"></i> fa-laptop</li>

                                        <li><i class="fa fa-leaf"></i> fa-leaf</li>

                                        <li><i class="fa fa-legal"></i> fa-legal <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-lemon-o"></i> fa-lemon-o</li>

                                        <li><i class="fa fa-level-down"></i> fa-level-down</li>

                                        <li><i class="fa fa-level-up"></i> fa-level-up</li>

                                        <li><i class="fa fa-lightbulb-o"></i> fa-lightbulb-o</li>

                                        <li><i class="fa fa-location-arrow"></i> fa-location-arrow</li>

                                        <li><i class="fa fa-lock"></i> fa-lock</li>

                                        <li><i class="fa fa-magic"></i> fa-magic</li>

                                        <li><i class="fa fa-magnet"></i> fa-magnet</li>

                                        <li><i class="fa fa-mail-forward"></i> fa-mail-forward <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-mail-reply"></i> fa-mail-reply <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-mail-reply-all"></i> fa-mail-reply-all</li>

                                        <li><i class="fa fa-male"></i> fa-male</li>

                                        <li><i class="fa fa-map-marker"></i> fa-map-marker</li>

                                        <li><i class="fa fa-meh-o"></i> fa-meh-o</li>

                                        <li><i class="fa fa-microphone"></i> fa-microphone</li>

                                        <li><i class="fa fa-microphone-slash"></i> fa-microphone-slash</li>

                                        <li><i class="fa fa-minus"></i> fa-minus</li>

                                        <li><i class="fa fa-minus-circle"></i> fa-minus-circle</li>

                                        <li><i class="fa fa-minus-square"></i> fa-minus-square</li>

                                        <li><i class="fa fa-minus-square-o"></i> fa-minus-square-o</li>

                                        <li><i class="fa fa-mobile"></i> fa-mobile</li>

                                        <li><i class="fa fa-mobile-phone"></i> fa-mobile-phone <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-money"></i> fa-money</li>

                                        <li><i class="fa fa-moon-o"></i> fa-moon-o</li>

                                        <li><i class="fa fa-music"></i> fa-music</li>

                                        <li><i class="fa fa-pencil"></i> fa-pencil</li>

                                        <li><i class="fa fa-pencil-square"></i> fa-pencil-square</li>

                                        <li><i class="fa fa-pencil-square-o"></i> fa-pencil-square-o</li>

                                        <li><i class="fa fa-phone"></i> fa-phone</li>

                                        <li><i class="fa fa-phone-square"></i> fa-phone-square</li>

                                        <li><i class="fa fa-picture-o"></i> fa-picture-o</li>

                                        <li><i class="fa fa-plane"></i> fa-plane</li>

                                        <li><i class="fa fa-plus"></i> fa-plus</li>

                                        <li><i class="fa fa-plus-circle"></i> fa-plus-circle</li>

                                        <li><i class="fa fa-plus-square"></i> fa-plus-square</li>

                                        <li><i class="fa fa-plus-square-o"></i> fa-plus-square-o</li>

                                        <li><i class="fa fa-power-off"></i> fa-power-off</li>

                                        <li><i class="fa fa-print"></i> fa-print</li>

                                        <li><i class="fa fa-puzzle-piece"></i> fa-puzzle-piece</li>

                                        <li><i class="fa fa-qrcode"></i> fa-qrcode</li>

                                        <li><i class="fa fa-question"></i> fa-question</li>

                                        <li><i class="fa fa-question-circle"></i> fa-question-circle</li>

                                        <li><i class="fa fa-quote-left"></i> fa-quote-left</li>

                                        <li><i class="fa fa-quote-right"></i> fa-quote-right</li>

                                        <li><i class="fa fa-random"></i> fa-random</li>

                                        <li><i class="fa fa-refresh"></i> fa-refresh</li>

                                        <li><i class="fa fa-reply"></i> fa-reply</li>

                                        <li><i class="fa fa-reply-all"></i> fa-reply-all</li>

                                        <li><i class="fa fa-retweet"></i> fa-retweet</li>

                                        <li><i class="fa fa-road"></i> fa-road</li>

                                        <li><i class="fa fa-rocket"></i> fa-rocket</li>

                                        <li><i class="fa fa-rss"></i> fa-rss</li>

                                        <li><i class="fa fa-rss-square"></i> fa-rss-square</li>

                                        <li><i class="fa fa-search"></i> fa-search</li>

                                        <li><i class="fa fa-search-minus"></i> fa-search-minus</li>

                                        <li><i class="fa fa-search-plus"></i> fa-search-plus</li>

                                        <li><i class="fa fa-share"></i> fa-share</li>

                                        <li><i class="fa fa-share-square"></i> fa-share-square</li>

                                        <li><i class="fa fa-share-square-o"></i> fa-share-square-o</li>

                                        <li><i class="fa fa-shield"></i> fa-shield</li>

                                        <li><i class="fa fa-shopping-cart"></i> fa-shopping-cart</li>

                                        <li><i class="fa fa-sign-in"></i> fa-sign-in</li>

                                        <li><i class="fa fa-sign-out"></i> fa-sign-out</li>

                                        <li><i class="fa fa-signal"></i> fa-signal</li>

                                        <li><i class="fa fa-sitemap"></i> fa-sitemap</li>

                                        <li><i class="fa fa-smile-o"></i> fa-smile-o</li>

                                        <li><i class="fa fa-sort"></i> fa-sort</li>

                                        <li><i class="fa fa-sort-alpha-asc"></i> fa-sort-alpha-asc</li>

                                        <li><i class="fa fa-sort-alpha-desc"></i> fa-sort-alpha-desc</li>

                                        <li><i class="fa fa-sort-amount-asc"></i> fa-sort-amount-asc</li>

                                        <li><i class="fa fa-sort-amount-desc"></i> fa-sort-amount-desc</li>

                                        <li><i class="fa fa-sort-asc"></i> fa-sort-asc</li>

                                        <li><i class="fa fa-sort-desc"></i> fa-sort-desc</li>

                                        <li><i class="fa fa-sort-down"></i> fa-sort-down <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-sort-numeric-asc"></i> fa-sort-numeric-asc</li>

                                        <li><i class="fa fa-sort-numeric-desc"></i> fa-sort-numeric-desc</li>

                                        <li><i class="fa fa-sort-up"></i> fa-sort-up <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-spinner"></i> fa-spinner</li>

                                        <li><i class="fa fa-square"></i> fa-square</li>

                                        <li><i class="fa fa-square-o"></i> fa-square-o</li>

                                        <li><i class="fa fa-star"></i> fa-star</li>

                                        <li><i class="fa fa-star-half"></i> fa-star-half</li>

                                        <li><i class="fa fa-star-half-empty"></i> fa-star-half-empty <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-star-half-full"></i> fa-star-half-full <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-star-half-o"></i> fa-star-half-o</li>

                                        <li><i class="fa fa-star-o"></i> fa-star-o</li>

                                        <li><i class="fa fa-subscript"></i> fa-subscript</li>

                                        <li><i class="fa fa-suitcase"></i> fa-suitcase</li>

                                        <li><i class="fa fa-sun-o"></i> fa-sun-o</li>

                                        <li><i class="fa fa-superscript"></i> fa-superscript</li>

                                        <li><i class="fa fa-tablet"></i> fa-tablet</li>

                                        <li><i class="fa fa-tachometer"></i> fa-tachometer</li>

                                        <li><i class="fa fa-tag"></i> fa-tag</li>

                                        <li><i class="fa fa-tags"></i> fa-tags</li>

                                        <li><i class="fa fa-tasks"></i> fa-tasks</li>

                                        <li><i class="fa fa-terminal"></i> fa-terminal</li>

                                        <li><i class="fa fa-thumb-tack"></i> fa-thumb-tack</li>

                                        <li><i class="fa fa-thumbs-down"></i> fa-thumbs-down</li>

                                        <li><i class="fa fa-thumbs-o-down"></i> fa-thumbs-o-down</li>

                                        <li><i class="fa fa-thumbs-o-up"></i> fa-thumbs-o-up</li>

                                        <li><i class="fa fa-thumbs-up"></i> fa-thumbs-up</li>

                                        <li><i class="fa fa-ticket"></i> fa-ticket</li>

                                        <li><i class="fa fa-times"></i> fa-times</li>

                                        <li><i class="fa fa-times-circle"></i> fa-times-circle</li>

                                        <li><i class="fa fa-times-circle-o"></i> fa-times-circle-o</li>

                                        <li><i class="fa fa-tint"></i> fa-tint</li>

                                        <li><i class="fa fa-toggle-down"></i> fa-toggle-down <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-toggle-left"></i> fa-toggle-left <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-toggle-right"></i> fa-toggle-right <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-toggle-up"></i> fa-toggle-up <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-trash-o"></i> fa-trash-o</li>

                                        <li><i class="fa fa-trophy"></i> fa-trophy</li>

                                        <li><i class="fa fa-truck"></i> fa-truck</li>

                                        <li><i class="fa fa-umbrella"></i> fa-umbrella</li>

                                        <li><i class="fa fa-unlock"></i> fa-unlock</li>

                                        <li><i class="fa fa-unlock-alt"></i> fa-unlock-alt</li>

                                        <li><i class="fa fa-unsorted"></i> fa-unsorted <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-upload"></i> fa-upload</li>

                                        <li><i class="fa fa-user"></i> fa-user</li>

                                        <li><i class="fa fa-users"></i> fa-users</li>

                                        <li><i class="fa fa-video-camera"></i> fa-video-camera</li>

                                        <li><i class="fa fa-volume-down"></i> fa-volume-down</li>

                                        <li><i class="fa fa-volume-off"></i> fa-volume-off</li>

                                        <li><i class="fa fa-volume-up"></i> fa-volume-up</li>

                                        <li><i class="fa fa-warning"></i> fa-warning <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-wheelchair"></i> fa-wheelchair</li>

                                        <li><i class="fa fa-wrench"></i> fa-wrench</li>

                                    </ul>

                                    <h4>Form Control Icons</h4>
                                    <ul class="icons-list">

                                        <li><i class="fa fa-check-square"></i> fa-check-square</li>

                                        <li><i class="fa fa-check-square-o"></i> fa-check-square-o</li>

                                        <li><i class="fa fa-circle"></i> fa-circle</li>

                                        <li><i class="fa fa-circle-o"></i> fa-circle-o</li>

                                        <li><i class="fa fa-dot-circle-o"></i> fa-dot-circle-o</li>

                                        <li><i class="fa fa-minus-square"></i> fa-minus-square</li>

                                        <li><i class="fa fa-minus-square-o"></i> fa-minus-square-o</li>

                                        <li><i class="fa fa-plus-square"></i> fa-plus-square</li>

                                        <li><i class="fa fa-plus-square-o"></i> fa-plus-square-o</li>

                                        <li><i class="fa fa-square"></i> fa-square</li>

                                        <li><i class="fa fa-square-o"></i> fa-square-o</li>

                                    </ul>

                                    <h4>Currency Icons</h4>
                                    <ul class="icons-list">        
                                        <li><i class="fa fa-bitcoin"></i> fa-bitcoin <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-btc"></i> fa-btc</li>

                                        <li><i class="fa fa-cny"></i> fa-cny <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-dollar"></i> fa-dollar <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-eur"></i> fa-eur</li>

                                        <li><i class="fa fa-euro"></i> fa-euro <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-gbp"></i> fa-gbp</li>

                                        <li><i class="fa fa-inr"></i> fa-inr</li>

                                        <li><i class="fa fa-jpy"></i> fa-jpy</li>

                                        <li><i class="fa fa-krw"></i> fa-krw</li>

                                        <li><i class="fa fa-money"></i> fa-money</li>

                                        <li><i class="fa fa-rmb"></i> fa-rmb <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-rouble"></i> fa-rouble <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-rub"></i> fa-rub</li>

                                        <li><i class="fa fa-ruble"></i> fa-ruble <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-rupee"></i> fa-rupee <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-try"></i> fa-try</li>

                                        <li><i class="fa fa-turkish-lira"></i> fa-turkish-lira <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-usd"></i> fa-usd</li>

                                        <li><i class="fa fa-won"></i> fa-won <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-yen"></i> fa-yen <span class="text-muted">(alias)</span></li>    
                                    </ul>

                                    <h4>Text Editor Icons</h4>
                                    <ul class="icons-list">

                                        <li><i class="fa fa-align-center"></i> fa-align-center</li>

                                        <li><i class="fa fa-align-justify"></i> fa-align-justify</li>

                                        <li><i class="fa fa-align-left"></i> fa-align-left</li>

                                        <li><i class="fa fa-align-right"></i> fa-align-right</li>

                                        <li><i class="fa fa-bold"></i> fa-bold</li>

                                        <li><i class="fa fa-chain"></i> fa-chain <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-chain-broken"></i> fa-chain-broken</li>

                                        <li><i class="fa fa-clipboard"></i> fa-clipboard</li>

                                        <li><i class="fa fa-columns"></i> fa-columns</li>

                                        <li><i class="fa fa-copy"></i> fa-copy <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-cut"></i> fa-cut <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-dedent"></i> fa-dedent <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-eraser"></i> fa-eraser</li>

                                        <li><i class="fa fa-file"></i> fa-file</li>

                                        <li><i class="fa fa-file-o"></i> fa-file-o</li>

                                        <li><i class="fa fa-file-text"></i> fa-file-text</li>

                                        <li><i class="fa fa-file-text-o"></i> fa-file-text-o</li>

                                        <li><i class="fa fa-files-o"></i> fa-files-o</li>

                                        <li><i class="fa fa-floppy-o"></i> fa-floppy-o</li>

                                        <li><i class="fa fa-font"></i> fa-font</li>

                                        <li><i class="fa fa-indent"></i> fa-indent</li>

                                        <li><i class="fa fa-italic"></i> fa-italic</li>

                                        <li><i class="fa fa-link"></i> fa-link</li>

                                        <li><i class="fa fa-list"></i> fa-list</li>

                                        <li><i class="fa fa-list-alt"></i> fa-list-alt</li>

                                        <li><i class="fa fa-list-ol"></i> fa-list-ol</li>

                                        <li><i class="fa fa-list-ul"></i> fa-list-ul</li>

                                        <li><i class="fa fa-outdent"></i> fa-outdent</li>

                                        <li><i class="fa fa-paperclip"></i> fa-paperclip</li>

                                        <li><i class="fa fa-paste"></i> fa-paste <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-repeat"></i> fa-repeat</li>

                                        <li><i class="fa fa-rotate-left"></i> fa-rotate-left <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-rotate-right"></i> fa-rotate-right <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-save"></i> fa-save <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-scissors"></i> fa-scissors</li>

                                        <li><i class="fa fa-strikethrough"></i> fa-strikethrough</li>

                                        <li><i class="fa fa-table"></i> fa-table</li>

                                        <li><i class="fa fa-text-height"></i> fa-text-height</li>

                                        <li><i class="fa fa-text-width"></i> fa-text-width</li>

                                        <li><i class="fa fa-th"></i> fa-th</li>

                                        <li><i class="fa fa-th-large"></i> fa-th-large</li>

                                        <li><i class="fa fa-th-list"></i> fa-th-list</li>

                                        <li><i class="fa fa-underline"></i> fa-underline</li>

                                        <li><i class="fa fa-undo"></i> fa-undo</li>

                                        <li><i class="fa fa-unlink"></i> fa-unlink <span class="text-muted">(alias)</span></li>

                                    </ul>

                                    <h4>Directional Icons</h4>
                                    <ul class="icons-list">

                                        <li><i class="fa fa-angle-double-down"></i> fa-angle-double-down</li>

                                        <li><i class="fa fa-angle-double-left"></i> fa-angle-double-left</li>

                                        <li><i class="fa fa-angle-double-right"></i> fa-angle-double-right</li>

                                        <li><i class="fa fa-angle-double-up"></i> fa-angle-double-up</li>

                                        <li><i class="fa fa-angle-down"></i> fa-angle-down</li>

                                        <li><i class="fa fa-angle-left"></i> fa-angle-left</li>

                                        <li><i class="fa fa-angle-right"></i> fa-angle-right</li>

                                        <li><i class="fa fa-angle-up"></i> fa-angle-up</li>

                                        <li><i class="fa fa-arrow-circle-down"></i> fa-arrow-circle-down</li>

                                        <li><i class="fa fa-arrow-circle-left"></i> fa-arrow-circle-left</li>

                                        <li><i class="fa fa-arrow-circle-o-down"></i> fa-arrow-circle-o-down</li>

                                        <li><i class="fa fa-arrow-circle-o-left"></i> fa-arrow-circle-o-left</li>

                                        <li><i class="fa fa-arrow-circle-o-right"></i> fa-arrow-circle-o-right</li>

                                        <li><i class="fa fa-arrow-circle-o-up"></i> fa-arrow-circle-o-up</li>

                                        <li><i class="fa fa-arrow-circle-right"></i> fa-arrow-circle-right</li>

                                        <li><i class="fa fa-arrow-circle-up"></i> fa-arrow-circle-up</li>

                                        <li><i class="fa fa-arrow-down"></i> fa-arrow-down</li>

                                        <li><i class="fa fa-arrow-left"></i> fa-arrow-left</li>

                                        <li><i class="fa fa-arrow-right"></i> fa-arrow-right</li>

                                        <li><i class="fa fa-arrow-up"></i> fa-arrow-up</li>

                                        <li><i class="fa fa-arrows"></i> fa-arrows</li>

                                        <li><i class="fa fa-arrows-alt"></i> fa-arrows-alt</li>

                                        <li><i class="fa fa-arrows-h"></i> fa-arrows-h</li>

                                        <li><i class="fa fa-arrows-v"></i> fa-arrows-v</li>

                                        <li><i class="fa fa-caret-down"></i> fa-caret-down</li>

                                        <li><i class="fa fa-caret-left"></i> fa-caret-left</li>

                                        <li><i class="fa fa-caret-right"></i> fa-caret-right</li>

                                        <li><i class="fa fa-caret-square-o-down"></i> fa-caret-square-o-down</li>

                                        <li><i class="fa fa-caret-square-o-left"></i> fa-caret-square-o-left</li>

                                        <li><i class="fa fa-caret-square-o-right"></i> fa-caret-square-o-right</li>

                                        <li><i class="fa fa-caret-square-o-up"></i> fa-caret-square-o-up</li>

                                        <li><i class="fa fa-caret-up"></i> fa-caret-up</li>

                                        <li><i class="fa fa-chevron-circle-down"></i> fa-chevron-circle-down</li>

                                        <li><i class="fa fa-chevron-circle-left"></i> fa-chevron-circle-left</li>

                                        <li><i class="fa fa-chevron-circle-right"></i> fa-chevron-circle-right</li>

                                        <li><i class="fa fa-chevron-circle-up"></i> fa-chevron-circle-up</li>

                                        <li><i class="fa fa-chevron-down"></i> fa-chevron-down</li>

                                        <li><i class="fa fa-chevron-left"></i> fa-chevron-left</li>

                                        <li><i class="fa fa-chevron-right"></i> fa-chevron-right</li>

                                        <li><i class="fa fa-chevron-up"></i> fa-chevron-up</li>

                                        <li><i class="fa fa-hand-o-down"></i> fa-hand-o-down</li>

                                        <li><i class="fa fa-hand-o-left"></i> fa-hand-o-left</li>

                                        <li><i class="fa fa-hand-o-right"></i> fa-hand-o-right</li>

                                        <li><i class="fa fa-hand-o-up"></i> fa-hand-o-up</li>

                                        <li><i class="fa fa-long-arrow-down"></i> fa-long-arrow-down</li>

                                        <li><i class="fa fa-long-arrow-left"></i> fa-long-arrow-left</li>

                                        <li><i class="fa fa-long-arrow-right"></i> fa-long-arrow-right</li>

                                        <li><i class="fa fa-long-arrow-up"></i> fa-long-arrow-up</li>

                                        <li><i class="fa fa-toggle-down"></i> fa-toggle-down <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-toggle-left"></i> fa-toggle-left <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-toggle-right"></i> fa-toggle-right <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-toggle-up"></i> fa-toggle-up <span class="text-muted">(alias)</span></li>

                                    </ul>

                                    <h4>Video Player Icons</h4>
                                    <ul class="icons-list">

                                        <li><i class="fa fa-arrows-alt"></i> fa-arrows-alt</li>

                                        <li><i class="fa fa-backward"></i> fa-backward</li>

                                        <li><i class="fa fa-compress"></i> fa-compress</li>

                                        <li><i class="fa fa-eject"></i> fa-eject</li>

                                        <li><i class="fa fa-expand"></i> fa-expand</li>

                                        <li><i class="fa fa-fast-backward"></i> fa-fast-backward</li>

                                        <li><i class="fa fa-fast-forward"></i> fa-fast-forward</li>

                                        <li><i class="fa fa-forward"></i> fa-forward</li>

                                        <li><i class="fa fa-pause"></i> fa-pause</li>

                                        <li><i class="fa fa-play"></i> fa-play</li>

                                        <li><i class="fa fa-play-circle"></i> fa-play-circle</li>

                                        <li><i class="fa fa-play-circle-o"></i> fa-play-circle-o</li>

                                        <li><i class="fa fa-step-backward"></i> fa-step-backward</li>

                                        <li><i class="fa fa-step-forward"></i> fa-step-forward</li>

                                        <li><i class="fa fa-stop"></i> fa-stop</li>

                                        <li><i class="fa fa-youtube-play"></i> fa-youtube-play</li>

                                    </ul>

                                    <h4>Brand Icons</h4>
                                    <ul class="icons-list">

                                        <li><i class="fa fa-adn"></i> fa-adn</li>

                                        <li><i class="fa fa-android"></i> fa-android</li>

                                        <li><i class="fa fa-apple"></i> fa-apple</li>

                                        <li><i class="fa fa-bitbucket"></i> fa-bitbucket</li>

                                        <li><i class="fa fa-bitbucket-square"></i> fa-bitbucket-square</li>

                                        <li><i class="fa fa-bitcoin"></i> fa-bitcoin <span class="text-muted">(alias)</span></li>

                                        <li><i class="fa fa-btc"></i> fa-btc</li>

                                        <li><i class="fa fa-css3"></i> fa-css3</li>

                                        <li><i class="fa fa-dribbble"></i> fa-dribbble</li>

                                        <li><i class="fa fa-dropbox"></i> fa-dropbox</li>

                                        <li><i class="fa fa-facebook"></i> fa-facebook</li>

                                        <li><i class="fa fa-facebook-square"></i> fa-facebook-square</li>

                                        <li><i class="fa fa-flickr"></i> fa-flickr</li>

                                        <li><i class="fa fa-foursquare"></i> fa-foursquare</li>

                                        <li><i class="fa fa-github"></i> fa-github</li>

                                        <li><i class="fa fa-github-alt"></i> fa-github-alt</li>

                                        <li><i class="fa fa-github-square"></i> fa-github-square</li>

                                        <li><i class="fa fa-gittip"></i> fa-gittip</li>

                                        <li><i class="fa fa-google-plus"></i> fa-google-plus</li>

                                        <li><i class="fa fa-google-plus-square"></i> fa-google-plus-square</li>

                                        <li><i class="fa fa-html5"></i> fa-html5</li>

                                        <li><i class="fa fa-instagram"></i> fa-instagram</li>

                                        <li><i class="fa fa-linkedin"></i> fa-linkedin</li>

                                        <li><i class="fa fa-linkedin-square"></i> fa-linkedin-square</li>

                                        <li><i class="fa fa-linux"></i> fa-linux</li>

                                        <li><i class="fa fa-maxcdn"></i> fa-maxcdn</li>

                                        <li><i class="fa fa-pagelines"></i> fa-pagelines</li>

                                        <li><i class="fa fa-pinterest"></i> fa-pinterest</li>

                                        <li><i class="fa fa-pinterest-square"></i> fa-pinterest-square</li>

                                        <li><i class="fa fa-renren"></i> fa-renren</li>

                                        <li><i class="fa fa-skype"></i> fa-skype</li>

                                        <li><i class="fa fa-stack-exchange"></i> fa-stack-exchange</li>

                                        <li><i class="fa fa-stack-overflow"></i> fa-stack-overflow</li>

                                        <li><i class="fa fa-trello"></i> fa-trello</li>

                                        <li><i class="fa fa-tumblr"></i> fa-tumblr</li>

                                        <li><i class="fa fa-tumblr-square"></i> fa-tumblr-square</li>

                                        <li><i class="fa fa-twitter"></i> fa-twitter</li>

                                        <li><i class="fa fa-twitter-square"></i> fa-twitter-square</li>

                                        <li><i class="fa fa-vimeo-square"></i> fa-vimeo-square</li>

                                        <li><i class="fa fa-vk"></i> fa-vk</li>

                                        <li><i class="fa fa-weibo"></i> fa-weibo</li>

                                        <li><i class="fa fa-windows"></i> fa-windows</li>

                                        <li><i class="fa fa-xing"></i> fa-xing</li>

                                        <li><i class="fa fa-xing-square"></i> fa-xing-square</li>

                                        <li><i class="fa fa-youtube"></i> fa-youtube</li>

                                        <li><i class="fa fa-youtube-play"></i> fa-youtube-play</li>

                                        <li><i class="fa fa-youtube-square"></i> fa-youtube-square</li>

                                    </ul>

                                    <h4>Medical Icons</h4>

                                    <ul class="icons-list">

                                        <li><i class="fa fa-ambulance"></i> fa-ambulance</li>

                                        <li><i class="fa fa-h-square"></i> fa-h-square</li>

                                        <li><i class="fa fa-hospital-o"></i> fa-hospital-o</li>

                                        <li><i class="fa fa-medkit"></i> fa-medkit</li>

                                        <li><i class="fa fa-plus-square"></i> fa-plus-square</li>

                                        <li><i class="fa fa-stethoscope"></i> fa-stethoscope</li>

                                        <li><i class="fa fa-user-md"></i> fa-user-md</li>

                                        <li><i class="fa fa-wheelchair"></i> fa-wheelchair</li>

                                    </ul>                                

                                </div>
                            </div>
                            <!-- END FONT AWESOME ICONS -->

                            <!-- START GLYPHICONS -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Glyphicons</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <ul class="icons-list">
                                        <li>
                                            <span class="glyphicon glyphicon-adjust"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-adjust</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-align-center"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-align-center</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-align-justify"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-align-justify</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-align-left"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-align-left</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-align-right"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-align-right</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-arrow-down"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-arrow-down</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-arrow-left"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-arrow-left</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-arrow-right"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-arrow-right</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-arrow-up"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-arrow-up</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-asterisk"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-asterisk</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-backward"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-backward</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-ban-circle"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-ban-circle</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-barcode"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-barcode</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-bell"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-bell</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-bold"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-bold</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-book"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-book</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-bookmark"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-bookmark</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-briefcase"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-briefcase</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-bullhorn"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-bullhorn</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-calendar"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-calendar</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-camera"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-camera</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-certificate"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-certificate</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-check"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-check</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-chevron-down"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-chevron-down</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-chevron-left</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-chevron-right</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-chevron-up"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-chevron-up</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-circle-arrow-down"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-circle-arrow-down</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-circle-arrow-left"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-circle-arrow-left</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-circle-arrow-right"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-circle-arrow-right</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-circle-arrow-up"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-circle-arrow-up</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-cloud"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-cloud</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-cloud-download"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-cloud-download</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-cloud-upload"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-cloud-upload</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-cog"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-cog</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-collapse-down"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-collapse-down</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-collapse-up"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-collapse-up</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-comment"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-comment</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-compressed"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-compressed</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-copyright-mark"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-copyright-mark</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-credit-card"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-credit-card</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-cutlery"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-cutlery</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-dashboard"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-dashboard</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-download"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-download</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-download-alt"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-download-alt</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-earphone"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-earphone</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-edit"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-edit</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-eject"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-eject</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-envelope"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-envelope</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-euro"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-euro</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-exclamation-sign"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-exclamation-sign</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-expand"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-expand</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-export"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-export</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-eye-close"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-eye-close</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-eye-open</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-facetime-video"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-facetime-video</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-fast-backward"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-fast-backward</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-fast-forward"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-fast-forward</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-file"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-file</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-film"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-film</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-filter"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-filter</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-fire"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-fire</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-flag"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-flag</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-flash"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-flash</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-floppy-disk"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-floppy-disk</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-floppy-open"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-floppy-open</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-floppy-remove"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-floppy-remove</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-floppy-save"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-floppy-save</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-floppy-saved"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-floppy-saved</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-folder-close"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-folder-close</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-folder-open"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-folder-open</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-font"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-font</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-forward"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-forward</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-fullscreen"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-fullscreen</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-gbp"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-gbp</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-gift"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-gift</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-glass"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-glass</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-globe"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-globe</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-hand-down"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-hand-down</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-hand-left"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-hand-left</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-hand-right"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-hand-right</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-hand-up"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-hand-up</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-hd-video"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-hd-video</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-hdd"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-hdd</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-header"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-header</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-headphones"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-headphones</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-heart"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-heart</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-heart-empty"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-heart-empty</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-home"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-home</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-import"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-import</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-inbox"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-inbox</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-indent-left"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-indent-left</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-indent-right"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-indent-right</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-info-sign"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-info-sign</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-italic"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-italic</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-leaf"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-leaf</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-link"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-link</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-list"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-list</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-list-alt"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-list-alt</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-lock"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-lock</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-log-in"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-log-in</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-log-out"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-log-out</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-magnet"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-magnet</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-map-marker"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-map-marker</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-minus"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-minus</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-minus-sign"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-minus-sign</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-move"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-move</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-music"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-music</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-new-window"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-new-window</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-off"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-off</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-ok"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-ok</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-ok-circle"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-ok-circle</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-ok-sign"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-ok-sign</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-open"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-open</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-paperclip"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-paperclip</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-pause"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-pause</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-pencil</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-phone"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-phone</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-phone-alt"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-phone-alt</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-picture"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-picture</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-plane"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-plane</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-play"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-play</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-play-circle"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-play-circle</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-plus"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-plus</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-plus-sign"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-plus-sign</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-print"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-print</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-pushpin"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-pushpin</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-qrcode"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-qrcode</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-question-sign"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-question-sign</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-random"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-random</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-record"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-record</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-refresh"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-refresh</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-registration-mark"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-registration-mark</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-remove"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-remove</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-remove-circle"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-remove-circle</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-remove-sign"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-remove-sign</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-repeat"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-repeat</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-resize-full"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-resize-full</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-resize-horizontal"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-resize-horizontal</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-resize-small"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-resize-small</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-resize-vertical"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-resize-vertical</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-retweet"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-retweet</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-road"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-road</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-save"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-save</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-saved"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-saved</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-screenshot"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-screenshot</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sd-video"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sd-video</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-search"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-search</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-send"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-send</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-share"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-share</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-share-alt"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-share-alt</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-shopping-cart"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-shopping-cart</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-signal"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-signal</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sort"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sort</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sort-by-alphabet"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sort-by-alphabet</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sort-by-alphabet-alt</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sort-by-attributes</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sort-by-attributes-alt</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sort-by-order"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sort-by-order</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sort-by-order-alt"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sort-by-order-alt</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sound-5-1"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sound-5-1</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sound-6-1"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sound-6-1</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sound-7-1"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sound-7-1</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sound-dolby"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sound-dolby</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-sound-stereo"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-sound-stereo</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-star</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-star-empty</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-stats"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-stats</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-step-backward"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-step-backward</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-step-forward"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-step-forward</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-stop"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-stop</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-subtitles"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-subtitles</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-tag"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-tag</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-tags"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-tags</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-tasks"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-tasks</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-text-height"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-text-height</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-text-width"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-text-width</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-th"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-th</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-th-large"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-th-large</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-th-list"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-th-list</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-thumbs-down"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-thumbs-down</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-thumbs-up"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-thumbs-up</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-time"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-time</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-tint"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-tint</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-tower"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-tower</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-transfer"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-transfer</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-trash"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-trash</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-tree-conifer"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-tree-conifer</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-tree-deciduous"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-tree-deciduous</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-unchecked"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-unchecked</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-upload"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-upload</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-usd"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-usd</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-user"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-user</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-volume-down"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-volume-down</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-volume-off"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-volume-off</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-volume-up"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-volume-up</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-warning-sign"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-warning-sign</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-wrench"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-wrench</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-zoom-in"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-zoom-in</span>
                                        </li>
                                        <li>
                                            <span class="glyphicon glyphicon-zoom-out"></span>
                                            <span class="glyphicon-class">glyphicon glyphicon-zoom-out</span>
                                        </li>
                                    </ul>                                                                
                                </div>

                            </div>
                            <!-- END GLYPHICONS ICONS -->

                        </div>
                    </div>
                    <!-- END WIDGETS -->    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        <!-- START MODAL ICON PREVIEW -->
        <div class="modal fade" id="iconPreview" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Icon preview</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="icon-preview"></div>
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group border-bottom">
                                    <li class="list-group-item icon-preview-span"></li>
                                    <li class="list-group-item icon-preview-i"></li>
                                    <li class="list-group-item icon-preview-class"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>                        
                    </div>
                </div>
            </div>
        </div>        
        <!-- END MODAL ICON PREVIEW -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press Yes to logout or Press No if you want to continue working.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="logout.php" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                  
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>        
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>
        
        <script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>       
        <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>                
        <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>                 
        
        <script type="text/javascript" src="js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <!--<script type="text/javascript" src="js/settings.js"></script>-->
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
        
        <script type="text/javascript" src="js/demo_dashboard.js"></script>
        <script type="text/javascript" src="js/demo_icons.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         
    </body>
</html>