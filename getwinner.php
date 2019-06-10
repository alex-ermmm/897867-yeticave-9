<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');
require_once ('../../vendor/autoload.php');

if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    $sql_lot = 'SELECT * FROM lot WHERE win_user_id  is null and date_finish < NOW()';
    
    if ($res_lot = mysqli_query($link, $sql_lot)) 
    {
        $lots = mysqli_fetch_all($res_lot, MYSQLI_ASSOC);  

        foreach ($lots as $value) 
        {
             $sql_final_bet = 'SELECT * FROM bet WHERE lot_id = '.$value['lot_id'].' ORDER BY lot_id DESC LIMIT 1';
             if ($res_final_bet = mysqli_query($link, $sql_final_bet))
                {
                    $final_bet = mysqli_fetch_all($res_final_bet, MYSQLI_ASSOC);
                    if (!empty($final_bet)) 
                    {

                        $user_id = $final_bet['0']['user_id'];
                        $final_lot = $final_bet['0']['lot_id'];
                        
                        $sql_add_winer = 'UPDATE lot SET win_user_id = (?) WHERE lot.lot_id ='. $final_lot;

                        $stmt = db_get_prepare_stmt($link, $sql_add_winer, [$user_id]);
                        $result = mysqli_stmt_execute($stmt);
                        
                            if ($result) 
                            {

                                $transport = new Swift_SmtpTransport("phpdemo.ru", 25);
                                $transport->setUsername("keks@phpdemo.ru");
                                $transport->setPassword("htmlacademy");

                                $mailer = new Swift_Mailer($transport);

                                $logger = new Swift_Plugins_Loggers_ArrayLogger();
                                $mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));

                                $sql = "SELECT * FROM lot WHERE win_user_id = ".$user_id. " and lot_id = ".$final_lot;

                                $res = mysqli_query($link, $sql);
                                if ($res && mysqli_num_rows($res)) 
                                {
                                    $winner = mysqli_fetch_all($res, MYSQLI_ASSOC);

                                    $res = mysqli_query($link, "SELECT email, name FROM user");

                                    if ($res && mysqli_num_rows($res)) 
                                    {
                                        $users = mysqli_fetch_all($res, MYSQLI_ASSOC);

                                        $recipients = [];

                                        foreach ($users as $user) {
                                            $recipients[$user['email']] = $user['name'];
                                        }

                                        $message = new Swift_Message();
                                        $message->setSubject("Ваша ставка победила");
                                        $message->setFrom(['keks@phpdemo.ru' => 'YetiCave']);
                                        $message->setBcc($recipients);

                                        $msg_content = include_template('email_tpl.php', ['users' => $users]);
                                        $message->setBody($msg_content, 'text/html');
                                        $result = $mailer->send($message);

                                        $log_file = 'log.txt';
                                        $message_log = file_get_contents($log_file);
                                        if ($result) {
                                            $message_log = date("m.d.y")." ".date("H:i:s")."Рассылка успешно отправлена \n";
                                        }
                                        else {
                                            $message_log =  date("m.d.y")." ".date("H:i:s"). "Не удалось отправить рассылку: " . $logger->dump() ."\n";
                                        }
                                        file_put_contents($log_file, $message_log);

                                    }
                                }
                                else 
                                {
                                        $content = include_template('error.php', ['error' => mysqli_error($link)]);
                                }
                            }
                    
                    }
                }
        
        }
}
    else {
        print mysqli_error($link);
    }
}