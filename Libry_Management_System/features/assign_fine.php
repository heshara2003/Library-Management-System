<?php
require_once('../config/db.php');
require_once('../Session/session.php');
require_login();
include('../includes/header.php');

$query = "
    SELECT f.fine_id, f.member_id, CONCAT(m.first_name, ' ', m.last_name) AS member_name, 
           b.book_name, f.fine_amount, f.fine_date_modified, f.book_id
    FROM fine f
    INNER JOIN member m ON f.member_id = m.member_id
    INNER JOIN book b ON f.book_id = b.book_id
";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<style>
    .custom-modal { display: none; position: fixed; z-index: 1056; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); }
    .custom-modal-content { background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 400px; border-radius: 5px; }
    .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
    .close:hover, .close:focus { color: black; text-decoration: none; cursor: pointer; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; }
    .form-group input { width: 100%; padding: 8px; box-sizing: border-box; }
    .btn { padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
    .btn-primary { background-color: #007bff; color: white; }
    .btn-success { background-color: #28a745; color: white; }
    .btn-warning { background-color: #ffc107; color: black; }
    .btn-danger { background-color: #dc3545; color: white; text-decoration: none;}
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    table, th, td { border: 1px solid #ddd; }
    th, td { padding: 12px; text-align: left; }
    th { background-color: #f2f2f2; }
</style>

<div style="padding: 20px;">
    <h2>Fine Management</h2>

        <?php if(isset($_GET['error'])): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border: 1px solid #f5c6cb; border-radius: 4px;">
                <strong>Error:</strong> <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb; border-radius: 4px;">
                Fine record deleted successfully!
            </div>
        <?php endif; ?>

        <button class="btn btn-primary" onclick="toggleModal(true)">+ Assign Fine</button>

        <table>
            <thead>
                <tr>
                    <th>Fine ID</th>
                    <th>Member ID</th>
                    <th>Member Name</th>
                    <th>Book Name</th>
                    <th>Fine Amount (LKR)</th>
                    <th>Date Modified</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result): ?>
                    <?php while($value = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($value['fine_id']); ?></td>
                            <td><?php echo htmlspecialchars($value['member_id']); ?></td>
                            <td><?php echo htmlspecialchars($value['member_name']); ?></td>
                            <td><?php echo htmlspecialchars($value['book_name']); ?></td>
                            <td><?php echo htmlspecialchars($value['fine_amount']); ?></td>
                            <td><?php echo htmlspecialchars($value['fine_date_modified']); ?></td>
                            <td>
                                <button class="btn btn-warning" onclick="openUpdateModal('<?php echo $value['fine_id']; ?>', '<?php echo $value['member_id']; ?>', '<?php echo $value['fine_amount']; ?>')">Update</button>
                                <a href="fineDelete.php?id=<?php echo urlencode($value['fine_id']); ?>" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('Are you sure you want to delete this fine record?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Fine Modal -->
    <div id="fineModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close" onclick="toggleModal(false)">&times;</span>
            <h3>Assign Fine</h3>
            <form id="fineForm">
                <div class="form-group">
                    <label for="fineID">Fine ID:</label>
                    <input type="text" id="fineID" name="fine_id" placeholder="e.g., F001" maxlength="5" required>
                </div>
                
                <div class="form-group">
                    <label for="memberID">Member ID:</label>
                    <input type="text" id="memberID" name="member_id" placeholder="e.g., M001" maxlength="5" required>
                </div>

                <div class="form-group">
                    <label for="bookID">Book ID:</label>
                    <input type="text" id="bookID" name="book_id" placeholder="e.g., B001" maxlength="5" required>
                </div>

                <div class="form-group">
                    <label for="fineAmount">Fine Amount (LKR):</label>
                    <input type="number" id="fineAmount" name="fine_amount" min="2" max="500" step="0.01" placeholder="2 - 500" required>
                </div>
                
                <button type="submit" class="btn btn-success">Save Fine</button>
            </form>
        </div>
    </div>

    <!-- Update Fine Modal -->
    <div id="updateModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close" onclick="toggleUpdateModal(false)">&times;</span>
            <h3>Update Fine</h3>
            <form id="updateForm">
                <div class="form-group">
                    <label for="upFineID">Fine ID:</label>
                    <input type="text" id="upFineID" name="fine_id" readonly style="background-color: #e9ecef;">
                </div>
                
                <div class="form-group">
                    <label for="upMemberID">Member ID:</label>
                    <input type="text" id="upMemberID" name="member_id" readonly style="background-color: #e9ecef;">
                </div>

                <div class="form-group">
                    <label for="upFineAmount">Fine Amount (LKR):</label>
                    <input type="number" id="upFineAmount" name="fine_amount" min="2" max="500" step="0.01" required>
                </div>
                
                <button type="submit" class="btn btn-warning">Update Fine</button>
            </form>
        </div>
    </div>

<script>
    const fineForm = document.getElementById('fineForm');
    const updateForm = document.getElementById('updateForm');

    function toggleModal(show) {
        if(show) document.getElementById('fineModal').style.display = 'block';
        else document.getElementById('fineModal').style.display = 'none';
    }

    function toggleUpdateModal(show) {
        if(show) document.getElementById('updateModal').style.display = 'block';
        else document.getElementById('updateModal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('fineModal')) {
            toggleModal(false);
        }
        if (event.target == document.getElementById('updateModal')) {
            toggleUpdateModal(false);
        }
    }

    function openUpdateModal(fineId, memberId, amount) {
        document.getElementById('upFineID').value = fineId;
        document.getElementById('upMemberID').value = memberId;
        document.getElementById('upFineAmount').value = amount;
        toggleUpdateModal(true);
    }

    function validateFineAmount(amount) {
        const val = parseFloat(amount);
        if (isNaN(val) || val < 2 || val > 500) {
            alert("Fine amount must be within the range of 2 LKR to 500 LKR.");
            return false;
        }
        return true;
    }

    fineForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const amount = document.getElementById('fineAmount').value;
        if(validateFineAmount(amount)){
            const data = new FormData(fineForm);
            fetch('fineHandler.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });

    updateForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const amount = document.getElementById('upFineAmount').value;
        if(validateFineAmount(amount)){
            const data = new FormData(updateForm);
            fetch('fineUpdate.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
</script>

<?php include('../includes/footer.php'); ?>
