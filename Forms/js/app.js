personas=[]; // declara el array
document.getElementById('btNuevo').onclick=nuevoRegistro;
document.getElementById('btCargar').onclick=cargarTabla;
document.getElementById('btLimpiar').onclick=limpiarTabla; // asigno la funcion limpiarTabla al evento click del boton
document.getElementById('btProcesar').onclick=procesarForm;
window.onload=iniciarApp;

function iniciarApp()
{
  cargarDatos();
  cargarTabla();
}


function cargarDatos() // carga datos de prueba al array Persona
{
  console.log("cargando datos...");

  personas=JSON.parse(localStorage.getItem('personas'));
  /*personas.push({"nombre": "Rafael", "apellido":"Escobar", "docnro":"4584860", "fenac":"1998-09-14" });
  personas.push({"nombre": "Lizandro", "apellido":"Britto", "docnro":"5610802", "fenac":"2002-11-20" });
  personas.push({"nombre": "Jazmin", "apellido":"Meza", "docnro":"6038277", "fenac":"2003-04-14" });*/

  if(personas==null){
  	console.log("personas es null");
  	personas=[];
  	console.log(personas);
  }
}

//console.log(personas);
//iniciarApp();
function limpiarTabla() //limpia el contenido html de datos
{
//  var salida=document.getElementById('tab_datos').innerHTML;
  document.getElementById('tab_datos').innerHTML="";
  console.log("limpiando");
}
function cargarTabla()
  {
    console.log("cargando");
    salida="";
    for (var i = 0; i < personas.length; i++) {
        console.log("girando");
        salida=salida+"<tr><td>"+i+"</td><td>"+personas[i].docnro+"</td><td>"+personas[i].apellido+"</td><td>"+personas[i].nombre+"</td><td>"+personas[i].fenac+"</td> <td><a class='btEditar btn btn-outline-warning ' data-idx='"+i+"'>Editar</a></td> <td><a class='btBorrar btn btn-outline-danger ' data-idx='"+i+"'>Borrar</a></td></tr>"
        //console.log(salida);
      }
      document.getElementById('tab_datos').innerHTML=salida;
      btns=document.getElementsByClassName('btEditar');
      for (var i = 0; i < btns.length; i++) {
        btns[i].onclick=editarForm;
      }

      btns=document.getElementsByClassName('btBorrar');
      for (var i = 0; i < btns.length; i++) {
        btns[i].onclick=borrarRegistro;
      }
  }

  function nuevoRegistro ()
  {
    document.getElementById('idx').value="-1";
    document.getElementById('docnro').value="";
    document.getElementById('apellido').value="";
    document.getElementById('nombre').value="";
    document.getElementById('fenac').value="";
    document.getElementById('docnro').focus();

  }
//Limpiar form
function limpiarForm(){
	document.getElementById('idx').value="";
    document.getElementById('docnro').value="";
    document.getElementById('apellido').value="";
    document.getElementById('nombre').value="";
    document.getElementById('fenac').value="";
    document.getElementById('docnro').focus();
}


//editarForm
function editarForm(e)
{
  //console.log(e);
  let idxe=e.target.attributes["data-idx"].value;
  //console.log(idxe);
  document.getElementById('idx').value=idxe;
  document.getElementById('docnro').value=personas[idxe].docnro;
  document.getElementById('apellido').value=personas[idxe].apellido;
  document.getElementById('nombre').value=personas[idxe].nombre;
  //document.getElementById('fenac').value=new Date(personas[idxe].fenac);
  document.getElementById('fenac').value=personas[idxe].fenac;
//document.getElementById('fenac').value='30/07/1234'
//console.log(personas[idxe].fenac);
//console.log(document.getElementById('fenac'));
  document.getElementById('docnro').focus();
}

//borrarForm
function borrarRegistro(e){
	//console.log(e);
  	let idxe=e.target.attributes["data-idx"].value;

  	personas.splice(idxe,1);
  	limpiarTabla();
  	cargarTabla();
  	persistirRegistros();
}



/// procesar formulario
function procesarForm()
{
  let idx=document.getElementById('idx').value;
  if (idx==-1)
    {
    personas.push({"nombre": document.getElementById('nombre').value, "apellido":document.getElementById('apellido').value, "docnro":document.getElementById('docnro').value, "fenac":document.getElementById('fenac').value });
    }
    else {
      personas[idx].docnro=document.getElementById('docnro').value;
      personas[idx].nombre=document.getElementById('nombre').value;
      personas[idx].apellido=document.getElementById('apellido').value;
      personas[idx].fenac=document.getElementById('fenac').value;
    }
    limpiarTabla();
    cargarTabla();
    limpiarForm();
    persistirRegistros();

}




//  cargarDatos();
function pruebas()
   {
     console.log("probando");
     var botones=document.getElementsByClassName('btn');
     //console.log(botones);
     for (var i = 0; i < botones.length; i++) {
       botones[i].classList.add("btn-outline-info");
     }


   }


   function persistirRegistros(){
   	localStorage.setItem('personas',JSON.stringify(personas));
   }