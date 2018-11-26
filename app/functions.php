<?php
/**
 * Created by PhpStorm.
 * User: el3zahaby
 * Date: 11/23/18
 * Time: 4:27 PM
 */

/**
 * Checks if a folder exist and return canonicalized absolute pathname (sort version)
 * @param string $folder the path being checked.
 * @return mixed returns the canonicalized absolute pathname on success otherwise FALSE is returned
 */
function folder_exist($folder)
{
    // Get canonicalized absolute pathname
    $path = realpath($folder);

    // If it exist, check if it's a directory
    return ($path !== false AND is_dir($path)) ? $path : false;
}

// DB
function empty_table($table) {
    global $conn;
    $result = $conn->query("SELECT * FROM `$table`  LIMIT 1");
    // I've added a where conditional to filter results and a LIMIT statement as Yegor suggested.
    $returnVal = ($result->num_rows > 0) ? false : true;
    $result->close();
    return $returnVal;
}


function selectby($by,$from){
    global $conn;
    $last = count($by) - 1;
    $loop = 0;


    $sql = "SELECT * FROM `$from` WHERE ";
    foreach ($by as $i => $b){
        if (count($by) != 1) {
            if($loop == $last){
                $sql .= "`$i` = '$b' ;";
            } else{
                $sql .= "`$i` = '$b' AND ";
            }
        }else{
            $sql .= "`$i` = '$b'";
        }
        $loop++;
    }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data=array();
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
            return $data;
        }
    } else {
        return false;
    }
}


function insert_into_table($table,$register_data) {
    global $conn;
    /* removed array_walk because my solution filters the data in before
     * calls this function.
     */

    $fields = '`' . implode('`, `', array_keys($register_data)) . '`';
    $data = '\'' . implode('\', \'', $register_data) . '\'';
    $result = $conn->query("INSERT INTO `$table` ($fields) VALUES ($data);");
    // you can check the result for something if you want, but you shouldn't need to.
}
// End DB

function is_login(){
    if (isset($_SESSION['user'])){
        return true;
    }
}
function logout(){
    unset($_SESSION['user']);
    session_destroy();
}

function to($url){
    header("Location: $url");
    exit;
}

