<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>비밀번호 찾기</title>
    <link rel="stylesheet" href="./css/findid.css">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo&display=swap" rel="stylesheet">
</head>
<body>
<form action="./findpw_php.php" method="post">
    <input type="text" name="findpw_id" placeholder="찾으시려는 비밀번호의 아이디를 입력해주세요" required>
    <input type="text" name="findpw_nickname" placeholder="찾으시려는 비밀번호의 닉네임을 입력해주세요" required>
    <input type="text" name="findpw_hint" placeholder="찾으시려는 비밀번호의 보물1호를 입력해주세요" required>
    <button>비밀번호 찾기</button>
</form>
</body>
</html>