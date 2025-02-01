<?php 
global $mydb;
	$message_id = isset($_GET['id']) ? $_GET['id'] : '';

    $sql = "SELECT * FROM tblinbox WHERE INBOXID = $message_id";
    $mydb->setQuery($sql);
    $res = $mydb->loadSingleResult();

    $sql = "UPDATE tblinbox SET VIEW=0 WHERE INBOXID = $message_id";
    $mydb->setQuery($sql);
    $mydb->executeQuery();
?>
<style>
    .content-header {
        min-height: 50px;
        border-bottom: 1px solid #ddd;
        font-size: 15px;
        font-weight: bold;
        padding: 10px;
    }
    .content-body {
        min-height: 350px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 5px;
    }
    .content-body > p {
        padding: 10px;
        font-size: 12px;
        font-weight: bold;
        border-bottom: 1px solid #ddd;
    }
    .message-content {
        padding: 10px;
        font-size: 14px;
        font-weight: normal;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fff;
        min-height: 150px;
    }
    .content-footer {
        min-height: 100px;
        border-top: 1px solid #ddd;
        padding: 10px;
        background-color: #f1f1f1;
        border-radius: 5px;
        text-align: center;
    }
    .content-footer .btns {
        margin-top: 20px;
        padding: 10px 15px;

        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    </style>

<div class="message-container">
    <div class="content-header">Message Details</div>
    <div class="content-body">
        <p><strong>Sender:</strong> <?php echo $res->FULLNAME;?></p>
        <p><strong>Email:</strong> <?php echo $res->EMAIL;?></p>
        <p><strong>Date and Time:</strong> <?php echo $res->DATETIME;?></p>
        <div class="message-content"><?php echo $res->MESSAGE;?></div>
    </div>
    <div class="content-footer">
        <button class="btns btn-primary" onclick="window.history.back()">Back</button>
    </div>
</div>