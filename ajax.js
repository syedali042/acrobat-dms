function myFunction(val){

    var xmlhttp;
    if(window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
    }else
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){

        if(this.readyState==4 && this.status==200){
            document.getElementById('dept_field').innerHTML=xmlhttp.responseText;
        }

    }

    xmlhttp.open("GET", "ajax.php?dept_name="+val, true);
    xmlhttp.send();

}
