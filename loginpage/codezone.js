const questions = [
  {
    title: "Check Prime",
    text: "Write a program to check whether a given number is prime or not.",
    testCases: [
      { input: "7", expectedOutput: "Prime" },
      { input: "10", expectedOutput: "Not Prime" }
    ]
  },
  {
    title: "Reverse String",
    text: "Write a program to reverse a given string.",
    testCases: [
      { input: "hello", expectedOutput: "olleh" }
    ]
  },
  {
    title: "Find Factorial",
    text: "Write a program to calculate factorial of a number using recursion.",
    testCases: [
      { input: "5", expectedOutput: "120" }
    ]
  }
];

const languageMap = {
  c: 50,
  cpp: 54,
  java: 62,
  python: 71
};

let score = 0;
let currentQuestionIndex = -1;
let solvedQuestions = new Set(); 

function showEditor(index) {
  currentQuestionIndex = index;
  document.getElementById("editor-section").style.display = "block";

  const q = questions[index];
  document.getElementById("question-title").textContent = "Question: " + q.title;
  document.getElementById("question-text").textContent = q.text;

  document.getElementById("result-msg").textContent = "";
  document.getElementById("code").value = "";
}

function runCode() {
  const lang = document.getElementById("language").value;
  const source_code = document.getElementById("code").value;
  const resultMsg = document.getElementById("result-msg");
  const scorePara = document.getElementById("score");

  const language_id = languageMap[lang];
  const testCase = questions[currentQuestionIndex].testCases[0];

  fetch("https://judge0-ce.p.rapidapi.com/submissions?base64_encoded=false&wait=true", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-RapidAPI-Key": "a5e161b19cmsh2ada795e169c59bp1be186jsnded8384b4124",
      "X-RapidAPI-Host": "judge0-ce.p.rapidapi.com"
    },
    body: JSON.stringify({
      language_id: language_id,
      source_code: source_code,
      stdin: testCase.input
    })
  })
  .then(res => res.json())
  .then(data => {
    const output = data.stdout?.trim();
    const expected = testCase.expectedOutput.trim();

    if (output === expected) {
      if (!solvedQuestions.has(currentQuestionIndex)) {
        score++;
        solvedQuestions.add(currentQuestionIndex);
      }
      resultMsg.textContent = "✅ Correct!";
      resultMsg.style.color = "#00ff88";
    } else {
      resultMsg.textContent = `❌ Wrong output!\nYour output: ${output}`;
      resultMsg.style.color = "#ff5555";
    }

    scorePara.textContent = `Score: ${score}`;
  })
  .catch(err => {
    console.error(err);
    resultMsg.textContent = "⚠️ Compilation failed or API error.";
    resultMsg.style.color = "#ff5555";
  });
}

function toggleChatbot() {
  const chat = document.getElementById('chatbot-window');
  chat.classList.toggle('visible');
}

function handleChat(event) {
  if (event.key === 'Enter') {
    const input = document.getElementById('chat-input');
    const message = input.value.trim();
    if (message !== "") {
      addMessage("You", message);
      respondTo(message.toLowerCase());
      input.value = "";
    }
  }
}

function addMessage(sender, text) {
  const chatBody = document.getElementById('chat-body');
  chatBody.innerHTML += `<p><strong>${sender}:</strong> ${text}</p>`;
  chatBody.scrollTop = chatBody.scrollHeight;
}

function respondTo(msg) {
  let reply = "Sorry, I didn’t get that.";

  if (msg.includes("hello") || msg.includes("hi")) {
    reply = "Hey there! 👋 Need help with navigating CodeZone?";
  } else if (msg.includes("how to run") || msg.includes("code")) {
    reply = "Select a question, pick a language, write your code, and smash that Run button! 🚀";
  } else if (msg.includes("logout")) {
    reply = "Click the logout button at the top to exit your session.";
  } else if (msg.includes("score") || msg.includes("result")) {
    reply = "After you run code, I’ll show you if you passed or failed. Score updates too!";
  } else if (msg.includes("contact")) {
    reply = "For any issues, ping your admin (which is probably you, Vinay 😎).";
  }

  addMessage("CodeBot", reply);
}
