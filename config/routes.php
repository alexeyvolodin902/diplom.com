<?php

return array(
    //admin
    'saveSlide'=>'adminSlider/saveSlide',
    'addSlide'=>'adminSlider/addSlide',
    'deleteSlide/([0-9]+)'=>'adminSlider/deleteSlide/$1',
    'editSlide/([0-9]+)'=>'adminSlider/editSlide/$1',
    'editSlider'=>'adminSlider/index',
    'auth/exit'=>"admin/exit",
    'auth'=>'admin/auth',
    'admin'=>"admin/index",
    //site
    'contacts' => 'contacts/index', //actionIndex in ContactsController
    'addQuestion' => 'contacts/AddQuestion',
    'addReview' => 'review/AddReview',
    'review/page-([0-9]+)' => 'review/review/$1', //actionReview in ReviewController with 1 parameters
    'stock/([0-9]+)' => 'stock/view/$1', //actionView in StockController with 1 parameters

    'album/([0-9]+)' => 'albums/album/$1', //actionAlbum в AlbumsController

    'stock/page-([0-9]+)' => 'stock/index/$1', //actionIndex in StockController with parameter for paginator
    'service' => 'service/index', //actionIndex in ServiceController
    'albums' => 'albums/index',
    '([a-zA-z0-9]+)' => 'site/index',
    '' => 'site/index',
);