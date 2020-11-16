<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>아이디 찾기</title>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/findid.css">
</head>
<body>
<form action="./findid_php.php" method="post">
    <input type="text" name="findid_nickname" placeholder="찾으시려는 아이디의 닉네임을 입력해주세요" required>
    <input type="text" name="findid_hint" placeholder="찾으시려는 아이디의 보물1호를 입력해주세요" required>
    <button>아이디 찾기</button>
</form>
</body>
</html>