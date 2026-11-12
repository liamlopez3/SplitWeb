/**
 * Validación en el cliente con jQuery Validation, integrada con Bootstrap 3.
 * Solo mejora la experiencia del usuario: 
 * la validación que da seguridad está en el servidor.
 */

$(document).ready(function() {

    $.validator.setDefaults({
        errorElement: "span",
        errorClass: "error",

        highlight: function (element) {
            $(element).closest(".form-group").addClass("has-error");
        },
        unhighlight: function (element) {
            $(element).closest(".form-group").removeClass("has-error");
        }
    })

    if ($("#formRegister").length > 0){
        $("#formRegister").validate({
            rules: {
                fEmail: { required: true, email: true, maxlength: 255 },
                fFullName: { required: true, maxlength: 255 },
                fNickName: { required: true, maxlength: 255 },
                fPassword: { required: true, minlength: 8, maxlength: 72 },
                fPassword2: { required: true, equalTo: "#fPassword"}
            },
            messages: {
                fPassword2: { equalTo: "Las contraseñas no coinciden." }
            }
        });
    }
});