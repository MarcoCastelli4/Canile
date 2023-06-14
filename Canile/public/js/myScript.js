function checkModal()
{
    malattia = $("#malattia");
    malattia_msg = $("#invalid-malattia");
    
    validita = $("#validità");
    validita_msg = $("#invalid-validita");
    
    var error = false;
    
    if (malattia.val().trim() === "")
    {
        malattia_msg.html("The malattia field must not be empty");
        malattia.focus();
        error = true;
    } else {
        firstName_msg.html("");
    }

    if (validita.val().trim() === "")
    {
        validita_msg.html("The validità field must not be empty");
        validita.focus();
        error = true;
    } else {
        validita_msg.html("");
    }
    
    if (!error)
    {
            $.ajax('/vaccination', {

                method: 'POST',

                data: {malattia: malattia.val().trim(), validita: validita.val().trim()},

                success: function (data) {

                    if (data.found)
                    {
                        error = true;
                        lastName_msg.html("Malattia already exists in the database");
                    } else {
                        $('form[name=author]').submit();
                    }
                }

            });
        } 
    }
    