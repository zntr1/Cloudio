$().ready(function () {
    //validate Login Form
    $("#loginForm").validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            }
        }, messages: {}
    });
});