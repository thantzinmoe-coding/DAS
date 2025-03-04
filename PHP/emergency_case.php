<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Doctor Appointment System</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .section {
        margin-bottom: 20px;
    }

    select,
    input,
    button {
        padding: 8px;
        margin: 5px 0;
        width: 100%;
        box-sizing: border-box;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1 id="title">Doctor Appointment System</h1>

        <div id="emergencyForm" class="section">
            <h2 id="emergencyTitle">Emergency Assistance</h2>

            <!-- Language Selection -->
            <div class="section">
                <label for="language" id="languageLabel">Select Language:</label>
                <select id="language" onchange="updateLanguage()">
                    <option value="en">English</option>
                    <option value="my">မြန်မာ (Burmese)</option>
                </select>
            </div>

            <!-- Form for Submission -->
            <form id="emergencyFormData" method="POST" action="">
                <div class="section">
                    <label for="patientName" id="patientNameLabel">Your Name:</label>
                    <input type="text" id="patientName" name="patient_name" placeholder="Enter your name" required>
                </div>

                <div class="section">
                    <label for="symptoms" id="symptomsLabel">Describe Your Symptoms:</label>
                    <input type="text" id="symptoms" name="symptoms" placeholder="e.g., chest pain, shortness of breath"
                        required>
                </div>

                <div class="section">
                    <label for="hospital" id="hospitalLabel">Select Hospital for Emergency Service:</label>
                    <select id="hospital" name="hospital_id" required>
                        <?php
                        // Fetch hospitals with emergency_services = 1
                        $conn = new mysqli('localhost', 'root', '', 'project');
                        if ($conn->connect_error) {
                            die('Connection failed: ' . $conn->connect_error);
                        }
                        $conn->set_charset('utf8mb4');
                        $hospitals = $conn->query("SELECT hospital_id, name, location FROM hospitals WHERE emergency_services = 1");
                        if ($hospitals->num_rows > 0) {
                            while ($hospital = $hospitals->fetch_assoc()) {
                                echo "<option value='{$hospital['hospital_id']}'>{$hospital['name']} - {$hospital['location']}</option>";
                            }
                        } else {
                            echo "<option value='' disabled>No hospitals with emergency services available</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>

                <div class="section">
                    <button type="button" onclick="getLocation()" id="locationBtn">Share My Location</button>
                    <p id="locationStatus">Location not shared yet.</p>
                    <!-- Hidden inputs for location data -->
                    <input type="hidden" id="division" name="division">
                    <input type="hidden" id="township" name="township">
                    <input type="hidden" id="street" name="street">
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">
                </div>

                <div class="section">
                    <button type="submit" id="submitBtn">Submit for Emergency Help</button>
                </div>
            </form>

            <div class="section">
                <p id="patientInfoLabel"><strong>Patient Info:</strong></p>
                <p id="patientInfo">Please enter your name above.</p>
            </div>
        </div>

        <div id="followUpSection" class="section hidden">
            <h2 id="followUpTitle">Follow-Up Scheduled</h2>
            <p id="followUpDetails"></p>
        </div>
    </div>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'project');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    $conn->set_charset('utf8mb4');

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patient_name = $conn->real_escape_string($_POST["patient_name"]);
        $symptoms = $conn->real_escape_string($_POST["symptoms"]);
        $hospital_id = isset($_POST["hospital_id"]) ? $conn->real_escape_string($_POST["hospital_id"]) : null;
        $division = $conn->real_escape_string($_POST["division"] ?? '');
        $township = $conn->real_escape_string($_POST["township"] ?? '');
        $street = $conn->real_escape_string($_POST["street"] ?? '');
        $latitude = $_POST["latitude"] ?? null;
        $longitude = $_POST["longitude"] ?? null;

        // Validate hospital_id exists in hospitals table
        if ($hospital_id) {
            $checkHospital = $conn->query("SELECT hospital_id FROM hospitals WHERE hospital_id = $hospital_id AND emergency_services = 1");
            if ($checkHospital->num_rows == 0) {
                echo "<script>alert('Invalid or unavailable hospital selected. Please choose a valid hospital with emergency services.'); history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Please select a hospital for emergency service.'); history.back();</script>";
            exit;
        }

        // Insert into database
        $sql = "INSERT INTO emergency_requests (patient_name, symptoms, hospital_id, division, township, street, latitude, longitude) 
                VALUES ('$patient_name', '$symptoms', '$hospital_id', '$division', '$township', '$street', '$latitude', '$longitude')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Emergency request submitted successfully!'); scheduleFollowUp();</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }

    $conn->close();
    ?>

    <script>
    // Translations object
    const translations = {
        en: {
            title: "Doctor Appointment System",
            emergencyTitle: "Emergency Assistance",
            languageLabel: "Select Language:",
            patientNameLabel: "Your Name:",
            symptomsLabel: "Describe Your Symptoms:",
            hospitalLabel: "Select Hospital for Emergency Service:",
            locationBtn: "Share My Location",
            locationStatus: "Location not shared yet.",
            submitBtn: "Submit for Emergency Help",
            patientInfoLabel: "Patient Info:",
            followUpTitle: "Follow-Up Scheduled"
        },
        my: {
            title: "ဆရာဝန်ချိန်းဆိုမှုစနစ်",
            emergencyTitle: "အရေးပေါ်အကူအညီ",
            languageLabel: "ဘာသာစကားရွေးချယ်ပါ:",
            patientNameLabel: "သင်၏အမည်:",
            symptomsLabel: "သင်၏လက္ခဏာများကိုဖော်ပြပါ:",
            hospitalLabel: "အရေးပေါ်ဝန်ဆောင်မှုအတွက် ဆေးရုံရွေးချယ်ပါ:",
            locationBtn: "ကျွန်ုပ်၏တည်နေရာမျှဝေပါ",
            locationStatus: "တည်နေရာမျှဝေမထားသေးပါ။",
            submitBtn: "အရေးပေါ်အကူအညီအတွက် တင်ပြပါ",
            patientInfoLabel: "လူနာအချက်အလက်:",
            followUpTitle: "နောက်ဆက်တွဲချိန်းဆိုထားသည်"
        }
    };

    let currentLanguage = "en";
    let locationShared = false;

    updateLanguage();

    function updateLanguage() {
        currentLanguage = document.getElementById("language").value;
        const t = translations[currentLanguage];

        document.getElementById("title").innerText = t.title;
        document.getElementById("emergencyTitle").innerText = t.emergencyTitle;
        document.getElementById("languageLabel").innerText = t.languageLabel;
        document.getElementById("patientNameLabel").innerText = t.patientNameLabel;
        document.getElementById("symptomsLabel").innerText = t.symptomsLabel;
        document.getElementById("hospitalLabel").innerText = t.hospitalLabel;
        document.getElementById("locationBtn").innerText = t.locationBtn;
        document.getElementById("locationStatus").innerText = locationShared ? document.getElementById("locationStatus")
            .innerText : t.locationStatus;
        document.getElementById("submitBtn").innerText = t.submitBtn;
        document.getElementById("patientInfoLabel").innerHTML = `<strong>${t.patientInfoLabel}</strong>`;
        document.getElementById("followUpTitle").innerText = t.followUpTitle;
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                async (position) => {
                        const {
                            latitude,
                            longitude
                        } = position.coords;
                        try {
                            const response = await fetch(
                                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=18&addressdetails=1`
                            );
                            const data = await response.json();
                            const address = data.address || {};
                            const division = address.state || address.region || "Unknown Division";
                            const township = address.city || address.town || address.village || "Unknown Township";
                            const street = address.road || address.street || "Unknown Street";

                            locationShared = true;
                            const locationText = currentLanguage === "en" ?
                                `Location shared: Division: ${division}, Township: ${township}, Street: ${street}, Lat: ${latitude}, Lon: ${longitude}` :
                                `တည်နေရာမျှဝေပြီး: တိုင်းဒေသကြီး: ${division}, မြို့နယ်: ${township}, လမ်း: ${street}, လတ္တီတွဒ်: ${latitude}, လောင်ဂျီတွဒ်: ${longitude}`;
                            document.getElementById("locationStatus").innerText = locationText;

                            // Populate hidden fields
                            document.getElementById("division").value = division;
                            document.getElementById("township").value = township;
                            document.getElementById("street").value = street;
                            document.getElementById("latitude").value = latitude;
                            document.getElementById("longitude").value = longitude;
                        } catch (error) {
                            console.error("Error fetching address:", error);
                            const fallbackText = currentLanguage === "en" ?
                                `Location shared: Lat ${latitude}, Lon ${longitude} (Address lookup failed)` :
                                `တည်နေရာမျှဝေပြီး: လတ္တီတွဒ် ${latitude}, လောင်ဂျီတွဒ် ${longitude} (လိပ်စာရှာမရပါ)`;
                            document.getElementById("locationStatus").innerText = fallbackText;
                            locationShared = true;
                            document.getElementById("latitude").value = latitude;
                            document.getElementById("longitude").value = longitude;
                        }
                    },
                    () => {
                        alert(currentLanguage === "en" ? "Unable to retrieve location." : "တည်နေရာရယူ၍မရပါ။");
                    }
            );
        } else {
            alert(currentLanguage === "en" ? "Geolocation not supported by your browser." :
                "သင်၏ဘရောက်ဆာတွင် Geolocation မထောက်ပံ့ပါ။");
        }
    }

    function validateAndSubmit() {
        const patientName = document.getElementById("patientName").value.trim();
        const symptoms = document.getElementById("symptoms").value.trim();
        const hospitalId = document.getElementById("hospital").value;

        if (!patientName) {
            alert(currentLanguage === "en" ? "Please enter your name." : "ကျေးဇူးပြု၍ သင်၏အမည်ထည့်ပါ။");
            return false;
        }
        if (!symptoms) {
            alert(currentLanguage === "en" ? "Please describe your symptoms." :
                "ကျေးဇူးပြု၍ သင်၏လက္ခဏာများကိုဖော်ပြပါ။");
            return false;
        }
        if (!hospitalId) {
            alert(currentLanguage === "en" ? "Please select a hospital for emergency service." :
                "ကျေးဇူးပြု၍ အရေးပေါ်ဝန်ဆောင်မှုအတွက် ဆေးရုံတစ်ခုရွေးချယ်ပါ။");
            return false;
        }
        if (!locationShared) {
            alert(currentLanguage === "en" ? "Please share your location first." :
                "ကျေးဇူးပြု၍ သင်၏တည်နေရာကို အရင်မျှဝေပါ။");
            return false;
        }

        // Update patient info on the page
        document.getElementById("patientInfo").innerHTML = `
                Name: ${patientName}<br>
                Symptoms: ${symptoms}<br>
                Hospital: ${document.getElementById("hospital").options[document.getElementById("hospital").selectedIndex].text}<br>
                Location: ${document.getElementById("locationStatus").innerText}
            `;
        return true; // Allow form submission
    }

    // Attach validation to form submission
    document.getElementById("emergencyFormData").onsubmit = function(event) {
        if (!validateAndSubmit()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    };

    function scheduleFollowUp() {
        const followUpSection = document.getElementById("followUpSection");
        followUpSection.classList.remove("hidden");
        document.getElementById("followUpDetails").innerText =
            currentLanguage === "en" ?
            "Follow-up scheduled for March 10, 2025, 10:00 AM." :
            "နောက်ဆက်တွဲချိန်းဆိုမှု မတ်လ ၁၀၊ ၂၀၂၅၊ နံနက် ၁၀:၀၀။";
    }
    </script>
</body>

</html>