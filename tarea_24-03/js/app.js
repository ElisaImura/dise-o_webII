var num=5;
console.log("Tabla del",num);
for(var i=1; i<11; i++){
  console.log(num+"x"+i+"="+num*i);
}

var array=[1,5];
if(array[0]>array[1]){
  console.log("Es imposible realizar la petición.");
}else {
  for(var i=array[0]; i<=array[1]; i++){
    console.log("Tabla del",i);
    for(var x=1; x<11; x++){
      console.log(i+"x"+x+"="+i*x);
    }
  }
}
