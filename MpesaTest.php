<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form </title>
</head>
<style >
    body{
        background-color: yellow;
    }
</style>
<body>
   
 <center>
     <form style="padding-top: 10px;" action="mpesa.php" method="POST">
        <fieldset style="width: 80%;height:500px; background-color: white;">
        <label style="padding-top:50px; font-size:50px; color: white;" >Lipa Online</label><br><br><br>


```php
            <?php
           // Initialize the variables
            $consumer_key = 'Lms5EIf2gK16o1sptYPaA3HsfbGUd7fv';
            $consumer_secret = 'dgfk1IefQx1SnG1A';
            $Business_Code = '174379';
            $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
            $Type_of_Transaction = 'CustomerPayBillOnline';
            $Token_URL = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
            $phone_number = $_POST['phone_number'];
            $OnlinePayment = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
            $total_amount = $_POST['amount'];
            $CallBackURL = 'https://2f50f430.ngrok.io/callback.php?key=Your$trongPssWard';
           $Time_Stamp = date("Ymdhis");
            $password = base64_encode($Business_Code . $Passkey .$Time_Stamp);

            $curl_Tranfer = curl_init();
            curl_setopt($curl_Tranfer, CURLOPT_URL, $Token_URL);
            $credentials = base64_encode($consumer_key . ':' . $consumer_secret);
            curl_setopt($curl_Tranfer, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials)); 
            curl_setopt($curl_Tranfer, CURLOPT_HEADER, false);
            curl_setopt($curl_Tranfer, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_Tranfer, CURLOPT_SSL_VERIFYPEER, false);
            $curl_Tranfer_response = curl_exec($curl_Tranfer);
           

            $token = json_decode($curl_Tranfer_response)->access_token;

            $curl_Tranfer2 = curl_init();
            curl_setopt($curl_Tranfer2, CURLOPT_URL, $OnlinePayment);
            curl_setopt($curl_Tranfer2, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $token));
        


            $curl_Tranfer2_post_data = [
                'BusinessShortCode' => $Business_Code,
                'Password' => $password,
                'Timestamp' =>$Time_Stamp,
                'TransactionType' =>$Type_of_Transaction,
                'Amount' => $total_amount,
                'PartyA' => $phone_number,
                'PartyB' => $Business_Code,
                'PhoneNumber' => $phone_number,
                'CallBackURL' => $CallBackURL,
                'AccountReference' => 'Hillary',
                'TransactionDesc' => 'Test',
            ];

            $data2_string = json_encode($curl_Tranfer2_post_data);

            curl_setopt($curl_Tranfer2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_Tranfer2, CURLOPT_POST, true);
            curl_setopt($curl_Tranfer2, CURLOPT_POSTFIELDS, $data2_string);
            curl_setopt($curl_Tranfer2, CURLOPT_HEADER, false);
            curl_setopt($curl_Tranfer2, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl_Tranfer2, CURLOPT_SSL_VERIFYHOST, 0);
            $curl_Tranfer2_response = json_decode(curl_exec($curl_Tranfer2));

            echo json_encode($curl_Tranfer2_response, JSON_PRETTY_PRINT);
            ?>

            <form class="contact2-form validate-form" action="#" method="post">
                <input type="hidden" name="Check_request_ID" value="<?php echo $curl_Tranfer2_response->Check_request_ID ?>">
                </br><br>
                        <button class="contact2-form-btn" style="margin-bottom: 30px;">
                            Confirm Payment is Complete
                        </button>
                
            </form>
       
       </fieldset>
    </form>    
</center>
</div>
</body>
</html>