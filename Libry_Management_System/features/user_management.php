<?php
include('../includes/header.php');
require_once '../Session/session.php'; 
require_login();

require_once '../config/db.php';

$stmt = $conn->prepare('SELECT * FROM user');
$stmt->execute(); 
$result = $stmt->get_result();
?>



<style>
    .popup-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
    .popup-form-container {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        background: white; padding: 20px;
        border-radius: 8px; width: 400px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .popup-form-container input {
        width: 100%; padding: 8px; margin: 10px 0;
        border: 1px solid #ccc; border-radius: 4px;
    }
    .popup-form-container .btn {
        width: 100%; padding: 10px;
        background-color: #28a745; color: white;
        border: none; border-radius: 4px; cursor: pointer;
    }
    .popup-form-container .btn:hover { background-color: #218838; }
    .close-btn {
        background: red; color: white; border: none;
        padding: 5px 10px; cursor: pointer; border-radius: 4px;
        float: right;
    }
</style>

<h2>User Management</h2>

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>User ID</th>
            <th>Email</th>
            <th>First Name</th> 
            <th>Last Name</th>
            <th>User Name</th>
            <th>Actions</th> 
        </tr>
    </thead>
    <tbody>

<?php
if ($result && $result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {
        echo "
            <tr>
                <td>{$data['user_id']}</td>
                <td>{$data['email']}</td>
                <td>{$data['first_name']}</td>
                <td>{$data['last_name']}</td>
                <td>{$data['username']}</td>
                <td>
                    
                    <!-- Edit Button -->
                    <button onclick=\"openPopup('{$data['user_id']}', '{$data['first_name']}', '{$data['last_name']}', '{$data['username']}', '{$data['email']}')\" style='padding: 5px 10px; cursor: pointer;'>Edit</button>
                    
                    <!-- Delete Button -->
                    <a href='delete_user.php?id={$data['user_id']}' onclick=\"return confirm('Are you sure you want to delete this user?');\" style='padding: 5px 10px; color: white; background-color: red; text-decoration: none; border-radius: 3px;'>Delete</a>

                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='6' style='text-align: center;'>No users found in the database.</td></tr>";
}
?>

    </tbody>
</table>

<div class="popup-overlay" id="myPopup">
    <div class="popup-form-container">
        <button class="close-btn" onclick="closePopup()">X</button>
        <h3>Edit Details</h3>
        <form id="update_user" method="POST">
        
            <input type="hidden" name="user_id" id="edit_user_id">
            
            <label>First Name</label>
            <input type="text" name="first_name" id="edit_first_name" required>
            
            <label>Last Name</label>
            <input type="text" name="last_name" id="edit_last_name" required>
            
            <label>Username</label>
            <input type="text" name="username" id="edit_username" required>
            
            <label>Email</label>
            <input type="email" name="email" id="edit_email" required>
            
            <button type="submit" name="update_user" class="btn">Update</button>
        </form>
    </div>
</div>

<script>

    function openPopup(id, fname, lname, uname, email) {
        document.getElementById("myPopup").style.display = "block"; //show popup
        document.getElementById("edit_user_id").value = id;
        document.getElementById("edit_first_name").value = fname;
        document.getElementById("edit_last_name").value = lname;
        document.getElementById("edit_username").value = uname;
        document.getElementById("edit_email").value = email;
    }

    function closePopup() {
        document.getElementById("myPopup").style.display = "none";
    }

    const updateform = document.getElementById('update_user');
        
        update_user.addEventListener('submit', (e) => {
            e.preventDefault();
            const data = new FormData(updateform);
            

            fetch('update_user.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.json()) 
            .then(data => {                    
                console.log(data);
                if(data.status === 'success') {
                    window.location.href = '<?php echo $BASE_URL?>/features/user_management.php';
                } else {
                    console.log('Error');
                    alert(data.message || 'Invalid update details'); 
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
        });



</script>

<?php 
include('../includes/footer.php');
?>