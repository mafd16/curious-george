Mafd16 / Curious George
==================================

A Stack Overflow replica as examination for the course Ramverk1 at Blekinge Institute of Technology

[![Build Status](https://travis-ci.org/mafd16/curious-george.svg?branch=master)](https://travis-ci.org/mafd16/curious-george)
[![Build Status](https://scrutinizer-ci.com/g/mafd16/curious-george/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mafd16/curious-george/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mafd16/curious-george/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mafd16/curious-george/?branch=master)

Mafd16 Curious George.

Check-out and Install
=====================

Use Git to clone the repository. Find link above.

Run Composer update
-------------------
    composer update

Fix some code
-------------

Insert/replace the following into vendor/anax/page/src/Page/PageRender.php

    $data["stylesheets"] = [
        "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css",
        "https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.1/css/bulma.min.css"
    ];

and

    $view->add("blocks/navbar", [], "navbar");
    $view->add("blocks/header", [], "header");
    $view->add("blocks/footer", [], "footer");

Set up and configure an sqlite database
------------------------------------------

    chmod 777 data

    sqlite3 data/db.sqlite < sql/ddl/curious_george_sqlite.sql
    chmod 666 data/db.sqlite


License
------------------

This software carries a MIT license.



```
Copyright (c) 2017 Martin Fagerlund (mngfagerlund@gmail.com)
```
