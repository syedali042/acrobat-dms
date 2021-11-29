<!DOCTYPE html> 
<html> 
  
<head> 
    <title>Read Text File</title> 
</head> 
  
<body> 
    <br> 
    <?php 
        $file = 'files/130-programming.docx';
    ?>
    <input type="file" name="inputfile"
            id="inputfile" value="<?=$file?>"> 
    <pre id="output"></pre> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        
        document.getElementById('inputfile') 
            .addEventListener('load', function() { 
              
            var fr=new FileReader(); 
            fr.onload=function(){ 
                document.getElementById('output') 
                        .textContent=fr.result; 
            } 
              
            fr.readAsText(this.files[0]); 
        }) 
    });
    </script> 
</body> 
  
</html> 