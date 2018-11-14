<?php
session_start();
include_once '../model/User.php';

// Check variable $show are exist or not
if (isset($_GET['show'])) {
    show();
}

// Check variable $btnInsert are exist or not
if (isset($_POST['btnInsert'])) {
    insert();
}

// Check variable $deleteID are empty or not
if (!empty($_GET['deleteID'])) {
    delete($_GET['deleteID']);
}

// Check variable $editID are empty or not
if (!empty($_GET['editID'])) {
    edit($_GET['editID']);
}

/**
 * Function to show all user in table User by Ajax
 * @return void
 */
function show()
{
    $listUser = User::show();
    if ($listUser == null) {die('Table User is not have data to show');}
    $listKeys = array_keys($listUser[0]);

    echo "<tr class='title'>";
    foreach ($listKeys as $key) {
        echo "<td>$key</td>";
    }
    echo "<td colspan='2'>action</td>";
    echo "</tr>";
    foreach ($listUser as $user) {
        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['username']}</td>";
        echo "<td>{$user['password']}</td>";
        echo "<td>{$user['email']}</td>";
        echo "<td>{$user['birthday']}</td>";
        echo "<td><a href='controllers/UserController.php?deleteID={$user['id']}'>Delete</a></td>";
        echo "<td><a href='update.php?editID={$user['id']}'>Edit</a></td>";
        echo "</tr>";
    }
}

/**
 * Function to insert a new user to table User when click on button 'Add a new User'
 * @return void
 */
function insert()
{
    $name = $_POST['txtName'];
    $pass = $_POST['txtPass'];
    $email = $_POST['txtEmail'];
    $birthDay = $_POST['txtDoB'];

    // Check $name are empty or not
    if (empty($name)) {
        $_SESSION['emptyName'] = 'Username must not be empty..';
    }

    // Check $pass are empty or not
    if (empty($pass)) {
        $_SESSION['emptyPass'] = 'Password must not be empty..';
    }

    // Check $email are empty or not
    if (empty($email)) {
        $_SESSION['emptyEmail'] = 'Email must not be empty..';
    }

    // Check $birthDay are empty or not
    if (empty($birthDay)) {
        $_SESSION['emptyDoB'] = 'BirthDay must not be empty..';
    } else if (User::insert( $name, $pass, $email, $birthDay)) { //Check insert a record are true or false
        $_SESSION['result'] = 'Insert successful..';
    } else {
        $_SESSION['result'] = 'Insert was failed..';
    }
    header('location: ../insert.php');
}

/**
 * Function to edit a exist user in table User when click on link 'Edit'
 * @param int @id is the ID of this user.
 * @return void
 */
function edit($id)
{
    $name = $_POST['txtName'];
    $pass = $_POST['txtPass'];
    $email = $_POST['txtEmail'];
    $birthDay = $_POST['txtDoB'];

    if (empty($name)) {
        $_SESSION['emptyName'] = 'Username must not be empty..';
    }

    if (empty($pass)) {
        $_SESSION['emptyPass'] = 'Password must not be empty..';
    }

    if (empty($email)) {
        $_SESSION['emptyEmail'] = 'Email must not be empty..';
    }

    if (empty($birthDay)) {
        $_SESSION['emptyDoB'] = 'BirthDay must not be empty..';
    } else if (User::update($id, $name, $pass, $email, $birthDay)) { //Check update a record are true or false
        $_SESSION['result'] = 'Update successful..';
    } else {
        $_SESSION['result'] = 'Update was failed..';
    }
    header('location: ../update.php?editID='.$id);
}

/**
 * Function to delete a exist user in table User when click on link 'Delete'
 * @param int @id is the ID of this user.
 * @return void
 */
function delete($id)
{
    // Check delete a record are true or false
   if (User::delete($id)) {
       $_SESSION['result'] = 'Delete successful..';
   } else {
       $_SESSION['result'] = 'Delete was failed..';
   }
   header('location: ../index.php');
}
