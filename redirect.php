
session_start();
if (isset($_SESSION['table_to_update'])) {
    header('location:new_' . $_SESSION['table_to_update'] . '.php');
}

