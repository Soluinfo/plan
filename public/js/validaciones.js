/////////////////////////////////////////////////////////////////////////////
//inicio de la funcion para validar el formulario de crear catalogo de objetivos///
//////////////////////////////////////////////////////////////////////////////

$(function(){
    //variables para el wizard
        var datos;
        var lbnext = 'Guardar|siguiente';
        var lbprevious = 'Anterior';
        var lbfinal = 'Finalizar'
    //end variable
    //Inicio de funcion leaveAStepCallback para obtener el numero de step 
        function leaveAStepCallback(obj){
            var step_num= obj.attr('rel');
            return validateSteps(step_num);
        }
    //End de funcion leaveAStepCallback
   
    //ajax guardar informacion proyecto
        $("#formCatalogo").on("submit", function(e) {     
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: $(this).serialize(),
                dataType : 'json',
                beforeSend : function(){
                    $.mpb('show',{value: [0,40],speed: 10,state: 'success'});
                },
                success : function(data){
                    if(data.respuesta == 'ok'){
                        $("input[name=idcatalogoobjetivo]").val(data.codigo);
                        if(data.transaccion == 'guardar'){
                            noty({text: 'Catalogo creado con exito', layout: 'topRight', type: 'success'});
                        }else{
                            noty({text: 'Catalogo actualizado con exito', layout: 'topRight', type: 'success'});
                        }
                        
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
    //end ajax
    //validacion del paso 1 informacion general
    
    function validateStep1(){ 
        datos = $("#formCatalogo").validate({
            ignore: ":hidden:not(select)",
            
            rules: {
                txtnombre: {
                    required: true,
                    
                    maxlength: 2
                },
                dpFecha: {
                    required: true,
                },
                slEstado : {
                    required: true
                }
            },
            messages: {
                txtnombre: {
                    required: "El campo nombre de Catalogo es requerido",
                   
                    maxlength: "El campo nombre de Catalogo no puede contener mas de 2 caracteres"
                },
                dpFecha : {
                    required: "El campo fecha es requerido"
                },
                slEstado: {
                    required: "El campo estado es requerido"
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
                /*Add other (if...else...) conditions depending on your
                * validation styling requirements*/
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
       
        return datos.form();
       
    }
    //validacion del paso 2 agregar objetivos
    function validateStep3(){
        return false;
    }
    //funcion que valida en que paso se encuentra
    function validateSteps(step){
        var isStepValid = true;
        // validate step 1
        if(step == 1){
            if(validateStep1() == false ){
                isStepValid = false; 
                
            }else{
                $("#formCatalogo").submit(); 
            }
        }
    
       
        
        return isStepValid;
    }
    
    if($("#idcatalogoobjetivo").val() > 0){
        var lbnext = 'Actualizar|siguiente';
    }else{
        
    }
    $("#wizarCatalogo").smartWizard({
        labelNext : lbnext, 
        labelPrevious:'Anterior', // label for Previous button
        labelFinish:'Finalizar',  // label for Finish button                   
        // This part of code can be removed FROM
        onLeaveStep: leaveAStepCallback,// <-- TO
    });
     
});

/////////////////////////////////////////////////////////////////////////////
//fin de la funcion para validar el formulario de crear catalogo de objetivos///
//////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
//inicio de la funcion para validar el formulario de crear objetivos///
//////////////////////////////////////////////////////////////////////////////

$(function(){
    //variables para el wizard
        var datos;
        var lbnext = 'Guardar|siguiente';
        var lbprevious = 'Anterior';
        var lbfinal = 'Finalizar'
    //end variable
    //Inicio de funcion leaveAStepCallback para obtener el numero de step 
        function leaveAStepCallback(obj){
            var step_num= obj.attr('rel');
            return validateSteps(step_num);
        }
    //End de funcion leaveAStepCallback
   
    //ajax guardar informacion proyecto
        $("#formProyecto").on("submit", function(e) {     
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: $(this).serialize(),
                dataType : 'json',
                beforeSend : function(){
                    $.mpb('show',{value: [0,40],speed: 10,state: 'success'});
                },
                success : function(data){
                    if(data.respuesta == 'ok'){
                        $("input[name=idproyecto]").val(data.codigo);
                        if(data.transaccion == 'guardar'){
                            noty({text: 'Proyecto creado con exito', layout: 'topRight', type: 'success'});
                        }else{
                            noty({text: 'Proyecto actualizado con exito', layout: 'topRight', type: 'success'});
                        }
                        
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
    //end ajax
    //validacion del paso 1 informacion general
    
    function validateStep1(){ 
        datos = $("#formProyecto").validate({
            ignore: ":hidden:not(select)",
            
            rules: {
                txtnombreProyecto: {
                    required: true,
                    minlength: 2,
                    maxlength: 250
                },
                dpFechaProyecto: {
                    required: true,
                },
                slDepartamento: {
                    required: true,
                    
                },
                slEstado : {
                    required: true
                }
            },
            messages: {
                txtnombreProyecto: {
                    required: "El campo nombre de proyecto es requerido",
                    minlength: "El campo nombre de proyecto no puede contener menos de dos caracteres",
                    maxlength: "El campo nombre de proyecto no puede contener mas de 250 caracteres"
                },
                dpFechaProyecto : {
                    required: "El campo fecha es requerido"
                },
                slDepartamento: {
                    required: "El campo direccion es requierido",
                    
                },
                slEstado: {
                    required: "El campo estado es requerido"
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
                /*Add other (if...else...) conditions depending on your
                * validation styling requirements*/
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
       
        return datos.form();
       
    }
    //validacion del paso 2 agregar objetivos
    function validateStep3(){
        return false;
    }
    //funcion que valida en que paso se encuentra
    function validateSteps(step){
        var isStepValid = true;
        // validate step 1
        if(step == 1){
            if(validateStep1() == false ){
                isStepValid = false; 
                
            }else{
                $("#formProyecto").submit(); 
            }
        }
    
       
        
        return isStepValid;
    }
    
    if($("#idproyecto").val() > 0){
        var lbnext = 'Actualizar|siguiente';
    }else{
        
    }
    $("#wizarProyecto").smartWizard({
        labelNext : lbnext, 
        labelPrevious:'Anterior', // label for Previous button
        labelFinish:'Finalizar',  // label for Finish button                   
        // This part of code can be removed FROM
        onLeaveStep: leaveAStepCallback,// <-- TO
    });
     
});

/////////////////////////////////////////////////////////////////////////////
//fin de la funcion para validar el formulario de crear objetivos///
//////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////
//inicio de la funcion para validar el formulario de crear indicadores///
//////////////////////////////////////////////////////////////////////////////

$(function(){
    //variables para el wizard
        var datos;
        var lbnext = 'Guardar';
        //var lbprevious = 'Anterior';
        //var lbfinal = 'Finalizar'
    //end variable
    //Inicio de funcion leaveAStepCallback para obtener el numero de step 
        function leaveAStepCallback(obj){
            var step_num= obj.attr('rel');
            return validateSteps(step_num);
        }
    //End de funcion leaveAStepCallback
   
    //ajax guardar informacion proyecto
        $("#formIndicador").on("submit", function(e) {     
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: $(this).serialize(),
                dataType : 'json',
                beforeSend : function(){
                    $.mpb('show',{value: [0,40],speed: 10,state: 'success'});
                },
                success : function(data){
                    if(data.respuesta == 'ok'){
                        $("input[name=idindicador]").val(data.codigo);
                        if(data.transaccion == 'guardar'){
                            noty({text: 'Indicador creado con exito', layout: 'topRight', type: 'success'});
                        }else{
                            noty({text: 'Indicador actualizado con exito', layout: 'topRight', type: 'success'});
                        }
                        
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
    //end ajax
    //validacion del paso 1 informacion general
    
    function validateStep1(){ 
        datos = $("#formIndicador").validate({
            ignore: ":hidden:not(select)",
            
            rules: {
                txtnombreProyecto: {
                    required: true,
                    minlength: 2,
                    maxlength: 250
                },
                dpFechaProyecto: {
                    required: true,
                },
                slDepartamento: {
                    required: true,
                    
                },
                slEstado : {
                    required: true
                }
            },
            messages: {
                txtnombreIndicador: {
                    required: "El campo nombre de indicador es requerido",
                    minlength: "El campo nombre de indicador no puede contener menos de dos caracteres",
                    maxlength: "El campo nombre de indicador no puede contener mas de 250 caracteres"
                },
                dpFechaIndicador : {
                    required: "El campo fecha es requerido"
                },
                slDepartamento: {
                    required: "El campo direccion es requierido",
                    
                },
                slEstado: {
                    required: "El campo estado es requerido"
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
                /*Add other (if...else...) conditions depending on your
                * validation styling requirements*/
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
       
        return datos.form();
       
    }
    //validacion del paso 2 agregar objetivos
    function validateStep3(){
        return false;
    }
    //funcion que valida en que paso se encuentra
    function validateSteps(step){
        var isStepValid = true;
        // validate step 1
        if(step == 1){
            if(validateStep1() == false ){
                isStepValid = false; 
                
            }else{
                $("#formIndicador").submit(); 
            }
        }
    
       
        
        return isStepValid;
    }
    
    if($("#idindicador").val() > 0){
        var lbnext = 'Actualizar';
    }else{
        
    }
    $("#wizarIndicador").smartWizard({
        labelNext : lbnext, 
        labelPrevious:'Anterior', // label for Previous button
        labelFinish:'Finalizar',  // label for Finish button                   
        // This part of code can be removed FROM
        onLeaveStep: leaveAStepCallback,// <-- TO
    });
     
});

/////////////////////////////////////////////////////////////////////////////
//fin de la funcion para validar el formulario de crear objetivos///
//////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
//inicio de la funcion para validar el formulario de crear objetivos///
//////////////////////////////////////////////////////////////////////////////

$(function(){
    //variables para el wizard
        var datos;
        var lbnext = 'Guardar|Siguiente';
        var lbprevious = 'Anterior';
        var lbfinal = 'Finalizar'
    //end variable
    //Inicio de funcion leaveAStepCallback para obtener el numero de step 
        function leaveAStepCallback(obj){
            var step_num= obj.attr('rel');
            return validateSteps(step_num);
        }
    //End de funcion leaveAStepCallback
   
    //ajax guardar informacion proyecto
        $("#formObjetivos").on("submit", function(e) {     
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: $(this).serialize(),
                dataType : 'json',
                beforeSend : function(){
                    $.mpb('show',{value: [0,40],speed: 10,state: 'success'});
                },
                success : function(data){
                    if(data.respuesta == 'ok'){
                        $("input[name=idobjetivo]").val(data.codigo);
                        if(data.transaccion == 'guardar'){
                            noty({text: 'Objetivo creado con exito', layout: 'topRight', type: 'success'});
                        }else{
                            noty({text: 'Objetivo actualizado con exito', layout: 'topRight', type: 'success'});
                        }
                        
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
    //end ajax
    //validacion del paso 1 informacion general
    
    function validateStep1(){ 
        datos = $("#formObjetivos").validate({
            ignore: ":hidden:not(select)",
            
            rules: {
                txtLiteral: {
                    required: true,
                    
                    maxlength:15
        
                },
                txtDescripcion: {
                    required: true,
                },
                txtAlcance: {
                    required: true,
                    
                },
                txtProyecto:{
                    required:true,
                }
                
            },
            messages: {
                txtLiteral: {
                    required: "El campo literal es requerido",
                    
                    maxlength: "El campo nombre de indicador no puede contener mas de 15 caracteres"
                   
                },
                txtDescripcion: {
                    required: "El campo descripcion es requerido",
                },
                txtAlcance: {
                    required: "El campo alcance es requerido",
                    
                },
                txtProyecto: {
                    required: "El campo direccion es requierido",
                    
                    
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
                /*Add other (if...else...) conditions depending on your
                * validation styling requirements*/
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
       
        return datos.form();
       
    }
    //validacion del paso 2 agregar objetivos
    function validateStep3(){
        return false;
    }
    //funcion que valida en que paso se encuentra
    function validateSteps(step){
        var isStepValid = true;
        // validate step 1
        if(step == 1){
            if(validateStep1() == false ){
                isStepValid = false; 
                
            }else{
                $("#formObjetivos").submit(); 
            }
        }
    
       
        
        return isStepValid;
    }
    
    
     
});

/////////////////////////////////////////////////////////////////////////////
//fin de la funcion para validar el formulario de crear objetivos///
//////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////
//inicio de la funcion para validar el formulario de crear alcance de objetivos///
//////////////////////////////////////////////////////////////////////////////

$(function(){
    //variables para el wizard
        var datos;
        var lbnext = 'Guardar|Siguiente';
        var lbprevious = 'Anterior';
        var lbfinal = 'Finalizar'
    //end variable
    //Inicio de funcion leaveAStepCallback para obtener el numero de step 
        function leaveAStepCallback(obj){
            var step_num= obj.attr('rel');
            return validateSteps(step_num);
        }
    //End de funcion leaveAStepCallback
   
    //ajax guardar informacion proyecto
        $("#formAlcance").on("submit", function(e) {     
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: $(this).serialize(),
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
    //end ajax
    //validacion del paso 1 informacion general
    
    function validateStep1(){ 
        datos = $("#formAlcance").validate({
            ignore: ":hidden:not(select)",
            
            rules: {
                txtDescripcionalcance: {
                    required: true,
                    maxlength:15                   
                },
                txtLiteral:{
                    required:true,
                }
                
            },
            messages: {
                txtDescripcionalcance: {
                    required: "El campo descripcion es requerido",
                    maxlength: "El campo descripcion no puede contener mas de 15 caracteres"
                   
                },
               
                txtLiteral: {
                    required: "El campo Literal es requierido", 
                    
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
                /*Add other (if...else...) conditions depending on your
                * validation styling requirements*/
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
       
        return datos.form();
       
    }
    //validacion del paso 2 agregar objetivos
    function validateStep3(){
        return false;
    }
    //funcion que valida en que paso se encuentra
    function validateSteps(step){
        var isStepValid = true;
        // validate step 1
        if(step == 1){
            if(validateStep1() == false ){
                isStepValid = false; 
                
            }else{
                $("#formAlcance").submit(); 
            }
        }
    
       
        
        return isStepValid;
    }
    
    if($("#idalcance").val() > 0){
        var lbnext = 'Actualizar|Siguiente';
    }else{
        
    }
    $("#wizarAlcance").smartWizard({
        labelNext : lbnext, 
        labelPrevious:'Anterior', // label for Previous button
        labelFinish:'Finalizar',  // label for Finish button                   
        // This part of code can be removed FROM
        onLeaveStep: leaveAStepCallback,// <-- TO
    });
     
});

/////////////////////////////////////////////////////////////////////////////
//fin de la funcion para validar el formulario de crear objetivos///
//////////////////////////////////////////////////////////////////////////////






