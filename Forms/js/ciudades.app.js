

function getCiudades(){
    console.log("cargando datos...");
    url=rutaJSON+"ciudades/json.php";
    $.getJSON(url, function(data, status){
      localStorage.setItem('ciudades',JSON.stringify(data));
    });
    ciudades=JSON.parse(localStorage.getItem('ciudades'));
    if (ciudades==null)
    {
        ciudades=[];
    }
}
function getCiudadById(cid)
    {
        for (var i = 0; i < ciudades.length; i++) {
            if (ciudades[i].id==cid)
                {
                    return i;
                }
        }
        return -1;
    }
function getCiudadNameById(cid)
    {
        for (var i = 0; i < ciudades.length; i++) {
          machi = ciudades[i].ciudad;
            if (ciudades[i].id==cid)
                {
                  machi = ciudades[i].ciudad;
                    return machi;
                }
        }
    }
function saveCiudades(){
    let p={
        "id":document.getElementById('idx').value,
        "ciudad": document.getElementById('ciudad').value
        }
      //
      console.log("save ciudades");
      url=rutaJSON+"ciudades/api.php";
     console.log(url);
      $.post(url,p,
      function(data, status){

      });
      iniciarApp();
      showListCiudades();
}

function deleteCiudades(e)
    {
    console.log("borrar ciudades...");
    let idxe=e.target.attributes["data-id"].value;
    url=rutaJSON+"ciudades/api.php?mod=delete&id="+idxe;
    console.log(url);
    $.get(url,function(data, status){
    //alert("Data: " + data + "\nStatus: " + status);
    //iniciarCiudades()
  });
  iniciarApp();
  showListCiudades();
  }
