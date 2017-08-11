<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>%TITLE%</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">	
    <link href="style.css" rel="stylesheet">
</head>
<body>
    
    <div id="contact-wrapper">
        <div><h2>Contact Form</h2></div>
        <span class="span">%send_message%</span>
      <form method="post" action="" id="contactform">
        <div>
        <label for="name"><strong>Name:</strong></label>
        <input type="text" size="40" name="contactname" id="contactname" value="%contactname%" />
        <span class="span">%error_contactname%</span>
        </div>
       <div>
        <label for="email"><strong>Email:</strong></label>
        <input type="text" size="40" name="email" id="email" value="%email%" />
        <span class="span">%error_email%</span>
        </div>
       <div>
        <label for="subject"><strong>Subject:</strong></label>
        <select name="subject" >
            <option value=""></option>
            <option value="error" %subject_error%>error</option>
            <option value="message" %subject_message%>message</option>
            <option value="request" %subject_request%>request</option>
        </select>
        <span class="span">%error_subject%</span>
        </div>
       <div>
        <label for="message"><strong>Message:</strong></label>
        <textarea rows="5" cols="44" name="message" id="message">%message%</textarea>
        <span class="span">%error_message%</span>
        </div>

        <input type="submit" class="btn btn-primary submit" value="Send Message" name="submit" />
      </form>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
