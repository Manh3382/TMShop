<?php

function construct() {
    load_model('index');
//    load('lib', 'validation');
}

function indexAction() {
    load_view('index');
}

function updateAction() {
    $id = $_POST['id'];
    echo $id;
}

function listOrderAction(){
    load_View('listOrder');
}

function listCustomerAction(){
    load_View('listCustomer');
}