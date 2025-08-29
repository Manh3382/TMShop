<?php

function construct() {
    load_model('index');
    load('lib', 'validation');
}

function indexAction() {
    load_view('index');
}

function detailAction() {
    load_view('index');
}

function addAction() {
    
}

function editAction() {
    
}

//function updateAction(){
//    $data['title_page'] = "Trang cập nhật";
//    load_view('update', $data);
//}

function addPostAction(){
    load_view('addPost');
}

function listPostAction(){
    load_view('listPost');
}

function listCatAction(){
    load_view('listCat');
}