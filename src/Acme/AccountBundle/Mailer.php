<?php

namespace Acme\AccountBundle;

class Mailer
{
    //Constructor 
    public function __construct($mailer,$template)
    {
        echo $mailer;
		echo $template;
    }
}