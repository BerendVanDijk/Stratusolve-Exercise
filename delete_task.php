



<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */

include('../Stratusolve-Exercise/task.class.php');

// Assignment: Implement this script

$t= new Task();

$t->Delete($_POST['TaskId']);






?>