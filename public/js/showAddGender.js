function changeShowAddGenderVisibility() {
    var element = document.getElementById("addGenderContainer").style;
    var hrefElement = document.getElementById("addGenderHref").style;
        if(element.display === "none") {
            element.display = "block";
            hrefElement.display = "none";

        } else {
            element.display = "none";
            hrefElement.display = "block";
        }
}

function openPhpScript() {
    var value = document.getElementById('text_addGender').value;;
    $.get("../script/addGender.php?addGender="+value);
}