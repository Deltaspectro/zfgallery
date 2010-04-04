<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    //	$this->getHelper('viewRenderer')->setNoRender();
    }

    public function indexAction()
    {
        // action body


				try
				{
				    	
				$thumb = new Model_Thumbnail('images/kutyus.jpg');
				$thumb->resize(100,100);
				$thumb->save('images/kutyusmini.jpg', 100);
				}
				catch (Exception $e)
				{
				     echo "Hiba!: " . $e->getMessage() . "\n";
				}


    }


}

