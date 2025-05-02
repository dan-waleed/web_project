<?php
require_once 'config.php';

$sql = "SELECT * FROM news";
$result = $conn->query($sql);

echo "<h2>جميع الأخبار</h2>";

if ($result && $result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
            <th>id</th>
            <th>title</th>
            <th>body</th>
            <th>image</th>
            <th>dateposted</th>
            <th>category_id</th>
            <th>author_id</th>
            <th>status</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['body'] . "</td>";
        echo "<td><img src='" . $row['image'] . "' width='80'></td>";
        echo "<td>" . $row['dateposted'] . "</td>";
        echo "<td>" . $row['category_id'] . "</td>";
        echo "<td>" . $row['author_id'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
        
    }

    echo "</table>";
} else {
    echo "لا توجد أخبار لعرضها.";
}

echo "<button onclick=\"window.location.href='page_add_news.html'\">إضافة خبر جديد</button>";

?>
