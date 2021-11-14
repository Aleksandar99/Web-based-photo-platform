$('#files').on("change", function (e) {
    const allowed = ['image/jpeg', 'image/png', 'image/gif'];
    const files = e.currentTarget.files;

    $("#errorMsg").hide();

    if(files.length>10){
        $("#errorMsg").html('Не може да качите повече от 10 файла едновременно').show();
        $('#files').val('');
        return;
    }

    for (let i in files) {
        let filesize = ((files[i].size / 1024) / 1024).toFixed(4);
        if(files[i].name !== "item" && typeof files[i].name != "undefined"){
            if (filesize > 5 ) {
                $("#errorMsg").html('файлът ' + files[i].name + ' е по-голям от 5MB!').show();
                $('#files').val('');
                return;
            }

            if(allowed.includes(files[i].type) === false){
                $("#errorMsg").html('файлът ' + files[i].name + ' е от непозволен тип').show();
                $('#files').val('');
                return;
            }
        }

    }

})
