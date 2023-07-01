<?php
if (isset($_POST['chat'])) {
    if (chat($_POST) > 0) {
    }
}
$emailuser = $_SESSION['email'];
$chat_selft = query("SELECT * FROM chat INNER JOIN user USING(Email) WHERE Email = '$emailuser'");
$chat_others = query("SELECT * FROM chat INNER JOIN user USING(Email) WHERE Email != '$emailuser'");
date_default_timezone_set('Asia/Makassar');
$waktu = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="../assets/css/chat.css">
</head>

<body>
    <div class="col-md-12">
        <div class="box box-danger direct-chat direct-chat-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Chat</h3>
            </div>
            <div class="box-body">
                <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <?php $i = 1; ?>
                    <?php foreach ($chat_others as $row) : ?>
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left"><?= $row['UserName'] ?></span>
                                <span class="direct-chat-timestamp pull-right"><?= $row['waktu'] ?></span>
                            </div>
                            <!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="../assets/profile/<?= $row['gambar'] ?>" alt="Message User Image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                <?= $row['chat'] ?>
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    <!-- Message to the right -->
                    <?php $i = 1; ?>
                    <?php foreach ($chat_selft as $row) : ?>
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right"> <span class="direct-chat-timestamp pull-left"><?= $row['UserName'] ?></span>
                                </span>
                                <span class="direct-chat-timestamp pull-left"><?= $row['waktu'] ?></span>
                            </div>
                            <!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="../assets/profile/<?= $row['gambar'] ?>" alt="Message User Image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                <?= $row['chat'] ?>
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="box-footer">
                <form action="" method="post">
                    <div class="input-group">
                        <input class="d-none" type="Email" name="Email" value="<?= $emailuser ?>">
                        <input class="d-none" type="text" name="waktu" value="<?= $waktu ?>">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" name="chat" class="btn btn-danger btn-flat">Send</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>