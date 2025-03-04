<?php

class Patient {
    public $name;
    public $email;
    public $doctor;
    public $hospital;
    public $location;
    public $symptoms;
    public $appointmentDate;
    public $appointment_time;
    public $token_number;

    public function __construct($name, $email, $doctor, $hospital, $location, $symptoms, $appointmentDate, $appointment_time, $token_number) {
        $this->name = $name;
        $this->email = $email;
        $this->doctor = $doctor;
        $this->hospital = $hospital;
        $this->location = $location;
        $this->symptoms = $symptoms;
        $this->appointmentDate = $appointmentDate;
        $this->appointment_time = $appointment_time;
        $this->token_number = $token_number;
    }
}

function sendAppointmentEmail(Patient $patient) {
    // Access object properties
    require_once 'appointment_mail.php';
    sendMail($patient);
}

// // Creating an object
// $patient = new Patient("John Doe","tmoe8123@gmail.com", "Dr. Smith", "City Hospital", "123 Main St", "Fever, Cough", "20th Feb 2025");

// // Passing the object to function
// sendAppointmentEmail($patient);
