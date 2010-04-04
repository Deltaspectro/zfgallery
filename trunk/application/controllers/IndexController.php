<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    //	$this->getHelper('viewRenderer')->setNoRender();
    }

    
 /**
  * Copy picture from FTP folder to images folder
  * get exif data
  * Convert 'real' jpg
  * thumbnail
  */
    public function indexAction()
    {
        // action body
    
    if (!copy('ftp/kep.jpg', 'images/kep.jpg')) {
    echo "failed to copy $file...\n";
}
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

