<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] >900 ) {
    session_unset();
    session_destroy();
    header("Location: login.html");
    exit();
}

// Always update last activity time
$_SESSION['last_activity'] = time(); // 🕒 Reset timer on every load
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>CodeZone - Vinay’s Practice Arena 💻</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
</head>
<body>

    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👨‍💻</h2>

        <div class="question-list">
            <h3>Select a Question:</h3>
            <button class="question-btn" onclick="showEditor(0)">Check Prime</button>
      <button class="question-btn" onclick="showEditor(1)">Reverse String</button>
      <button class="question-btn" onclick="showEditor(2)">Find Factorial</button>
    </div>

    <div class="editor-section" id="editor-section">
      <h3 id="question-title">Question:</h3>
      <p id="question-text"></p>

      <label for="language">Choose Language:</label>
      <select id="language">
        <option value="c">C</option>
        <option value="cpp">C++</option>
        <option value="python">Python</option>
        <option value="java">Java</option>
      </select>

      <label for="code">Your Code:</label>
      <textarea id="code" placeholder="// Write your code here..."></textarea>

      <button class="run-btn" onclick="runCode()">Run Code</button>

      <p id="score">Score: 0</p>
      <p id="result-msg"></p>
    </div>
  </div>

  <div class="logout-container">
  <form action="logout.php" method="post">
    <button type="submit" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">Logout</button>
  </form>
</div>

<!-- Chatbot Trigger Button -->
<button id="chatbot-toggle" onclick="toggleChatbot()">Chat💬</button>

<!-- Chatbot Window -->
<div id="chatbot-window" class="">
  <div id="chat-header">CodeBot 🤖</div>
  <div id="chat-body"></div>
  <input type="text" id="chat-input" placeholder="Ask me anything..." onkeydown="handleChat(event)" />
</div>

  <script src="codezone.js"></script>
  <style>
    body {
      background-color: #1e1e1e;
      font-family: 'Courier New', Courier, monospace;
      color: #f8f8f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1000px;
      margin: 50px auto;
      padding: 20px;
    }

    h2 {
      color: #00ffc3;
    }

    .question-list {
      margin-bottom: 30px;
    }

    .question-btn {
      background-color: #00ffc3;
      color: black;
      padding: 10px 20px;
      border: none;
      margin: 10px;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .question-btn:hover {
      background-color: #00bca4;
    }

    .editor-section {
      display: none;
      background-color: #2d2d2d;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 255, 170, 0.2);
    }

    select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      background-color: #1e1e1e;
      color: #fff;
      border: 1px solid #444;
      border-radius: 6px;
      font-size: 1em;
    }

    textarea {
      height: 300px;
    }

    button.run-btn {
      background-color: #00ffc3;
      color: black;
      padding: 12px 25px;
      font-size: 1em;
      border: none;
      border-radius: 8px;
      margin-top: 20px;
      cursor: pointer;
    }

    #output {
      margin-top: 20px;
      background-color: #121212;
      color: #00ff88;
      padding: 15px;
      border-radius: 6px;
      white-space: pre-wrap;
    }

    .logout-container {
      position: absolute;
      top: 20px;
      right: 20px;
    }

    .logout-btn {
      background-color: #ff4d4d;
      color: white;
      border: none;
      padding: 10px 16px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    .logout-btn:hover {
      background-color: #e60000;
    }

    #chatbot-toggle {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #4b0082;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 50%;
      cursor: pointer;
      font-size: 18px;
      transition: background-color 0.3s ease;
    }

    #chatbot-toggle:hover {
      background-color: #8a2be2; /* Nice purple glow on hover */
    }

    /* Initial hidden state */
    #chatbot-window {
      position: fixed;
      bottom: 80px;
      right: 20px;
      width: 300px;
      max-height: 400px;
      background: #1e1e2f;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.3);
      display: flex;
      flex-direction: column;
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.4s ease;
      pointer-events: none;
      overflow: hidden; /* optional: prevent scrollbars popping outside */
    }

    #chatbot-window.visible {
      opacity: 1;
      transform: translateY(0);
      pointer-events: auto;
    }

    #chat-header {
      background-color: #00ffc3;
      color: #000;
      padding: 10px;
      font-weight: bold;
      text-align: center;
    }

    #chat-body {
      flex-grow: 1;
      padding: 10px;
      color: #fff;
      height: 200px;
      overflow-y: auto;
      font-size: 0.9em;
    }

    #chat-input {
      padding: 10px;
      border: none;
      border-top: 1px solid #444;
      background-color: #1e1e1e;
      color: #fff;
    }

    .hidden {
      display: none !important;
    }

    


  </style>
</body>
</html>