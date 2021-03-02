<?

Class view {

    public static function getPost($value,$accinfo)
    {
        ?>
        <div class="card separator-top lite_shadow">
				<div class="mobile-card card-body row ">
						<a class="hook dflex col-12" href="/id/<?=$value['autor']?>">
							<div class="fleft avatar feed-logo">
								<img class="lite_shadow rounded-circle" src="<?=getimg('/core/storage/profile/'.$value['autor'].'/main.jpg',140,140);?>"/>
							</div>
							<div class="post_card_lefted">
								<span class="heading-text post_author"><?=$accinfo['name'].' '.$accinfo['surname'];?></span>
								<p><?=HumanDatePrecise($value['time']);?></p>
							</div>
						</a>
						<div class="col-12">
                                                    <span><?=$value['post']?></span>
                                                    <hr class="small-divider post-separator">
                                                    <div class="btn_like fleft" href="/feed/">
                                                        <i class="post_btn fa fa-heart<?=likes::isLiked(1, session::$current_session_id, $value['id'])?' liked':'';?>"></i>
                                                        <span class="post_btn"><?=likes::countLikes(1, $value['id'])?></span>
                                                    </div>
                                                    <i class="post_btn fa fa-comment comment_btn"></i><span class="post_btn">0</span>
                                                    <div class="fright">
                                                            <i class="post_btn fa fa-eye"></i>
                                                            <span class=""><?=$value['views']?></span>
                                                    </div>
						</div>
						
				</div>
			  </div>
                          <?
    }

    public static function init_page() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
                <meta name="description" content="">
                <meta name="author" content="">
                <link rel="icon" href="<?= ASSET_LIB_PATH ?>/media/favicon.ico"> 
                <title>ВТеме</title> 
                <!-- Bootstrap core CSS -->
                <!--<link href="" rel="stylesheet">-->
                <!-- Custom styles for this template -->
                <!--<link href="" rel="stylesheet">-->

                <link href="<?
                echo minify::getMerged(array(minify::getcss(ASSET_LIB_PATH . '/css/bootstrap.css'),
                    minify::getcss(ASSET_LIB_PATH . '/css/font-awesome.css'),
                    //minify::getcss(ASSET_LIB_PATH.'/fonts/css/solid.css',false),
                    //minify::getcss(ASSET_LIB_PATH.'/fonts/css/fontawesome.css',false),
                    minify::getcss(ASSET_LIB_PATH . '/css/theme.scss'),
                        ), ASSET_LIB_PATH . '/css/style.css');
                ?>" rel="stylesheet">

            </head>
            <?
        }

        public static function getHeader($dynamic = false) {
            if ($dynamic)
                $acc = Account::getAccInfo(session::isAuthorized());
            ?>

            <body>
                <div class='full-width centered loading '><div class=lds-spinner><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>
                <header>
                    <nav class="navbar navbar-expand-md navbar-light fixed-top bl-light lite_shadow">
                        <a class="navbar-brand for-desktop" href="/">ВТеме</a>

                        <button class="navbar-toggler btn-main-menu collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
        <? if ($dynamic && session::isAuthorized()) { ?>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                                <ul class="navbar-nav mr-auto">
                                </ul>

                                <form action="/search/" method="POST" class="form-inline mt-2 mt-md-0" autocomplete="off">
                                    <div class="form-search mr-sm-2 full-width">
                                        <input class="no-out input-search" type="text" placeholder="Поиск" name="query" aria-label="Search">
                                    </div>
                                    <!--<button class="btn btn-primary my-2 my-sm-0" type="submit">Поиск</button>-->
                                </form>

                                <div class="col-12 for-mobile separator-top main-icons">
                                    <div class="row lefted">
                                        <a href="/id/" class="hook col-3"><img class="header-avatar rounded-circle lite_shadow" width="100%" src="<?= getimg('/core/storage/profile/' . session::isAuthorized() . '/main.jpg', 220, 220); ?>"/></a>


                                        <a href="/id/" class="hook col-7 header-text centerted-hor"><?= $acc['name'] . ' ' . $acc['surname']; ?><p>Online</p></a>

                                        <a href="/logout" class="dblock col-2 centerted-hor">
                                            <div class="">
                                                <i class="header-text fas fa-sign-out-alt">
                                                </i>
                                            </div>
                                        </a>

                                        <div class="col-12 separator-top"></div>

                                        <a href="/feed/" class="hook col-3 centered main-menu-item">
                                            <i class="header-text fas fa-newspaper-o"></i>
                                            <span class="badge badge-icons">3</span>
                                        </a>
                                        <a href="/im/" class="hook col-3 centered main-menu-item">
                                            <i class="header-text fas fa-comment"></i>
                                            <span class="badge badge-icons">2</span>
                                        </a>
                                        <a href="/friends/" class="hook col-3 centered main-menu-item">
                                            <i class="header-text fas fa-users"></i>
                                            <span class="badge badge-icons"><?= friends::friendsCount(session::isAuthorized()) ?></span>
                                        </a>
                                        <a href="/music/" class="hook col-3 centered">
                                            <i class="header-text fas fa-music"></i>
                                            <span class="badge badge-icons">88</span>
                                        </a>			
                                    </div>

                                </div>
                            </div>
        <? } ?>
                    </nav>
                </header>

                <main role="main" class="split_content">
                    <div class="container-fluid separator-in-top">
                        <div class="row">
                                <?= Page::show_menu($dynamic); ?>

                            <div id="page-content" class="row">
                                <?
                            }

                            public static function getFooter() {
                                ?>
                            </div><!-- /#page-content -->	
                        </div><!-- /.col-md-10 -->  
                        <!-- /END THE FEATURETTES -->
                    </div><!-- /.row -->

                </div><!-- /.container -->
            </main>





            <script src="<?
                                echo minify::getMerged(array(minify::getjs(ASSET_LIB_PATH . '/js/jquery.slim.min.js'),
                                    minify::getjs(ASSET_LIB_PATH . '/js/jqsearch.js'),
                                    minify::getjs(ASSET_LIB_PATH . '/js/popper.min.js'),
                                    minify::getjs(ASSET_LIB_PATH . '/js/bootstrap.min.js'),
                                    //minify::getjs(ASSET_LIB_PATH.'/js/jquery.isotope.js'),
                                    minify::getjs(ASSET_LIB_PATH . '/js/jquery.form.js'),
                                    minify::getjs(ASSET_LIB_PATH . '/js/wteme.js'),
                                        ), ASSET_LIB_PATH . '/js/min/script.js');
                                ?>"></script>
            <script>
        <?= JS::$additional; ?>
            </script>
        </body>
        </html>
        <?
    }

}
?>