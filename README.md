# Email-sender
This is a web page that allows users to send an email by filling out a form. The languages used are HTML, CSS, JavaScript, and PHP. The page uses the Bootstrap CSS framework for styling and the jQuery JavaScript library for AJAX.

The form has four fields: To, From, Subject, and Message. When the user clicks the "Send Email" button, the JavaScript function bound to the click event is executed. This function first retrieves the values entered by the user in the form fields. Then it performs some basic validation on these values, such as checking that the email addresses are valid and that the subject and message fields are not empty.

If the validation succeeds, the function makes an AJAX request to the server-side script "send_email.php" using the jQuery.ajax() function. This script is responsible for actually sending the email. It takes the values of the form fields as input parameters and uses the PHP mail() function to send an email to the recipient specified in the "To" field. If the email is sent successfully, the script returns the string "sent" as the response to the AJAX request.

If the AJAX request is successful, the JavaScript function checks whether the response was "sent". If it was, it displays a modal dialog with the title "Success". Otherwise, it displays an alert with the error message returned by the server. If the user closes the modal dialog, the form fields are cleared.

The isValidEmail() function is a helper function used for email address validation. It checks whether the input string matches the regular expression /^[\w-.]+@([\w-]+.)+[\w-]{2,4}$/, which matches most valid email addresses.

Overall, this web page provides a simple and user-friendly interface for sending emails without the need for an email client. It could be used, for example, as a contact form on a website or as a quick way to send messages between colleagues. 
