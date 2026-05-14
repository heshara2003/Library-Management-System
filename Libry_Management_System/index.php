<?php
require_once('config/db.php');
include('includes/header.php');
require_once('Session/session.php');
require_login();
$current_user = current_user()['first_name'];

$user_count = $conn->query("SELECT COUNT(*) as total FROM user")->fetch_assoc()['total'];
$member_count = $conn->query("SELECT COUNT(*) as total FROM member")->fetch_assoc()['total'];
$borrowed_count = $conn->query("SELECT COUNT(*) as total FROM bookborrower where borrow_status='borrowed' ")->fetch_assoc()['total'];
$book_count = $conn->query("SELECT COUNT(*) as total FROM book")->fetch_assoc()['total'];

?>
<style>
    .dashboard-container {
        padding: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .welcome-section {
        margin-bottom: 40px;
    }

    .cards-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }

    .metric-card {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        border-left: 4px solid #3498db;
        transition: transform 0.2s;
    }

    .metric-card:hover {
        transform: translateY(-5px);
    }

    .metric-icon {
        background: #e3f2fd;
        color: #3498db;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-right: 20px;
    }

    .metric-info h3 {
        margin: 0;
        font-size: 14px;
        color: #7f8c8d;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .metric-info .count {
        margin: 5px 0 0 0;
        font-size: 28px;
        font-weight: bold;
        color: #2c3e50;
    }
</style>

<div class="dashboard-container">
    
    <div class="welcome-section">
        <h1 style="color: #2c3e50; margin-bottom: 10px;">Hello, <?php echo htmlspecialchars($current_user); ?>!</h1>
        <p style="color: #7f8c8d; font-size: 1.1em;">Welcome to the Library Management System Dashboard.</p>
    </div>

    <div class="cards-wrapper">
        <div class="metric-card">
            <div class="metric-icon">👥</div>
            <div class="metric-info">
                <h3>Total Users</h3>
                <p class="count"><?php echo $user_count; ?></p>
            </div>
        </div>

        <div class="metric-card" style="border-left-color: #2ecc71;">
            <div class="metric-icon" style="background: #e8f8f5; color: #2ecc71;">👨‍🎓</div>
            <div class="metric-info">
                <h3>Total Members</h3>
                <p class="count"><?php echo $member_count; ?></p>
            </div>
        </div>

        <div class="metric-card" style="border-left-color: #e74c3c;">
            <div class="metric-icon" style="background: #fdedec; color: #e74c3c;">📚</div>
            <div class="metric-info">
                <h3>Books Borrowed</h3>
                <p class="count"><?php echo $borrowed_count; ?></p>
            </div>
        </div>

        <div class="metric-card" style="border-left-color: #f39c12;">
            <div class="metric-icon" style="background: #fef5e7; color: #f39c12;">📖</div>
            <div class="metric-info">
                <h3>Total Books</h3>
                <p class="count"><?php echo $book_count; ?></p>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>