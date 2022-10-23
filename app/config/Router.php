<?php

$this->get(
    '/',
    'PagesController@home'
);

$this->get(
    '/post_single',
    'PagesController@singlePost'
);
