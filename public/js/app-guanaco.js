var app = {
    initialize: function(){
        /** event listener for DocumentReady */
        document.addEventListener('DOMContentLoaded', this.onDocumentReady.bind(this), false);
    },

    /* function for ready device*/
    onDocumentReady: function(doc) {
        console.log("Welcome xPL-PrintServer")
    },

    /* generic function call ajax sync and return values */
    callAjaxAsync: function (url, methodType, parm, objHeader){
        var resultReturn = null;

        $.ajax({

        url: url,
        global: false,
        type: methodType,
        data: JSON.stringify(parm),

        async: false,
        contentType: 'application/json; charset=utf-8',
        crossDomain: true,
        xhrFields: {
            withCredentials: true
        },
        headers : objHeader,

        success: function(result) {
            resultReturn = result;
        },

        beforeSend: function() {
            $("#idLoading").show();
            console.log('before');
        },

        complete: function() {
            $("#idLoading").hide();
            console.log('complete');
        },

        error: function(e){
            //setModal('Error al leer etiqueta', JSON.stringify(e));

            $('#exampleModalLabel').html('<div class="alert alert-danger w-100">' +
            '<strong>Error!</strong>' +
            '</div>');
            $('#exampleModalContent').html ( JSON.stringify(e) );
            $('#exampleModal').modal('show');
        }
        });
        return resultReturn;
    }
}
app.initialize();
