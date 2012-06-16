<!-- Form -->
<script type="text/javascript" src="../theme/js/acoesComum.js"></script>
<form action="curso/salvar" id="validate" class="form" method="POST">
    <fieldset>
        <div class="widget">
            <div class="title"><img src="../theme/images/icons/dark/upload.png" alt="" class="titleIcon" /><h6>Importar turmas/horários/salas/professores</h6></div>
            <div id="uploader"></div>
            <div class="formSubmit">
                <input type="submit" id="importar/formularioImportarEtc" value="Nova Importação" class="blueB newUpload" />
            </div>
            <div class="clear"></div>
        </div>
    </fieldset>

</form>

<script>

    $("a[rel^='lightbox']").prettyPhoto();
    $("#uploader").pluploadQueue({
        runtimes : 'html5,html4',
        url : '../importar/executarImportacaoEtc',
        max_file_size : '1mb',
        unique_names : true,
        init : {



            UploadProgress: function(up, file) {
                // Called while a file is being uploaded
        
            },

            FileUploaded: function(up, file, info) {
                // Called when a file has finished uploading

                $(".mensagem").removeClass("nSuccess");
                $(".mensagem").removeClass("nFailure");
                $(".mensagem").addClass("nSuccess");
                $(".mensagem").css({
                    "display":"block"
                });
                $(".notificacao").html(info.response);
            },

            ChunkUploaded: function(up, file, info) {
                // Called when a file chunk has finished uploading

            },

            Error: function(up, args) {
                // Called when a error has occured
                alert('[error] '+ args);
            }
        },
        filters : [
            {
                title : "Image files", 
                extensions : "xml"
            }
        ]
    });

    function dump(arr,level) {
        var dumped_text = "";
        if(!level) level = 0;
 
        //The padding given at the beginning of the line.
        var level_padding = "";
        for(var j = 0;j < level+1;j++)
            level_padding += "    ";
 
        if(typeof(arr) == 'object') //Array/Hashes/Objects
        {
            for(var item in arr)
            {
                var value = arr[item];
 
                if(typeof(value) == 'object') //If it is an array,
                {
                    dumped_text += level_padding + "'" + item + "' ...\n";
                    dumped_text += dump(value,level+1);
                }
                else
                {
                    dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
                }
            }
        }
        else //Stings/Chars/Numbers etc.
        {
            dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
        }
        return dumped_text;
    }
    oTable = $('.dTable').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });
</script>