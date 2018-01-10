//variables para el wizard
$("#btnGuardarAlcance").on("click",function(){
       datos = $("#formAlcance").validate({
           ignore: ":hidden:not(select)",
           
           rules: {
               
               txtDescripcionAlcance: {
                   required: true,                
           }
           },
           messages: {
              
               txtDescripcionAlcance: {
                   required: "El campo descripcion de Alcance es requerido",
               }
               
           },
           success: function ( label, element ) {
               
               var element2 = label.siblings('div'); 
                                 
               if(element2.hasClass('btn-group')){
                   element2.attr("class","btn-group bootstrap-select form-control select valid");
               }
               
           },
           errorPlacement: function (error, element) {
               console.log('error');
               var element2 = element.siblings('div'); 
               var element3 = element.siblings('span'); 
               
               if (element2.hasClass('btn-group')) {
                   element2.attr("class","btn-group bootstrap-select form-control select error");
                   error.insertAfter(element2);
               } else {
                   
                   element3.hide();
                   error.insertAfter(element);
                   
               }
               
           }
           
       });
       $('select.select').on('change', function () {
           datos.element($(this));
           element = $(this);
           var element2 = element.siblings('div'); 
           if(element.val() > 0){
               console.log('mayor a cero');
           }else{
               if (element2.hasClass('btn-group')) {
                   element2.attr("class","btn-group bootstrap-select form-control select error");
                   error.insertAfter(element2);
               }
           }
           
       })
      
      
       if(datos.form() == true){
           $("#formAlcance").submit(); 
       }
       
   })
   
  
   //ajax guardar informacion proyecto
       $("#formAlcance").on("submit", function(e) {
           var idobjetivo = $("input[name=idobjetivo]").val();
           var txtDescripcionAlcance =   $("#txtDescripcionAlcance").val();
           var _token = $("input[name=_token]").val();
           e.preventDefault();
           $.ajax({
               url: $(this).attr("action"),
               type: $(this).attr("method"),
               data: {idobjetivo:idobjetivo, txtDescripcionAlcance:txtDescripcionAlcance, _token:_token },
               dataType : 'json',
               beforeSend : function(){
                   $.mpb('show',{value: [0,40],speed: 10,state: 'success'});
               },
               success : function(data){
                   if(data.respuesta == 'ok'){
                       $("input[name=idalcance]").val(data.codigo);
                       if(data.transaccion == 'guardar'){
                           noty({text: 'Alcance creado con exito', layout: 'topRight', type: 'success'});
                       }else{
                           noty({text: 'Alcance actualizado con exito', layout: 'topRight', type: 'success'});
                       }
                       tableObjetivosalcance.ajax.reload();
                   }
                   $.mpb('show',{value: [40,100],speed: 10,state: 'success'});
                   $.mpb('destroy');
               },
               error : function(xhr,estado){
                   $.mpb('show',{value: [40,100],speed: 10,state: 'success'});
                   $.mpb('destroy');
                   alert("!Error "+xhr.status+", reportelo al centro de computo");
                   
               }
           })
       })

       //ALCANCE 

   
//end ajax