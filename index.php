<?php
include("config.php");
    
if(isset($_POST['action']) or isset($_GET['view'])) //show all events
{
    if(isset($_GET['view']))
    {
        header('Content-Type: application/json');
        $start = mysqli_real_escape_string($dbcon,$_GET["start"]);
        $end = mysqli_real_escape_string($dbcon,$_GET["end"]);
        
        $result = mysqli_query($dbcon,"SELECT id, start ,end ,title FROM  fc_events_table where (date(start) >= '$start' AND date(start) <= '$end')");
        while($row = mysqli_fetch_assoc($result))
        {
            $events[] = $row; 
        }
        echo json_encode($events); 
        exit;
    }
    elseif($_POST['action'] == "add") // add new event
    {   
        mysqli_query($dbcon,"INSERT INTO fc_events_table(
                    title ,
                    start ,
                    end 
                    )
                    VALUES (
                    '".mysqli_real_escape_string($dbcon,$_POST["title"])."',
                    '".mysqli_real_escape_string($dbcon,date('Y-m-d H:i:s',strtotime($_POST["start"])))."',
                    '".mysqli_real_escape_string($dbcon,date('Y-m-d H:i:s',strtotime($_POST["end"])))."'
                    )");
        header('Content-Type: application/json');
        echo '{"id":"'.mysqli_insert_id($dbcon).'"}';
        exit;
    }
    elseif($_POST['action'] == "update")  // update event
    {
        mysqli_query($dbcon,"UPDATE fc_events_table set 
            start = '".mysqli_real_escape_string($dbcon,date('Y-m-d H:i:s',strtotime($_POST["start"])))."', 
            end = '".mysqli_real_escape_string($dbcon,date('Y-m-d H:i:s',strtotime($_POST["end"])))."' 
            where id = '".mysqli_real_escape_string($dbcon,$_POST["id"])."'");
        exit;
    }
    elseif($_POST['action'] == "delete")  // remove event
    {
        mysqli_query($dbcon,"DELETE from fc_events_table where id = '".mysqli_real_escape_string($dbcon,$_POST["id"])."'");
        if (mysqli_affected_rows($dbcon) > 0) {
            echo "1";
        }
        exit;
    }
}
?>