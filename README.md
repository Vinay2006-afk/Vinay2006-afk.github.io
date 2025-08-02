CodeZone - Online Code Prac0ce Pla1orm
CodeZone is a dynamic web-based coding prac0ce pla1orm that allows users to:
- 🔐 Register and login with session management
- 💬 View programming questions
- 🧠 Select a language and write code
- ⚙ Run the code against test cases
- ✅ View verdicts like pass/fail
- 👨🏫 Navigate using CodeBot (a hardcoded guide for users)
---
Tech Stack
-Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL
- Pla1orm: InfinityFree (Free hos0ng)
- Version Control: Git + GitHub
---
Folder Structure
codezone/
|—login.php
|—register.php
|— logout.php
|—codezone.php
|— db_connect_sample.php ← Replace with actual creds when deploying
|— style.css
|—codezone.js
|—images/
|—README.md
---
How to Run Locally
1. Clone the repo: git clone https://github.com/Vinay2006-afk/codezone.git
2. Set up a local web server (XAMPP/WAMP/MAMP)
3.Create a MySQL database and import the SQL dump (if available)
4.Edit db_connect_sample.php with your DB credentials and rename it to db_connect.php
5. Access localhost/codezone/login.php in your browser
Live Demo
Visit Live on InfinityFree vinay.infintyfreeap.com/loginpage
Future Features (WIP)
• Code auto-completion
• Timer-based practice sets
• User dashboard with score history
• More language support
• Admin panel for uploading ques0ons
Author
Developed by Vinay
📬 vinaysundar6@gmail.com
🎓 B.Tech Computer Science @ SASTRA University
🛡 Disclaimer
This is a student project. For real-world deployment, please secure inputs, sanitize DB queries, and restrict access properly
