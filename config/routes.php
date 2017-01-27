<?php

return array(
    'auth'=>"admin/auth",
    'admin' => 'admin/index',
    '([a-zA-z0-9]+)' => 'site/index',
    '' => 'site/index',
    '(.+)'=>'site/index',
);