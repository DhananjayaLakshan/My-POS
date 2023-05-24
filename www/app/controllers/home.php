<?php

defined("ABSPATH") ? "":die();

if(Auth::access('cashier'))//check it is supervisor
{
	require views_path('home');

}else{

	redirect('login');
}
