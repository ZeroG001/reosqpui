<?php

    if( $_SERVER['REQUEST_METHOD'] == "POST" ) {



        // ====================== Functions =========================== //

        /**
         * Sanitize Email
         *
         * Takes a string and removes the characters that should not be in an email address.
         * Intended to be assigned to a varible
         * @param (string) String to clean
         * @return (string) 
         */
        function sanitize_email($email) {
            $email = $_POST['email_address'];
            $unacceptable = array("\"", "(", ")", ",", ":", ";", "<", ">", "@", "[", "\\", "]");
            $email = str_replace($unacceptable, "", $email);
            return $email;
        }



        /**
         * sanitize_notes
         *
         * removes characters to a string that aren't supposed to be in the notes
         * 
         * @param (string) Path to file
         * @return (string) 
         */
        function sanitize_notes($notes) {
            $notes = $_POST['xdata_3'];
            $unacceptable = array("\"", "(", ")", "<", ">", "@", "[", "\\", "]");
            $notes = str_replace($unacceptable, "", $notes);
            return $notes;
        }



        /**
         * checkParams
         *
         * Removes array items that aren't in list of accepted param names
         * 
         * @param (array) $_POST array
         * @return (string) 
         */
        function checkParams($params) {
            $acceptedParams = array("email_address", "trace_number", "response_description", "total_amount", "order_number", "last_4", "method_used", "xdata_3");
            foreach ($params as $k => $param) {
                if( !in_array(strtolower($k), $params) ) {
                    unset($params[$k]);
                } 
            }
        }



        /**
         * requireToVar
         *
         * Takes and external HTML file and moves it to a variable. Used for PHP mailer $body
         * 
         * @param (string) path to external file 
         * @return (string) html from resulting file
         */
        function requireToVar($file) {
            ob_start();
            require_once($file);
            return ob_get_clean();
        }

        // ============================ Functions end =================================== //



        if( !isset($_POST['xdata_3']) ) {
            $_POST['xdata_3'] = "";
        }


        // Check sent parameters and sanitize them
        checkParams($_POST);
        $_POST['email_address'] = sanitize_email($_POST['email_address']);
        $_POST['xdata_3'] = sanitize_notes($_POST['xdata_3']);

        if (empty($_POST['email_address'])) {
            $_POST['email_address'] = "info@realestateone.com"; 
        }



        // --------------------- Send Message ---------------------


        // --- Email Settings... ---
      

        require('phpmailer/PHPMailerAutoload.php');

        $reomail = new PHPMailer();
        $reomail->isSMTP();
        $reomail->SMTPAuth      = true;
        $reomail->Host          = "smtp.office365.com";
        $reomail->Username      = 'info@realestateone.com';
        $reomail->Password      = 'N0tbl@nk!';
        $reomail->SMTPSecure    = 'tls';
        $reomail->port          = '587';
        $reomail->isHTML(true);
        // $reomail->SMTPDebug  = 1; <-- Un-comment for DETAILED errors.
        $reomail->WordWrap      = 50;
        $reomail->From          = 'info@realestateone.com'; // *HAS* to be info@realestateone.com
        $reomail->FromName      = "Info - RealEstateOne";

        // --------------------------------




        // --- Add Email Headers ---

        $reomail->Subject = $email_subject;
        $reomail->AddReplyTo($email_from);



        // --- Send Email TO... ---

        $reomail->addAddress('bholland@realestateone.com');



        // --- Construct Email Message ---

        $message = requireToVar("swpconfirmemail.php");
        $reomail->Body = "Hello this is a message"; // $message



        // --- Send Email ---

        if ( $reomail->send() ) {

            echo "<div class='message-success-wrapper'>"
                ."<h1> Thank You </h1>"
                ."<h1> Message has been sent </h1>"
                ."</div>";

            header("refresh:3;url=" . $_SERVER['HTTP_REFERER'] );
        }

        elseif ( !$reomail->send() ) {

            echo "<div class='message-success-wrapper'>"
                ."<h2> Oh No...the message didn't send </h2>"
                ."<h2> Please report the error below to helpdesk@realestateone.com </h2>"
                . "<p>" . $reomail->ErrorInfo . "</p>"
                ."</p> <a href='http://ouroneplace.net/reoswp'> Go Back </a> </p>"
                ."</div>";

        }


        // ------------------- End Send Message ------------------------------------

    } 
    else { header("Location: ../reoswp.php"); }


?>