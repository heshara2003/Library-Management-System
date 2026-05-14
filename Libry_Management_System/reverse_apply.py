# Reverting index.php
import sys
with open('/Users/hesharasandeepa/Desktop/Libry_Management_System/index.php', 'r', encoding='utf-8') as f: content = f.read()
target = '"<div class=\\"modern-container\\" style=\\"max-width: 1200px; margin: 40px auto; padding: 40px;\\">\\n    \\n    <div class=\\"modern-header\\" style=\\"border-bottom: none; display: block; text-align: center; margin-bottom: 40px;\\">\\n        <h1 style=\\"color: va\n<truncated 1025 bytes>'
replacement = '"<style>\\n    .dashboard-container {\\n        padding: 30px;\\n        max-width: 1200px;\\n        margin: 0 auto;\\n    }\\n    \\n    .welcome-section {\\n        margin-bottom: 40px;\\n    }\\n\\n\\n    .cards-wrapper {\\n        display: grid;\\n        grid-temp\n<truncated 2221 bytes>'
content = content.replace(target, replacement)
with open('/Users/hesharasandeepa/Desktop/Libry_Management_System/index.php', 'w', encoding='utf-8') as f: f.write(content)
# Reverting auth/login.php
import sys
with open('/Users/hesharasandeepa/Desktop/Libry_Management_System/auth/login.php', 'r', encoding='utf-8') as f: content = f.read()
target = '"    <link rel=\\"stylesheet\\" type=\\"text/css\\" href=\\"../assets/css/style.css\\">\\n</head>\\n<body>\\n\\n    <div class=\\"body-logingForm\\">\\n    \\n        <div class=\\"login-container\\">\\n            <div class=\\"left-side\\">\\n                <h1>Library</h1\n<truncated 1389 bytes>'
replacement = '"    <link rel=\\"stylesheet\\" type=\\"text/css\\" href=\\"../assets/css/style.css\\">\\n    <style type=\\"text/css\\">\\n        a:hover{\\n            color: #e650de;\\n            text-decoration: underline;\\n            text-decoration-color: #e650de;\\n         \n<truncated 1540 bytes>'
content = content.replace(target, replacement)
with open('/Users/hesharasandeepa/Desktop/Libry_Management_System/auth/login.php', 'w', encoding='utf-8') as f: f.write(content)
# Reverting features/user_management.php
import sys
with open('/Users/hesharasandeepa/Desktop/Libry_Management_System/features/user_management.php', 'r', encoding='utf-8') as f: content = f.read()
target = '"<div class=\\"modern-container\\">\\n    <div class=\\"modern-header\\">\\n        <h2>User Management</h2>\\n    </div>\\n\\n    <div class=\\"modern-table-wrapper\\">\\n        <table class=\\"modern-table\\">\\n            <thead>\\n                <tr>\\n             \n<truncated 3668 bytes>'
replacement = '"<style>\\n    .popup-overlay {\\n        display: none;\\n        position: fixed;\\n        top: 0; left: 0; width: 100%; height: 100%;\\n        background-color: rgba(0, 0, 0, 0.5);\\n        z-index: 999;\\n    }\\n    .popup-form-container {\\n        positio\n<truncated 6457 bytes>'
content = content.replace(target, replacement)
with open('/Users/hesharasandeepa/Desktop/Libry_Management_System/features/user_management.php', 'w', encoding='utf-8') as f: f.write(content)
# Reverting features/category_Reg.php
import sys
with open('/Users/hesharasandeepa/Desktop/Libry_Management_System/features/category_Reg.php', 'r', encoding='utf-8') as f: content = f.read()
# Reverting features/assign_fine.php
import sys
with open('/Users/hesharasandeepa/Desktop/Libry_Management_System/features/assign_fine.php', 'r', encoding='utf-8') as f: content = f.read()
