<?php
include("db.php");

// Add new User
if (isset($_POST['add_detail'])) {
    try {
        $course = mysqli_real_escape_string($conn, $_POST['Course']);
        $dname = mysqli_real_escape_string($conn, $_POST['Degree']);
        $sname = mysqli_real_escape_string($conn, $_POST['Spec']);
        $iname = mysqli_real_escape_string($conn, $_POST['InstName']);
        $bname = mysqli_real_escape_string($conn, $_POST['Uni']);
        $yop = mysqli_real_escape_string($conn, $_POST['YoP']);
        $gpa = mysqli_real_escape_string($conn, $_POST['Percentag']);

        $query = "INSERT INTO academic_details(Course, Degree, Spec, InstName, Uni, YoP, Percentag) VALUES ('$course','$dname','$sname','$iname', '$bname', '$yop', '$gpa')";

        if (mysqli_query($conn, $query)) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
            ];
            echo json_encode($res);
        } else {
            throw new Exception('Query Failed: ' . mysqli_error($conn));
        }
        } catch (Exception $e) {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
        echo json_encode($res);
    }
}

// Delete User
if (isset($_POST['delete_details'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['id']);
  
    $query = "DELETE FROM academic_details WHERE id='$user_id'";
    $query_run = mysqli_query($conn, $query);
  
    if ($query_run) {
        $res = [    
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

// Update User
if (isset($_GET['get_id'])) {
    $detail_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM academic_details WHERE id='$detail_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run && mysqli_num_rows($query_run) > 0) {
        $user = mysqli_fetch_assoc($query_run);
        $res = [
            'status' => 200,
            'data' => $user
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'User Not Found'
        ];
    }
    echo json_encode($res);
}

if (isset($_POST['update_id'])) {
    try {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $course = mysqli_real_escape_string($conn, $_POST['Course']);
        $iname = mysqli_real_escape_string($conn, $_POST['InstName']);
        $bname = mysqli_real_escape_string($conn, $_POST['Uni']);
        $yop = mysqli_real_escape_string($conn, $_POST['YoP']);
        $gpa = mysqli_real_escape_string($conn, $_POST['Percentage/CGPA']);

        $query = "UPDATE academic_details SET Course='$course', InstName='$iname', Uni='$bname',
        YoP = '$yop', Percentage/CGPA = '$gpa' WHERE id='$id'";

        if (mysqli_query($conn, $query)) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
            ];
            echo json_encode($res);
        } else {
            throw new Exception('Query Failed: ' . mysqli_error($conn));
        }
    } catch (Exception $e) {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
        echo json_encode($res);
    }
}
?>