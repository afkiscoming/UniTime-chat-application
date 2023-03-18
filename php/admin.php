<?php
session_start();
include "config.php";
$session_user = $_SESSION['usersUniqueId'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUniqueId = '{$session_user}' AND userIsAdmin = 1");

if (mysqli_num_rows($sql) == 0) {
    // Redirect non-admin users to a different page
    header("Location: messages.php");
    exit();
}
?>

<?php
include "header.php";
?>

<div class="wrapper" style="background: #ccccdd">
    <section class="users admin">
        <header>
            <?php
            include "config.php";

            $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUniqueId = {$_SESSION['usersUniqueId']}");
            if(mysqli_num_rows($sql) > 0)
            {
                $row = mysqli_fetch_assoc($sql);
            }

            $sql_profile_photo = mysqli_query($conn, "SELECT * FROM profilephotos WHERE usersUniqueId = {$_SESSION['usersUniqueId']}");
            if(mysqli_num_rows($sql_profile_photo) > 0)
            {
                $row_profile_photo = mysqli_fetch_assoc($sql_profile_photo);
            }
            ?>
            <div class="content">

                <img src="data:image/jpeg;base64,<?php echo base64_encode($row_profile_photo['profilePhotoBlob']); ?>" alt="">
                <div class="details">
                    <span> <?php echo $row['usersFirstName'] . " " . $row['usersLastName'] ?> </span>
                    <p> <?php echo $row['usersStatus'] ?> </p>
                </div>
            </div>
            <a href="../php/logout.php?logout_id=<?php echo $row['usersUniqueId']; ?>" class="logout">Logout</a>
        </header>

        <section class="admin-users">
            <div class="table-container"  >
                <header>
                    <h2>Users Table</h2>
                </header>

                <table>
                    <tr>
                        <th>User ID</th>
                        <th>User Unique ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Is Admin</th>
                        <th>Email Verification Code</th>
                        <th>Email Activated</th>
                        <th>Password Reset Token</th>
<!--                        <th>Delete User</th>-->
                    </tr>

                    <?php
                    // Fetch users from the database
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($conn, $query);

                    // Loop through each row and display the data in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['usersId']}</td>";
                        echo "<td>{$row['usersUniqueId']}</td>";
                        echo "<td>{$row['usersUsername']}</td>";
                        echo "<td>{$row['usersFirstName']}</td>";
                        echo "<td>{$row['usersLastName']}</td>";
                        echo "<td>{$row['usersEmail']}</td>";
                        echo "<td>{$row['usersStatus']}</td>";
                        echo "<td>{$row['userIsAdmin']}</td>";
                        echo "<td>{$row['usersEmailVerification']}</td>";
                        echo "<td>{$row['usersEmailActivated']}</td>";
                        echo "<td>{$row['usersPasswordResetToken']}</td>";
/*                        echo "<td><a href=\"delete_user.php?id={$row['usersUniqueId']}\">Delete</a></td>";*/
//                        echo "<td><a href=\"admin-edit-user.php?id={$row['usersUniqueId']}\">Edit</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </section>
        <hr class="profile-hr">

        <section class="admin-messages">
            <header>
                <h2>Messages Table</h2>
            </header>

            <div class="table-container" >
                <table>
                    <tr>
                        <th>Message ID</th>
                        <th>Sender Unique ID</th>
                        <th>Receiver Unique ID</th>
                        <th>Message Content</th>
                    </tr>

                    <?php
                    // Fetch messages from the database
                    $query = "SELECT * FROM messages";
                    $result = mysqli_query($conn, $query);

                    // Loop through each row and display the data in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['messageId']}</td>";
                        echo "<td>{$row['incomingMessageId']}</td>";
                        echo "<td>{$row['outgoingMessageId']}</td>";
                        echo "<td>{$row['message']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </section>
        <hr class="profile-hr">

        <section class="admin-matches">
            <header>
                <h2>Matches Table</h2>
            </header>

            <div class="table-container" >
                <table>
                    <tr>
                        <th>Match ID</th>
                        <th>Match Receiver</th>
                        <th>Matched User</th>
                        <th>Match Creation Date</th>
                        <th>SoftDelete</th>
                    </tr>

                    <?php
                    // Fetch matches from the database
                    $query = "SELECT * FROM matches ORDER BY matchCreationTime DESC";
                    $result = mysqli_query($conn, $query);

                    // Loop through each row and display the data in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['matchesId']}</td>";
                        echo "<td>{$row['matchReceiver']}</td>";
                        echo "<td>{$row['matchedUser']}</td>";
                        echo "<td>{$row['matchCreationTime']}</td>";
                        echo "<td>{$row['softDelete']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </section>
        <hr class="profile-hr">

        <label>How many users in the users table:</label>
        <div class="output">
            <div class="field button">
                <input id="user-count-button" type="button" value="Calculate">
            </div>
            <label id="user-count-result"></label>
        </div>
        <hr class="profile-hr">

        <label>How many admins in the application</label>
        <div class="output">
            <div class="field button">
                <input id="admin-count-button" type="button" value="Calculate">
            </div>
            <label id="admin-count-result"></label>
        </div>
        <hr class="profile-hr">

        <label>Get the user with the most messages:</label>
        <div class="output">
            <div class="field button">
                <input id="most-messages-button" type="button" value="Get">
            </div>
            <label id="most-messages-result"></label>
        </div>
        <hr class="profile-hr">

        <label>Show the most recent match from matches</label>
        <div class="output">
            <div class="field button">
                <input id="recent-match-button" type="button" value="Get">
            </div>
            <label id="recent-match-result"></label>
        </div>
        <hr class="profile-hr">

    </section>
</div>

<script src="../js/admin.js"></script>

<?php
include "footer.php";
?>
