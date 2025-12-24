<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Choose Role</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e0f7fa, #fff);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    h2 { color: #00838f; margin-bottom: 30px; }
    .btn {
      padding: 15px 35px;
      margin: 10px;
      border: none;
      border-radius: 12px;
      font-size: 18px;
      cursor: pointer;
      color: #fff;
      transition: 0.3s;
    }
    .founder { background-color: #00796b; }
    .freelancer { background-color: #00bcd4; }
    .btn:hover {
      transform: scale(1.05);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }
  </style>
</head>
<body>
  <h2>Choose Your Role</h2>
  <a href="{{ route('register.founder') }}"><button class="btn founder">Founder 👔</button></a>
  <a href="{{ route('register.freelancer') }}"><button class="btn freelancer">Freelancer 💻</button></a>
</body>
</html>
