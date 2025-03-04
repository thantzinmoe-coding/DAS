<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/test2.css">
    <link rel="stylesheet" href="../CSS/test.css">
</head>
<body>
    
    <?php 
    $currentDate = date("Y-m-d");
 
    $totalDays = 7;
    function getNextWeekdays($currentDate, $weekdaysToFind, $totalDays) {
        $weekdays = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
        $currentTimestamp = strtotime($currentDate);
        $currentWeekday = date("D", $currentTimestamp);
    
        $orderedWeekdays = [];
        $found = false;
        foreach ($weekdays as $day) {
            if (in_array($day, $weekdaysToFind)) {
                if (!$found && $day == $currentWeekday) {
                    $found = true;
                }
                if ($found) {
                    $orderedWeekdays[] = $day;
                }
            }
        }
        foreach ($weekdaysToFind as $day) {
            if (!in_array($day, $orderedWeekdays)) {
                $orderedWeekdays[] = $day;
            }
        }
    
        $results = [];
        $count = 0;
        while ($count < $totalDays) {
            foreach ($orderedWeekdays as $day) {
                while (date("D", $currentTimestamp) != $day) {
                    $currentTimestamp = strtotime("+1 day", $currentTimestamp);
                }
                $results[] = [
                    "day" => $day,
                    "date" => date("j", $currentTimestamp),
                    "month" => date("F", $currentTimestamp),
                    "year" => date("Y", $currentTimestamp)
                ];
                $currentTimestamp = strtotime("+1 day", $currentTimestamp);
                $count++;
                if ($count == $totalDays) break;
            }
        }
    
        return $results;
    
    }

    include 'config.php';

    if (isset($_GET['doctor_id'])) {
        $doctor_id = intval($_GET['doctor_id']);
        $sql = "SELECT name, job_type, credential, gender,  CONCAT(FORMAT(consultation_fee, 0), ' Ks') AS formatted_fee, hospital_name,available_day, available_time
            FROM doctors, hospital where doctors.id = hospital.doctor_id and doctors.id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $doctor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    }


    ?>
    <form id="filter-form" method="post">
        <select id="Hos" name="hospital_name" value="select hospital">
            <?php 
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["hospital_name"] . '">' . $row["hospital_name"] . '</option>';
                }
            }
            ?>
        </select>
        <button type="submit">Submit</button>
    </form>
    <h3>Date</h3>
    <div class="date-selector" style="margin-top: 15px;">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $hos = isset($_POST['hospital_name']) ? $_POST['hospital_name'] : '';
            
            if (!empty($hos)) {
                echo "Selected Hospital ID: " . $hos;
                $result->data_seek(0);
                    $weekdaysToFind = [];
                    $sql = "SELECT hospital_name,available_day, available_time
                    FROM doctors, hospital where doctors.id = hospital.doctor_id and hospital.hospital_name = ? and doctors.id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("si", $hos, $doctor_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<div>' . $row["available_day"] . '</div>';
                            $validWeekdays = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
                            $availableDay = $row["available_day"];
                            if (in_array($availableDay, $validWeekdays)) {
                                $weekdaysToFind[] = $availableDay;
                            } else {
                                echo '<div>Invalid available day: ' . htmlspecialchars($availableDay) . '</div>';
                            }
                        }
                    }

                    print_r($weekdaysToFind);
                    //$weekdaysToFind = ["Mon", "Tue", "Wed"];
                    $nextDays = getNextWeekdays($currentDate, $weekdaysToFind, $totalDays);
                    // if (!empty($nextDays)) {
                    //     echo "<h2>{$nextDays[0]['month']} {$nextDays[0]['year']}</h2>";
                    // }
                    
            }
            else {
                echo "No hospital selected.";
            }
        } else {
            echo "No form data submitted.";
        }


        ?>

    </div>

    <div class="scroll-container" id="scrollContainer">
    <?php foreach ($nextDays as $index => $entry): ?>
        <div class="date-box" onclick="selectBox(this)">
            <strong><?= $entry['month'] ?></strong><br>
            <strong><?= $entry['date'] ?></strong><br>
            <em><?= $entry['day'] ?></em>
        </div>
    <?php endforeach; 
    ?>
    </div>
    </body>
</html>
<script>
    let container = document.getElementById("scrollContainer");
    let isUserScrolling = false;
    let selectedBox = null;

    function autoScroll() {
        let step = 110; // Adjust scroll step for proper alignment
        let scrollAmount = 0;
        let interval = setInterval(() => {
            if (isUserScrolling) return;

            if (scrollAmount >= container.scrollWidth - container.clientWidth) {
                container.scrollTo({ left: 0, behavior: "smooth" });
                scrollAmount = 0;
            } else {
                container.scrollBy({ left: step, behavior: "smooth" });
                scrollAmount += step;
            }
        }, 2000);
    }

    function selectBox(box) {
        if (selectedBox) {
            selectedBox.classList.remove("active");
        }
        if (selectedBox !== box) {
            box.classList.add("active");
            selectedBox = box;
        } else {
            selectedBox = null;
        }
    }

    container.addEventListener("scroll", () => {
        isUserScrolling = true;
        clearTimeout(window.scrollTimeout);
        window.scrollTimeout = setTimeout(() => {
            isUserScrolling = false;
        }, 2000);
    });

    window.onload = autoScroll;
</script>



