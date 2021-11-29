<?php
	ob_start();
	include ('converter/PdfToText.phpclass') ;

	require("converter/doc2txt.class.php");

	include 'includes/database.php';
			function readWord($filename) {
			  if(file_exists($filename))
			  {
			      if(($fh = fopen($filename, 'r')) !== false ) 
			      {
			         $headers = fread($fh, 0xA00);

			         // 1 = (ord(n)*1) ; Document has from 0 to 255 characters
			         $n1 = ( ord($headers[0x21C]) - 1 );

			         // 1 = ((ord(n)-8)*256) ; Document has from 256 to 63743 characters
			         $n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );

			         // 1 = ((ord(n)*256)*256) ; Document has from 63744 to 16775423 characters
			         $n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );

			         // 1 = (((ord(n)*256)*256)*256) ; Document has from 16775424 to 4294965504 characters
			         $n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );

			         // Total length of text in the document
			         $textLength = ($n1 + $n2 + $n3 + $n4);

			         $extracted_plaintext = fread($fh, $textLength);

			         // if you want to see your paragraphs in a new line, do this
			         // return nl2br($extracted_plaintext);
			         return $extracted_plaintext;
			      } else {
			        return false;
			      }
			  } else {
			    return false;
			  }  
			}

	if(isset($_POST['action']) && $_POST['action']=='searchInFile'){

		$selectFiles = mysqli_query($con, "select * from files");
		$adminFileName = array();
		while($adminFiles = mysqli_fetch_assoc($selectFiles)){
			$adminFileName[] = $adminFiles;
		}
		$gotFiles = array();
		$fileRow = array();
		$get = $_POST['searchedStr'];
		foreach ($adminFileName as $key => $valu) {
			$v = $valu['file'];
			if(pathinfo($v, PATHINFO_EXTENSION)=='docx'){
				$filePath = 'files/'.$v;
				$docObj = new Doc2Txt($filePath);
				$txt = $docObj->convertToText();
				if (strpos($txt, $get) !== false) {
					$gotFiles[] = $filePath;
					$fileRow[] = $valu;
				}
			}else if(pathinfo($v, PATHINFO_EXTENSION)=='doc'){
				$filePath = 'files/'.$v;
				$txt = readWord($filePath);
				if (strpos($txt, $get) !== false) {
					$gotFiles[] = $filePath;
					$fileRow[] = $valu;
				}
			}
			else if(pathinfo($v, PATHINFO_EXTENSION)=='pdf'){
				$filePath = 'files/'.$v;
				$pdf	=  new PdfToText ($filePath);
				$n = nl2br($pdf);
				if (strpos($n, $get) !== false) {
					$gotFiles[] = $filePath;
					$fileRow[] = $valu;
				}
			}			
		}
		ob_clean();
		// echo json_encode('ali');
		echo json_encode(array('status'=>true, 'data'=>$gotFiles, 'fileRow'=>$fileRow));
	
	}

?>
