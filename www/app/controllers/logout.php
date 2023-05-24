<?php

if(isset($_SESSION['USER']))
{
	unset($_SESSION['USER']);
}
redirect('login');