<!DOCTYPE html>
<html>
<head>
    <title>Send Email</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Save the email to localStorage --->
    <script>
        $(document).ready(function() {
            var emailData = JSON.parse(localStorage.getItem('emailData')) || {};
            var isSending = false;

            function saveEmailData() {
                localStorage.setItem('emailData', JSON.stringify(emailData));
            }

            function clearEmailData() {
                emailData = {};
                saveEmailData();
            }

            function sendEmail() {
                if(isSending) {
                    return;
                }

                if(navigator.onLine) {
                    isSending = true;

                    $.ajax({
                        url: 'send_email.php',
                        type: 'POST',
                        data: emailData,
                        success: function(data) {
                            if(data == 'sent') {
                                $('#myModal').modal('show');
                                clearEmailData();
                            } else {
                                alert(data);
                            }

                            isSending = false;
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);

                            isSending = false;
                        }
                    });
                } else {
                    setTimeout(sendEmail, 5000); // Try again in 5 seconds
                }
            }

            function isValidEmail(email) {
                var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
                return emailRegex.test(email);
            }

            $('#sendEmail').click(function() {
                var email = $('#email').val();
                var from = $('#from').val();
                var subject = $('#subject').val();
                var message = $('#message').val();

                // Validate email
                if(!isValidEmail(email)) {
                    alert("Please enter a valid email address for the recipient.");
                    return false;
                }

                if(!isValidEmail(from)) {
                    alert("Please enter a valid email address for the sender.");
                    return false;
                }

                if(subject == '') {
                    alert("Please enter a subject for the email.");
                    return false;
                }

                if(message == '') {
                    alert("Please enter a message for the email.");
                    return false;
                }

                emailData = {email: email, from: from, subject: subject, message: message};
                saveEmailData();

                sendEmail();
            });

            setInterval(function() {
                if(!isSending && Object.keys(emailData).length > 0 && navigator.onLine) {
                    sendEmail();
                }
            }, 5000);
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <form>
            <div class="form-group">
                <label for="email">To:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="
