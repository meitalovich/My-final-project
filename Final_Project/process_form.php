<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "Book_Store");

// בדיקה האם חיבור למסד הנתונים הצליח
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// אחזור נתונים מהטופס
$title = isset($_POST['title']) ? $_POST['title'] : "";
$category = isset($_POST['category']) ? $_POST['category'] : "";
$author = isset($_POST['author']) ? $_POST['author'] : "";
$year_pub = isset($_POST['year_pub']) ? intval($_POST['year_pub']) : 0;
$price = isset($_POST['price']) ? intval($_POST['price']) : 0;

// העלאת תמונה
$targetDirectory = "C:\\xampp\\tmp\\"; 
$fileName = isset($_FILES['img']['name']) ? $_FILES['img']['name'] : "";
$targetPath = $targetDirectory . $fileName;

// בדיקה שהתיקיה קיימת
if (!file_exists($targetDirectory)) {
    echo "התיקיה לא קיימת";
    exit; // סיום הרצת הקוד
}

// בדיקת הרשאות הכתיבה לתיקיה
if (!is_writable($targetDirectory)) {
    echo "אין הרשאות כתיבה לתיקיה";
    exit; // סיום הרצת הקוד
}

if (isset($_FILES['img'])) {
    // קוד העלאת התמונה כאן
 } else {
    echo "לא הועלה שוםםםםם קובץ   .";
 }
 
 if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    $fileName = $_FILES['img']['name'];
    // המשך עיבוד התמונה...
  } else {
    // אם הקובץ לא מוגדר או שיש שגיאה בהעלאה
    $fileName = "";
  }
  

// העברת הקובץ לתיקיה הרצויה
if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
    // העלאת הקובץ הצליחה, ניתן להמשיך להוסיף למסד הנתונים

    // כתיבה וביצוע שאילתת SQL להוספת נתונים למסד הנתונים
    $query = $connect->prepare('INSERT INTO products (title,author,year_pub, price_old, book_image,cat_id,status1)
        VALUES (?, ?, ?, ?, ?,?,0)');
    $query->bind_param("ssiisi", $title, $author, $year_pub, $price, $fileName,$category);
    echo $fileName;

    if ($query->execute()) {
        // הספר נוסף בהצלחה
        echo "הספר נשלח בהצלחה.";
    } else {
        // אירעה שגיאה במהלך ביצוע השאילתה
        echo "אירעה שגיאה בעת שליחת הספר: " . $query->error;
    }

} else {
    // כישלון בעת העלאת התמונה
    echo "אירעה שגיאה בעת העלאת התמונה.";
}

// סגירת החיבור למסד הנתונים

?>
