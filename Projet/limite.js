var uploadField = document.getElementById("file");

uploadField.onchange = function() {
    if(this.files[0].size > 10485760){              ///Verification de la taille du fichier (limiter a 10 Mo)
       alert("Le fichier est trops volumineux!");
       this.value = "";
    };
};