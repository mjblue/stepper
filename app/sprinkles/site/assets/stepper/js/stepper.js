$("#addsteps").ufForm({
    msgTarget: $("#alerts-page")
}).on("submitSuccess.ufForm", function(event, data, textStatus, jqXHR) {
    redirectOnLogin(jqXHR);
});;