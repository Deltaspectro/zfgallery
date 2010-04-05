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
    //GET param	
  //$picturename = $this->getRequest()->getParam('picturename');
  $picturename="son.jpg";
   if(!copy("ftp/". $picturename, "images/".$picturename)) {echo "ERROR, the picture not exist!!";}
		   else{
		   	//get EXIF data 
		   $exif = exif_read_data("images/".$picturename, 'IFD0');
		
		    if($exif===false){echo "No header data found.<br />\n" . "Image contains headers<br />\n";}
			    else{
						  $exif = exif_read_data("images/".$picturename, 0, true);
						  $date= $exif['IFD0']['DateTime'];
						  echo "date: ".$date;
						/*echo $picturename.":<br />\n";
						foreach ($exif as $key => $section) {
						    foreach ($section as $name => $val) {
						        echo "$key.$name: $val<br />\n";
						    }
						}*/
						
						
			    			try
							{
							    	
							$thumb = new Model_Thumbnail("images/".$picturename);
							$thumb->resize(100,100);
							$thumb->save("images/thumbnails/".$picturename, 100);
							}
							catch (Exception $e)
							{
							     echo "ERROR!: " . $e->getMessage() . "\n";
							}
							
							//SAVE DATA
							$picdataOBj = new stdClass;
							$picdataOBj->filename = $picturename;
							$picdataOBj->date = $date;

							
							$pic = new Model_DbTable_Picture();
							$pic->setPictureData($picdataOBj);
							
			    
			    }
		
		
		   }
    }


}
