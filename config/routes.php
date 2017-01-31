<?php

return array(
    'questionAdmin/([0-9]+)'=>'question/admin/$1',
    'addQuestion'=>'question/addQuestion',
    'question'=>'question/index',
    'auth'=>"admin/auth",
    'admin' => 'admin/index',
    '([a-zA-z0-9]+)' => 'site/index',
    '' => 'site/index',
    '(.+)'=>'site/index',
);