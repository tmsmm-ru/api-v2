<?php

class TmSMMApiV2
{
    /** API URL */
    public $api_url = 'https://tmsmm.ru/api/v2';

    /** Your API key */
    public $api_key = '';

    public function __construct($key)
    {
        $this->api_key = $key;
    }

    /** Add order */
    public function order($data)
    {
        $post = array_merge(['key' => $this->api_key, 'action' => 'add'], $data);

        return json_decode($this->connect($post));
    }

    /** Get order status  */
    public function status($order_id)
    {
        return json_decode(
            $this->connect([
                'key'    => $this->api_key,
                'action' => 'status',
                'order'  => $order_id
            ])
        );
    }

    /** Get orders status */
    public function multiStatus($order_ids)
    {
        return json_decode(
            $this->connect([
                'key'    => $this->api_key,
                'action' => 'status',
                'orders' => implode(",", (array)$order_ids)
            ])
        );
    }

    /** Get services */
    public function services()
    {
        return json_decode(
            $this->connect([
                'key'    => $this->api_key,
                'action' => 'services',
            ])
        );
    }

    /** Refill order */
    public function refill(int $orderId)
    {
        return json_decode(
            $this->connect([
                'key'    => $this->api_key,
                'action' => 'refill',
                'order'  => $orderId,
            ])
        );
    }

    /** Refill orders */
    public function multiRefill(array $orderIds)
    {
        return json_decode(
            $this->connect([
                'key'    => $this->api_key,
                'action' => 'refill',
                'orders' => implode(',', $orderIds),
            ]),
            true
        );
    }

    /** Get refill status */
    public function refillStatus(int $refillId)
    {
        return json_decode(
            $this->connect([
                'key'    => $this->api_key,
                'action' => 'refill_status',
                'refill' => $refillId,
            ])
        );
    }

    /** Get refill statuses */
    public function multiRefillStatus(array $refillIds)
    {
        return json_decode(
            $this->connect([
                'key'     => $this->api_key,
                'action'  => 'refill_status',
                'refills' => implode(',', $refillIds),
            ]),
            true
        );
    }

    /** Cancel orders */
    public function cancel(array $orderIds)
    {
        return json_decode(
            $this->connect([
                'key'    => $this->api_key,
                'action' => 'cancel',
                'orders' => implode(',', $orderIds),
            ]),
            true
        );
    }

    /** Get balance */
    public function balance()
    {
        return json_decode(
            $this->connect([
                'key'    => $this->api_key,
                'action' => 'balance',
            ])
        );
    }

    private function connect($post)
    {
        $_post = [];
        if (is_array($post)) {
            foreach ($post as $name => $value) {
                $_post[] = $name . '=' . urlencode($value);
            }
        }

        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        if (is_array($post)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, join('&', $_post));
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        $result = curl_exec($ch);
        if (curl_errno($ch) != 0 && empty($result)) {
            $result = false;
        }
        curl_close($ch);

        return $result;
    }
}

try {
    $key = ''; // key

    $oTmSMM = new TmSMMApiV2($key);

//    $services = $oTmSMM->services(); # Return all services
//    $balance = $oTmSMM->balance(); # Return user balance
//
//    // Add order
//    $order = $oTmSMM->order(['service' => 1, 'link' => 'https://example.com/test', 'quantity' => 100]); # Default
//    $order = $oTmSMM->order(['service' => 1, 'link' => 'https://example.com/test', 'comments' => "good pic\like photo\n:)\n;)"]); # Custom Comments
//    $order = $oTmSMM->order(['service' => 1, 'link' => 'https://example.com/test', 'quantity' => 100, 'answer_number' => '7']); # Poll
//
//    $status = $oTmSMM->status($order->order); # Return status, charge, remains, start count, currency
//
//    $statuses = $oTmSMM->multiStatus(['65ae4aa2535c2', '65ae4a63c277d', '65ae4a1d44856']); # Return orders status, charge, remains, start count, currency
//
//    $refill = (array)$oTmSMM->multiRefill(['65ae4a1d44856', '65ae4a63c277d']);
//
//    $refillIds = array_column($refill, 'refill');
//
//    if ($refillIds) {
//        $refillStatuses = $oTmSMM->multiRefillStatus($refillIds);
//    }
    
} catch (\Exception $e) {
    echo $e->getMessage();
}
