<?php
	
	include ('converter/PdfToText.phpclass');

	require("converter/doc2txt.class.php");

	$get = 'Recruitment is a process of finding';	
	$allFiles = scandir('files');
	// echo '<input type="hidden" id="searchedText" value="'.$get.'">';
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
	foreach ($allFiles as $key => $f) {
		if($f!=='.'&&$f!=='..'){
			if(pathinfo($f, PATHINFO_EXTENSION)=='docx'){
				$docObj = new Doc2Txt('files/'.$f);
				$txt = $docObj->convertToText();
				if (strpos($txt, $get) !== false) {
					echo "<a class='filesname' href='files/".$f."'>".$f."</a><br>";
				}
			}else if(pathinfo($f, PATHINFO_EXTENSION)=='doc'){
				$txt = readWord('files/'.$f);
				if (strpos($txt, $get) !== false) {
					echo "<a class='filesname' href='files/".$f."'>".$f."</a><br>";
				}
			}
			else if(pathinfo($f, PATHINFO_EXTENSION)=='pdf'){
				$pdf	=  new PdfToText ( 'files/'.$f ) ;
				$n = nl2br ( $pdf ) ;
				if (strpos($n, $get) !== false) {
					echo "<a class='filesname' href='files/".$f."'>".$f."</a><br>";
				}
			}
			// else if(pathinfo($f, PATHINFO_EXTENSION)=='jpg' || pathinfo($f, PATHINFO_EXTENSION)=='JPG' || pathinfo($f, PATHINFO_EXTENSION)=='png' || pathinfo($f, PATHINFO_EXTENSION)=='PNG'){
			// 	echo '<input type="hidden" class="files" value="'.'files/'.$f.'">';
			// }
		}
	}


?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='assets/js/tesseract.min.js'></script>

<script type="text/javascript">
	$(document).ready(function() {
		
		var file = $(".files").map(function() {
               return $(this).val();
            }).get();

		var searchedText = $('#searchedText').val();

		file.forEach(function(filesname){
			const exampleImage = filesname;

		    const worker = Tesseract.createWorker({
		      // logger: m => console.log(m)
		    });
		    Tesseract.setLogging(true);
		    work();

		    async function work() {
		      await worker.load();
		      await worker.loadLanguage('eng');
		      await worker.initialize('eng');

		      result = await worker.recognize(exampleImage);
		      fileText = result.data.text;
		      if(fileText.includes(searchedText)){
		      	$('body').append('<a href='+filesname+'>'+filesname+'</a><br>');
		      }else{
		      	console.log('Not Found');
		      }
		      await worker.terminate();
		    }
		});

	});
</script>
 -->