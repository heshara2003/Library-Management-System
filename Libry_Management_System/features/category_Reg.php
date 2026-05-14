<?php
require_once('../config/db.php');
require_once('../Session/session.php');
include('../includes/header.php');

$stmt = $conn->prepare('SELECT * FROM bookcategory');
$stmt->execute();
$result = $stmt->get_result();
?>

<style>
    .modal { display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); }
    .modal-content { background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 400px; border-radius: 5px; }
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
    <h2>Book Category Management</h2>

        <?php if(isset($_GET['error'])): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border: 1px solid #f5c6cb; border-radius: 4px;">
                <strong>Error:</strong> <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb; border-radius: 4px;">
                Category deleted successfully!
            </div>
        <?php endif; ?>

        <button class="btn btn-primary" onclick="toggleModal(true)">+ Add New Category</button>

        <table>
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Date Modified</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result): ?>
                    <?php while($value = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($value['category_id']); ?></td>
                            <td><?php echo htmlspecialchars($value['category_Name']); ?></td>
                            <td><?php echo htmlspecialchars($value['date_modified']); ?></td>
                            <td>
                                <button class="btn btn-warning" onclick="openUpdateModal('<?php echo $value['category_id']; ?>', '<?php echo $value['category_Name']; ?>')">Update</button>
                                <a href="catdelete.php?id=<?php echo urlencode($value['category_id']); ?>" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="toggleModal(false)">&times;</span>
            <h3>Register Category</h3>
            <form id="catform">
                <div class="form-group">
                    <label for="catID">Category ID:</label>
                    <input type="text" id="catID" name="catid" placeholder="e.g., C001" required>
                </div>
                <div class="form-group">
                    <label for="catName">Category Name:</label>
                    <input type="text" id="catName" name="catname" placeholder="Enter name" required>
                </div>
                <button type="submit" class="btn btn-success">Save Category</button>
            </form>
        </div>
    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="toggleUpdateModal(false)">&times;</span>
            <h3>Update Category</h3>
            <form id="updateForm">
                <div class="form-group">
                    <label for="upCatID">Category ID:</label>
                    <input type="text" id="upCatID" name="catid" readonly style="background-color: #e9ecef;">
                </div>
                <div class="form-group">
                    <label for="upCatName">Category Name:</label>
                    <input type="text" id="upCatName" name="catname" required>
                </div>
                <button type="submit" class="btn btn-warning">Update Category</button>
            </form>
        </div>
    </div>

<script>
    const fromVal = document.getElementById('catform');
    const updateFormVal = document.getElementById('updateForm');

    function toggleModal(show) {
        if(show) document.getElementById('categoryModal').classList.add('active');
        else document.getElementById('categoryModal').classList.remove('active');
    }

    function toggleUpdateModal(show) {
        if(show) document.getElementById('updateModal').classList.add('active');
        else document.getElementById('updateModal').classList.remove('active');
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('modern-modal-overlay')) {
            toggleModal(false);
            toggleUpdateModal(false);
        }
    }

    function openUpdateModal(id, name) {
        document.getElementById('upCatID').value = id;
        document.getElementById('upCatName').value = name;
        toggleUpdateModal(true);
    }

    function validationForm(id) {
        const catID = document.getElementById(id).value.trim();
        if(catID !== '' && catID[0] === 'C') {
            return true;
        }
        alert("Invalid ID Format! (Must start with 'C')");
        return false;
    }

    fromVal.addEventListener('submit', (e) => {
        e.preventDefault();
        if(validationForm('catID')){
            const data = new FormData(fromVal);
            fetch('catHandler.php', {
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

    updateFormVal.addEventListener('submit', (e) => {
        e.preventDefault();
        const data = new FormData(updateFormVal);
        fetch('catUpdate.php', {
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
    });
</script>

<?php include('../includes/footer.php'); ?>