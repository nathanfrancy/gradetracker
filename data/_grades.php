<?php

function recordIndividualStandardGrade($student_id, $standard_id, $rating) {
    $d = date("m-d-Y");
    
	$link = connect_db();
	$sql = "INSERT INTO grade (`student_id`, `standard_id`,`rating`, `date_updated`) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE rating=?, date_updated=?";
	
	// Create prepared statement and bind parameters
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('iissss', $student_id, $standard_id, $rating, $d, $rating, $d);
	
    // Execute the query, get the last inserted id
    $stmt->execute();
	$rows = $link->affected_rows;
	mysqli_stmt_close($stmt);
	$link->close();
	
	return "true";
}

function getStudentsWithStandardGrades($schoolyear_id, $standard_id) {
    $students = array();
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "
SELECT s.*, g.*, s.`id` as `studentid` 
FROM `student` s 
LEFT JOIN `grade` g ON g.`student_id` = s.`id` AND g.standard_id = ?
LEFT JOIN `standard` st ON g.standard_id = st.id
WHERE s.`schoolyear_id` = ? AND s.`status` = 'enabled'";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
    $stmt->bind_param('ii', $standard_id, $schoolyear_id);
	$stmt->execute();
	$result = $stmt->get_result();
	
	// Bind result to Book object and push each one on the end of $books array
    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
        $student['id'] = $row['studentid'];
        $student['firstname'] = $row['firstname'];
        $student['lastname'] = $row['lastname'];
        $student['schoolyear_id'] = $row['schoolyear_id'];
        $student['status'] = $row['status'];
        $student['rating'] = $row['rating'];
        $student['date_updated'] = $row['date_updated'];
		array_push($students, $student);
	}
	
	mysqli_stmt_close($stmt);
	return $students;
}

function printStandardScores($schoolyear_id) {
    $standards = getStandardsFromSchoolYear($schoolyear_id);
    $subjects = getSubjectsFromSchoolYear($schoolyear_id);
    
    if (isset($_SESSION['auth_id'])) {
    
        if (count($standards) > 0) {
            $ownerid = getOwnerOfSchoolYear($standards[0]);

            if ($ownerid == $_SESSION['auth_id']) {

                foreach ($subjects as $subject) {
                    $count = 0;
                    echo "<h1>{$subject['title']}</h1>";

                    foreach ($standards as $standard) {
                        if ($standard['subject_id'] == $subject['id']) {
                            $count++;
                            echo "<h3>{$standard['title']}<br><small>{$standard['date_given']}</small></h3>";
                            $scores = getStudentsWithStandardGrades($standard['schoolyear_id'], $standard['id']);
                            echo "<table class='table table-bordered'>";
                            echo "<thead><tr><th>Student</th><th>Score</th><th>Date Recorded</th></tr></thead>";
                            foreach ($scores as $score) {
                                if ($score['rating'] !== 'm') {
                                    if ($score['rating'] == 'nm') {
                                        echo "<tr class='bg-danger'>";
                                        echo "<td>{$score['lastname']}, {$score['firstname']}</td>";
                                        echo "<td>Not Mastered</td>";
                                        echo "<td>{$score['date_updated']}</td>";
                                        echo "</tr>";
                                    }
                                    else if ($score['rating'] == 'p') {
                                        echo "<tr class='bg-warning'>";
                                        echo "<td>{$score['lastname']}, {$score['firstname']}</td>";
                                        echo "<td>Progressing</td>";
                                        echo "<td>{$score['date_updated']}</td>";
                                        echo "</tr>";
                                    }
                                    else if ( ($score['rating'] !== 'p') && ($score['rating'] !== 'nm') && ($score['rating'] !== 'm') ) {
                                        echo "<tr class='bg-info'>";
                                        echo "<td>{$score['lastname']}, {$score['firstname']}</td>";
                                        echo "<td>No score recorded or invalid grade.</td>";
                                        echo "<td>{$score['date_updated']}</td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                            echo "</table>";
                        }
                        
                    }
                    if ($count == 0) {
                        echo "<h3><small>No standards found.</small></h3>";
                    }
                    echo "<hr />";
                }

                
            }
            else {
                echo "Oops, looks like this data isn't yours!";
            }
        }
        else {
            echo "<h1>No data found.</h1>";
        }
    }
    else {
        echo "Sorry, you can't access this information when logged out.";
    }
}


?>