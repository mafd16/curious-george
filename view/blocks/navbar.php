<?php
//$me = $app->url->create();
//$about = $app->url->create("about");

//print_r($me);
//print_r($about);
//print_r($app->url->create("about"));
?>


<body>
    <script src="<?= $di->url->create("js/navbar.js") ?>"></script>
    <!--<script src="js/navbar.js"></script>-->

    <div class="container">

    <nav class="navbar is-transparent">
        <!-- Consists of the logo/link to index.php and the burger.
        Other links in the navbar is created below. -->
        <div class="navbar-brand">
            <!--<a class="navbar-item" href="http://bulma.io">Ramverk1</a>-->
            <a class="navbar-item" href=<?= $di->url->create(); ?>>Curious George</a>

            <div class="navbar-burger burger" data-target="navMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>


        <div class="navbar-menu"  id="navMenu">
            <div class="navbar-start">
                <!--<div class="navbar-item is-hoverable">-->
                    <!--<a class="navbar-link  is-active" href="/documentation/overview/start/">-->
                <a class="navbar-item " href=<?= $di->url->create("questions"); ?>>
                    Questions
                </a>
                <!--</div>-->
                <a class="navbar-item " href=<?= $di->url->create("tags"); ?>>
                    Tags
                </a>
                <a class="navbar-item " href=<?= $di->url->create("users"); ?>>
                    Users
                </a>
                <a class="navbar-item " href=<?= $di->url->create("about"); ?>>
                    About
                </a>

                <!--
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href=<?= $app->url->create("report"); ?>>
                        Rapporter
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item " href=<?= $app->url->create("report#kmom01"); ?>>
                            kmom01
                        </a>
                        <a class="navbar-item " href=<?= $app->url->create("report#kmom02"); ?>>
                            kmom02
                        </a>
                        <a class="navbar-item " href=<?= $app->url->create("report#kmom03"); ?>>
                            kmom03
                        </a>
                        <a class="navbar-item " href=<?= $app->url->create("report#kmom04"); ?>>
                            kmom04
                        </a>
                        <a class="navbar-item " href=<?= $app->url->create("report#kmom05"); ?>>
                            kmom05
                        </a>
                        <a class="navbar-item " href=<?= $app->url->create("report#kmom06"); ?>>
                            kmom06
                        </a>
                        <a class="navbar-item " href=<?= $app->url->create("report#kmom10"); ?>>
                            kmom10
                        </a>
                        <!--<hr class="navbar-divider">-->
                    <!--</div>
                </div>-->

                <!--
                <div class="navbar-item has-dropdown is-hoverable">
                    <div class="navbar-link"> Uppgifter </div>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item " href=<?= $app->url->create("remserver"); ?>>
                            Remserver
                        </a>
                        <a class="navbar-item " href=<?= $app->url->create("comment"); ?>>
                            Kommentarssystem
                        </a>
                        <a class="navbar-item " href=<?= $app->url->create("book"); ?>>
                            Books
                        </a>
                    </div>
                </div>
            -->

            </div>

            <div class="navbar-end">
            <?php if (!$di->get("session")->has("my_user_id")) : ?>
                <div class="navbar-item has-dropdown is-hoverable">
                    <div class="navbar-link"> Profil </div>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item " href=<?= $app->url->create("user/login"); ?>>
                            Logga in
                        </a>
                        <a class="navbar-item " href=<?= $app->url->create("user/create"); ?>>
                            Skapa konto
                        </a>
                    </div>
                </div>
            <?php else : ?>
                <div class="navbar-item has-dropdown is-hoverable">
                    <div class="navbar-link"> Profil </div>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item " href=<?= $app->url->create("user/profile"); ?>>
                            Profilsida
                        </a>
                        <a class="navbar-item " href=<?= $app->url->create("user/update"); ?>>
                            Uppdatera konto
                        </a>
                        <?php if ($di->get("session")->get("my_user_admin")) : ?>
                            <a class="navbar-item " href=<?= $app->url->create("user/admin"); ?>>
                                Hantera användare
                            </a>
                        <?php endif ?>
                        <a class="navbar-item " href=<?= $app->url->create("user/logout"); ?>>
                            Logga ut
                        </a>
                    </div>
                </div>



            <?php endif; ?>
            </div>

        </div>
    </nav>
</div>
