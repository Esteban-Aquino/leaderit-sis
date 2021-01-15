<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ($SERV === 'clientes') {
    if ($metodo === 'POST') {
        require_once $api_path . 'clientes/CLIENTES_INS.php';
    } else if ($metodo === 'DELETE') {
        require_once $api_path . 'clientes/CLIENTES_DEL.php';
    } else if ($metodo === 'PUT') {
        require_once $api_path . 'clientes/CLIENTES_UPD.php';
    } else if ($metodo === 'GET') {
        require_once $api_path . 'clientes/CLIENTES_GET.php';
    } else {
        require_once $api_path . 'metodoNoEncontrado.php';
    }
} else {
    require_once $api_path . 'servicioNoEncontrado.php';
}
