<?php
namespace lib;
include "../db.php";
class Popular extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT COUNT(book_name) AS num, book_name, auth_name
FROM `output` LEFT JOIN `books` ON books.book_id=output.book_id
LEFT JOIN `authors` ON books.author_id=authors.author_id
WHERE MONTH(output_date)=MONTH(CURDATE()) GROUP BY book_name ORDER BY COUNT(book_name) DESC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Popular();
$rows = $out->fetchAll();

if (isset($_POST['menu'])){
    header("Location: index.php");
}
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/tables.css">
    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/amcharts.js"></script>
    <script type="text/javascript" src="http://www.amcharts.com/lib/3/serial.js"></script>
</head>
<body>
<div class="container">
    <form method="post">
        <nav id="header" class="navbar navbar-fixed-top" role="navigation">
            <ul id="panel" class="nav navbar-nav">
                <li><a href="output.php">Выдача книг</a></li>
                <li><a href="books.php">Книги</a></li>
                <li><a href="authors.php">Авторы</a></li>
                <li><a href="genres.php">Жанры</a></li>
                <li><a href="readers.php">Читатели</a></li>
                <li><a href="languages.php">Языки</a></li>
                <li><a href="publishers.php">Издательства</a></li><br>
                <li><a href="debtors.php">Должники</a></li>
                <li id="current"><a href="popular.php">Популярные книги месяца</a></li>
            </ul>
            <!--<button id="add" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button>-->
            <div class="container">
                <table class="title table table-striped">
                    <tr>
                        <td width="150">Была выдана раз</td>
                        <td width="500">Книга</td>
                        <td width="500">Автор</td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr>
                        <td width="150"><?= $rows[$i]['num']?></td>
                        <td width="500"><?= $rows[$i]['book_name']?></td>
                        <td width="500"><?= $rows[$i]['auth_name']?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </form>
    <div id="chartdiv" style="margin-left: 20%; width: 60%; height: 400px;" ></div>
</div>
<!-- amCharts javascript code -->
<script type="text/javascript">
    AmCharts.makeChart("chartdiv",
        {
            "type": "serial",
            "categoryField": "category",
            "angle": 30,
            "depth3D": 30,
            "startDuration": 1,
            "fontSize": 10,
            "categoryAxis": {
                "gridPosition": "start",
                "color": "white"
            },
            "trendLines": [],
            "graphs": [
                {
                    "balloonText": "[[title]]: [[value]]",
                    "fillAlphas": 1,
                    "gapPeriod": 1,
                    "id": "AmGraph-1",
                    "lineColor": "#9BACF8",
                    "title": "Была выдана",
                    "type": "column",
                    "valueField": "column-1",
                    "color": "white"
                }
            ],
            "guides": [],
            "valueAxes": [
                {
                    "id": "ValueAxis-1",
                    //"title": "",
                    "color": "white"
                }
            ],
            "allLabels": [],
            "balloon": {},
            "legend": {
                "enabled": true,
                "useGraphSettings": true,
                "color": "white"
            },
            "titles": [
                {
                    "id": "Title-1",
                    "size": 18,
                    "text": "Популярность книг",
                    "color": "white"
                }
            ],
            "dataProvider": [
                <?php for ($i = 0; $i < count($rows); $i++){?>
                {

                    "category": "<?php echo $rows[$i]['book_name']?>",
                    "column-1": "<?php echo $rows[$i]['num']?>",
                    "color": "white"
                },
                <?php } ?>
            ]
        }
    );
</script>
</body>
</html>