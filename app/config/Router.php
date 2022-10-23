<?php

$this->get(
    '/',
    'PagesController@home'
);

$this->get(
    '/post_single',// url
    'PagesController@singlePost' //controller + method

);
