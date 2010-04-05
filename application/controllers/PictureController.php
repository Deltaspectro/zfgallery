<?php

class PictureController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    //	$this->getHelper('viewRenderer')->setNoRender();
    }
    
        public function indexAction()
    {

    	//ftp dir
    	if ($handle = opendir('ftp/')) {
			    while (false !== ($file = readdir($handle))) {
			        if ($file != "." && $file != "..") {
			           // echo "$file\n<br>";
			            $filearray[]= $file;
			        }
			    }
			    closedir($handle);
			     }
			    // echo "First item: ".$filearray[0];
			     
			     $this->view->filename=$filearray[0];
			     
			     //img dir
    		if ($handle = opendir('images/thumbnails')) {
			    while (false !== ($file = readdir($handle))) {
			        if ($file != "." && $file != ".."&& $file != ".svn") {
			           // echo "$file\n<br>";
			            $imagesfilearray[]= $file;
			        }
			    }
			    closedir($handle);
			     }
			     $this->view->imagesfilearray=$imagesfilearray;
    }
    
 /**
  * Copy picture from FTP folder to images folder
  * get exif data
  * Convert 'real' jpg
  * thumbnail
  */
    public function createthumbnailAction()
    {
   $this->getHelper('viewRenderer')->setNoRender();
    //GET param	
 $picturename = $this->getRequest()->getParam('picturename');
  //$picturename="son.jpg";
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
							
							//delete file
                            unlink("ftp/".$picturename);
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
