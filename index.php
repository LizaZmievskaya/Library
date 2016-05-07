<?php
if (isset($_POST['output'])){
    header("Location: output.php");
} elseif (isset($_POST['books'])){
    header("Location: books.php");
} elseif (isset($_POST['authors'])){
    header("Location: authors.php");
} elseif (isset($_POST['readers'])){
    header("Location: readers.php");
} elseif (isset($_POST['languages'])){
    header("Location: languages.php");
} elseif (isset($_POST['publishers'])){
    header("Location: publishers.php");
} elseif (isset($_POST['countries'])){
    header("Location: countries.php");
} elseif (isset($_POST['debtors'])){
    header("Location: debtors.php");
} elseif (isset($_POST['popular'])){
    header("Location: popular.php");
}
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <form method="post">
        <div class="list">
            <button name="output" type="submit" class="btn btn-default">Выдача книг</button>
            <button name="books" type="submit" class="btn btn-default">Книги</button>
            <button name="authors" type="submit" class="btn btn-default">Авторы</button>
            <button name="readers" type="submit" class="btn btn-default">Читатели</button>
            <button name="languages" type="submit" class="btn btn-default">Языки</button>
            <button name="publishers" type="submit" class="btn btn-default">Издательства</button>
            <button name="countries" type="submit" class="btn btn-default">Страны</button>
        </div>
        <div class="report">
            <button name="debtors" type="submit"  class="btn btn-default">Должники</button>
            <button name="popular" type="submit" class="btn btn-default">Популярные книги этого месяца</button>
        </div>
    </form>

    
</div>
</body>
</html>