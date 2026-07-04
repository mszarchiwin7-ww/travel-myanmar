<?php
// ၁။ Database ချိတ်ဆက်ရန် အချက်အလက်များ ပြင်ဆင်ခြင်း
$host = "localhost";
$username = "root";
$password = "";
$dbname = "my_website_db";
$port = 3307; // 🛑 ကျွန်တော်တို့ ပြောင်းထားတဲ့ Port နံပါတ် ၃၃၀၇ ဖြစ်ပါတယ်

// ၂။ Connection စတင်ဆောက်တည်ခြင်း
$conn = new mysqli($host, $username, $password, $dbname, $port);

// ချိတ်ဆက်မှု အောင်မြင်/မအောင်မြင် စစ်ဆေးခြင်း
if ($conn->connect_error) {
    die("Database ချိတ်ဆက်မှု ပျက်ပြားသွားပါသည်- " . $conn->connect_error);
}

// ၃။ Form ထဲက ပေးပို့လိုက်တဲ့ စာသားများကို လက်ခံဖတ်ရှုခြင်း (POST Method)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $visitor_name = $_POST['visitor_name'];
    $message = $_POST['message'];

    // ၄။ Database Table ထဲသို့ ဒေတာ အသစ်ထည့်မယ့် SQL ကုဒ်ရေးခြင်း
    $sql = "INSERT INTO feedbacks (visitor_name, message) VALUES ('$visitor_name', '$message')";

    // ၅။ အမှန်တကယ် အလုပ်လုပ်ခိုင်းပြီး အောင်မြင်ကြောင်း ပြသခြင်း
    if ($conn->query($sql) === TRUE) {
        echo "<div style='text-align: center; margin-top: 50px; font-family: sans-serif;'>";
        echo "<h2 style='color: #28a745;'>အောင်မြင်ပါသည်! 🎉</h2>";
        echo "<p>Zar Chi Win ရေ... သင်ရိုက်လိုက်တဲ့ ဒေတာတွေကို ဒေတာဘေ့စ်ထဲ သိမ်းဆည်းပြီးပါပြီဗျာ။</p>";
        echo "<br><a href='index.php' style='text-decoration: none; background: #007bff; color: white; padding: 10px 20px; border-radius: 4px;'>နောက်သို့ ပြန်သွားရန်</a>";
        echo "</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// ဒေတာဘေ့စ် ချိတ်ဆက်မှုကို ပိတ်သိမ်းခြင်း
$conn->close();
?>