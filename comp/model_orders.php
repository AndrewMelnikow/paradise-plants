<?php
namespace Order;
use \DateTime;
class CreateOrder
{
    private $order_info, $client_info;
    
    public function __construct($order_info) {
        $this->order_info = $order_info;
    }
    
    public function filterData() {
        foreach ($this->order_info as $k => $v) {
            $this->order_info[$k] = filter_var(stripslashes($v), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
    }
    
    public function createClientInfo() {
        foreach ($this->order_info as $k => $v) {
            if ($k !== 'total_price') {
                $this->client_info[$k] = filter_var(stripslashes($v), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        $this->client_info = serialize($this->client_info);
    }
    
    public function insertInDatabase() {
        global $pdo;
        
        /* Create order list */
        $order_list = serialize($_SESSION['basket']['items']);
        
        /* Insert datas in database */
        $query = "INSERT INTO orders VALUES (
                                            NULL, 
                                            :client_info,
                                            :order_list,
                                            :total_price
                                            )";
        $items = $pdo->prepare($query);            
        $items->execute([
                       'client_info' => $this->client_info,
                       'order_list' => $order_list,
                       'total_price' => $this->order_info['total_price']
                        ]);               
    }
    
    public function unsetBasket() {
        unset($_SESSION['basket']['items']);
        unset($_SESSION['basket']['total-count']);
    }
    
    public function redirect() {        
        header("Location: checkout_success.php");
    }
}