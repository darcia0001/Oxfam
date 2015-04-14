  $(document).ready(function() {   
    $(function () {
        $("#selectGroupeProjet").change(function () {
            alert("change");
            var val = $('#selectProfil option:selected').val();
            if (val == "agentoxfam") {
                alert("lol");
                $("#selectGroupeOxfam").show();
                $("#selectGroupeProjet").hide();
            }
            if (val == "agentprojet") {
            	alert("relol");
                $("#selectGroupeOxfam").hide();
                $("#selectGroupeProjet").show();
            }
            
        })
    })
    } );