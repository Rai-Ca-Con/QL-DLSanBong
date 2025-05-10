<?php

namespace App\Services;

use App\Services\IService\INotificationService;
use Illuminate\Support\Facades\Mail;

class EmailNotificationService implements INotificationService
{
    public function send($data,$subject)
    {
        $data = [
            'dateNow' => date('d-m-Y'),
            'nameCus' => 'Nguyễn Văn A',
            'emailCus' => 'a@example.com',
            'addressCus' => '123 Main St',
            'phoneCus' => '0123456789',
            'receiptId' => 'uuid-0005-aaaa-bbbb-000000000005',
            'bookingId' => 'uuid-0005-aaaa-bbbb-000000000005',
            'accountId' => 'uuid-0005-aaaa-bbbb-000000000005',
            'nameField' => "Sân vận động quốc gia mỹ đình",
            'timeStart' => "2025-05-06 20:05:16",
            'timeEnd' => "2025-05-06 22:05:16",
            'amount' => "120.000"." VND",
        ];


        // ts1 ten view mail; ts2 du lieu gui sang view
        //ts3 ham xu li logic gui mail
        Mail::send('notification.email', $data, function ($email) use ($data,$subject) {
            $email->subject("Thông báo thông tin về: ".$subject);
            // gui den dia chi email nao, ten nguoi gui den la gi
            $email->to('assasinn020@gmail.com','Test1'); //tra ve true || false
            // bien email co the dinh kem 1 file
        });
    }
}
