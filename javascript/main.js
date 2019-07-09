$(document).ready(function() {
    $("#submit").on('click', function(event) {
        event.preventDefault();

        let name = $("#name").val();
        let lastname = $("#lastname").val();
        let email = $("#email").val();
        
        if(name && lastname && email) {
            $.post('php/index.php', {
                name: name,
                lname: lastname,
                email: email
            }, function(data){
                $("#form-messages").text(data);
            });
        }
    });
});