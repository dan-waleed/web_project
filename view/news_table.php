<h2>جميع الأخبار</h2>

<?php
if ($result && $result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
        <th>id</th><th>title</th><th>body</th><th>image</th><th>dateposted</th>
        <th>category_id</th><th>author_id</th><th>status</th>
    </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['title']}</td>
            <td>{$row['body']}</td>
            <td><img src='{$row['image']}' width='80'></td>
            <td>{$row['dateposted']}</td>
            <td>{$row['category_id']}</td>
            <td>{$row['author_id']}</td>
            <td>{$row['status']}</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "لا توجد أخبار لعرضها.";
}

echo '<button onclick="window.location.href=\'page_add_news.html\'">إضافة خبر جديد</button>';
?>
