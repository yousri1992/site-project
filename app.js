function showselected(){
    var option = document.getElementsByName('number');

    for ( var i =0; i< option.length; i++){
        if ( option[i].checked){
            alert("selected option" + option[i].value);
            return;
        }
    }
    alert("please select option ");
}