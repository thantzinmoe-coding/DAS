<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require_once 'patient.php';
function sendMail(Patient $patient)

{
    $htmlTemplate = file_get_contents('../Html/appointment_mail.html');
    $message = str_replace('{{ patient_name }}', $patient->name, $htmlTemplate);
    $message = str_replace('{{ doctor_name }}', $patient->doctor, $message); // Use $message here
    $message = str_replace('{{ hospital_name }}', $patient->hospital, $message); // Use $message here
    $message = str_replace('{{ hospital_location }}', $patient->location, $message); // Use $message here
    $message = str_replace('{{ symptoms }}', $patient->symptoms, $message); // Use $message here
    $message = str_replace('{{ appointment_time }}', $patient->appointment_time, $message); // Use $message here
    $message = str_replace('{{ token_number }}', $patient->token_number, $message); // Use $message here
    $message = str_replace('{{ appointment_date }}', $patient->appointmentDate, $message); // Use $message here


    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'ohmasan56@gmail.com';               // SMTP username
        $mail->Password   = 'kaiksbqdkplytzwj';                  // SMTP password
        $mail->SMTPSecure = "tls";                                 // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('ohmasan56@gmail.com', 'From Doctor Appointment System');
        $mail->addAddress($patient->email);

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Your OTP for Doctor Appointment System';
        $mail->Body    = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
