<?php
require_once('config/db.php');
include('includes/header.php');
require_once('Session/session.php');
require_login();
$current_user = current_user()['first_name'];

$user_count = $conn->query("SELECT COUNT(*) as total FROM user")->fetch_assoc()['total'];
$member_count = $conn->query("SELECT COUNT(*) as total FROM member")->fetch_assoc()['total'];
$borrowed_count = $conn->query("SELECT COUNT(*) as total FROM bookborrower where borrow_status='Borrowed' ")->fetch_assoc()['total'];
$book_count = $conn->query("SELECT COUNT(*) as total FROM book")->fetch_assoc()['total'];

?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    body {
        margin: 0;
        padding: 0;
        font-family: 'Inter', sans-serif;
        background: linear-gradient(-45deg, #0f172a, #1e1b4b, #312e81, #1e3a8a);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        min-height: 100vh;
        color: #f8fafc;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .dashboard-container {
        padding: 40px;
        max-width: 1250px;
        margin: 40px auto;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }
    
    .welcome-section {
        margin-bottom: 50px;
        text-align: center;
    }

    .welcome-section h1 {
        font-weight: 700;
        font-size: 2.8rem;
        margin-bottom: 15px;
        background: linear-gradient(to right, #a5b4fc, #c4b5fd);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .welcome-section p {
        font-weight: 300;
        font-size: 1.2rem;
        color: #94a3b8;
    }

    .cards-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 30px;
    }

    .metric-card {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 16px;
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .metric-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: currentColor;
        opacity: 0.8;
    }

    .metric-card:hover {
        transform: translateY(-8px) scale(1.02);
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.4);
    }

    .metric-icon {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-right: 25px;
        transition: transform 0.3s ease;
    }

    .metric-card:hover .metric-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .metric-info h3 {
        margin: 0;
        font-size: 13px;
        color: #cbd5e1;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 600;
    }

    .metric-info .count {
        margin: 8px 0 0 0;
        font-size: 36px;
        font-weight: 700;
        color: #f8fafc;
        line-height: 1;
    }
</style>

<div class="dashboard-container">
    
    <div class="welcome-section">
        <h1>Hello, <?php echo htmlspecialchars($current_user); ?>!</h1>
        <p>Welcome to the Library Management System Dashboard.</p>
    </div>

    <div class="cards-wrapper">
        <div class="metric-card" style="color: #60a5fa;">
            <div class="metric-icon" style="background: rgba(96, 165, 250, 0.15);">👥</div>
            <div class="metric-info">
                <h3>Total Users</h3>
                <p class="count"><?php echo $user_count; ?></p>
            </div>
        </div>

        <div class="metric-card" style="color: #34d399;">
            <div class="metric-icon" style="background: rgba(52, 211, 153, 0.15);">👨‍🎓</div>
            <div class="metric-info">
                <h3>Total Members</h3>
                <p class="count"><?php echo $member_count; ?></p>
            </div>
        </div>

        <div class="metric-card" style="color: #f43f5e;">
            <div class="metric-icon" style="background: rgba(244, 63, 94, 0.15);">📚</div>
            <div class="metric-info">
                <h3>Books Borrowed</h3>
                <p class="count"><?php echo $borrowed_count; ?></p>
            </div>
        </div>

        <div class="metric-card" style="color: #fbbf24;">
            <div class="metric-icon" style="background: rgba(251, 191, 36, 0.15);">📖</div>
            <div class="metric-info">
                <h3>Total Books</h3>
                <p class="count"><?php echo $book_count; ?></p>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>