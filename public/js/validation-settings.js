$().ready(function () {
    $("#subForm").validate({
        rules: {
            settings_firstName: {
                required: true,
                minlength: 2,
                maxlength: 25
            },
            settings_surName: {
                required: true,
                minlength: 2,
                maxlength: 25
            },

            settings_password: {
                required: false,
                minlength: 8,
                maxlength: 50
            },

            settings_password2: {
                required: false,
                minlength: 8,
                maxlength: 50
            },
            settings_email: {
                required: true,
                email: true,
                minlength: 5,
                maxlength: 50
            },
            settings_plz: {
                required: true,
                minlength: 5,
                maxlength: 5
            },
            settings_address: {
                required: false,
                minlength: 2,
                maxlength: 50
            },
            settings_gender: {
                required: true
            },
            settings_birthday: {
                required: true
            },
            settings_oldPassword: {
                minlength: 8,
                required: true
            }

        },
        messages: {
            settings_firstName: {
                required: "Bitte gebe deinen Vornamen ein!",
                minlength: jQuery.format("Mindestens {0} Zeichen benötigt!"),
                maxlength: jQuery.format("Maximal {0} Zeichen erlaubt!")
            },
            settings_surName: {
                required: "Bitte gebe deinen Nachnamen ein!",
                minlength: jQuery.format("Mindestens {0} Zeichen benötigt!"),
                maxlength: jQuery.format("Maximal {0} Zeichen erlaubt!")
            },
            settings_password: {
                required: "Bitte gib ein neues gültiges Passwort an!",
                minlength: jQuery.format("Mindestens {0} Zeichen benötigt!"),
                maxlength: jQuery.format("Maximal {0} Zeichen erlaubt!")
            },
            settings_password2: {
                required: "Bitte wiederhole dein neues Passwort!",
                minlength: jQuery.format("Mindestens {0} Zeichen benötigt!"),
                maxlength: jQuery.format("Maximal {0} Zeichen erlaubt!"),
                equalTo: "#settings_password"
            },
            settings_email: {
                required: "Bitte gib eine gültige Email an!",
                email: "Bitte gib eine gültige Email-Adresse an!",
                minlength: jQuery.format("Mindestens {0} Zeichen benötigt!"),
                maxlength: jQuery.format("Maximal {0} Zeichen erlaubt!")
            },
            settings_plz: {
                required: "Bitte gib ein gültige PLZ an!",
                minlength: jQuery.format("Mindestens {0} Zeichen benötigt!"),
                maxlength: jQuery.format("Maximal {0} Zeichen erlaubt!")
            },
            settings_address: {
                required: "Bitte gib eine gültige Adresse an!",
                minlength: jQuery.format("Mindestens {0} Zeichen benötigt!"),
                maxlength: jQuery.format("Maximal {0} Zeichen erlaubt!")
            },
            settings_oldPassword: {
                required: "Bitte gib dein aktuelles Passwort ein!",
                minlength: jQuery.format("Mindestens {0} Zeichen benötigt!"),
                maxlength: jQuery.format("Maximal {0} Zeichen erlaubt!")
            }
        },
        // the errorPlacement has to take the table layout into account
        errorElement: "label",
        errorClass: "error-label",
        validClass: "success",

        errorPlacement: function (error, element) {
            if ($(element).parent().hasClass("oldPassword")) {
                error.css('width', '47vw');
            }
            error.insertAfter(element.parent());
        },
        highlight: function (element, errorClass, validClass) {
            if ($(element).hasClass("success-border")) {
                $(element).removeClass("success-border");
            }
            $(element).addClass("error-border");
        },

        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("error-border");
        },
        success: function (label, element) {
            $(element).addClass("success-border");
            $(element).parent().next().remove();

        }

    });

});