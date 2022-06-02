var loadFile = function(event) {
    var image = document.getElementById('image');
    var replacement = document.getElementById('current-img');
    replacement.src = URL.createObjectURL(event.target.files[0]);
};

function slugMaker(title, slug){
    $("#"+ title).keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'-');
        $("#"+slug).val(Text);
    });
}
