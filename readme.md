#### расчет стоимости доставки в службе DPD
```php
require 'vendor/autoload.php';

use Vdmkbu\Dpd\Config;
use Vdmkbu\Dpd\Shipment;

// готовим конфиг с данными для доступа к API DPD
// тестовый http://wstest.dpd.ru/services/
// боевой http://wstest.dpd.ru/services/
$config = new Config([
            'clientNumber' => 'DPD_CLIENT_NUMBER',
            'clientKey' => 'DPD_CLIENT_KEY',
            'server' => 'DPD_SERVER'
        ]);
        
// данные о доставке
// id города, из которого оставляем 
$from_city_id = "49265227"; // Челябинск

// id города, куда доставляем
$to_city_id = "195733465"; // Калуга

// готовим данные об отправлении
$shipment = new Shipment($config);
$shipment->setSender($from_city_id);
$shipment->setReceiver($to_city_id);
// самомвывоз
$shipment->setSelfDelivery(false);
// доставка по пункта выдачи
$shipment->setPickup(true);
// перечисляем тарифы доставки (если не устанавливать, то все доступные)
$shipment->setServiceCode("IND,PCL");

$items = [
     'weight' => $weight, // вес посылки, кг
     'cost' => $cost,     // стоимость
     'length' => $length, // длина посылки, см
     'width' => $width,   // ширина посылки, см
     'height' => $height, // высота посылки, см
     'quantity' => $Qty   // количество посылок
];

$shipment->setItems($items);

// Рассчитать общую стоимость доставки по России и странам ТС.
$calculator = $shipment->calculator()->getDeliveryCost();

// Рассчитать стоимость доставки по параметрам посылок по России и странам ТС.
$calculator = $shipment->calculator()->getDeliveryCostByParcels();
       
// стоимость для тарифа PCL
$cost = $calculator->getCostByCode("PCL");

// количество дней для тарифа PCL
$days = $calculator->getDaysByCode("PCL");

// полное название тарифа PCL
$name = $calculator->getNameByCode("PCL");
```
#### создание заказа DPD
```php
use Vdmkbu\Dpd\Config;
use Vdmkbu\Dpd\Order;

$config = new Config([
            'clientNumber' => 'DPD_CLIENT_NUMBER',
            'clientKey' => 'DPD_CLIENT_KEY',
            'server' => 'DPD_SERVER'
        ]);
$order = new Order($config);

        $order
            ->setDatePickup('2020-03-10')
            ->setSenderName('Иванов Сергей Петрович')
            ->setSenderCountryName('Россия')
            ->setSenderCity('Люберцы')
            ->setSenderStreet('Авиаторов')
            ->setSenderStreetAbbr('ул')
            ->setSenderHouse('1')
            ->setSenderFio('Смирнов Игорь Николаевич')
            ->setSenderPhone('89165555555')
            ->setPickupTimePeriod('9-18')
            ->setPayer('1021004119')
            ->setOrderNumberInternal(time())
            ->setServiceCode('CUR')
            ->setServiceVariant('ДД')
            ->setCargoNumPack(5)
            ->setCargoWeight(5)
            ->setCargoRegistered(false)
            ->setCargoCategory('Одежда')
            ->setReceiverName('Иванов Сергей Петрович')
            ->setReceiverCountryName('Россия')
            ->setReceiverCity('Люберцы')
            ->setReceiverStreet('Авиаторов')
            ->setReceiverStreetAbbr('ул')
            ->setReceiverHouse('2')
            ->setReceiverFio('Смирнов Игорь Николаевич')
            ->setReceiverPhone('89165555555');

        $order_status = $order->manage()->create();
        
        $order_id = $order_status->getOrderNum();
        $status = $order_status->getStatus();
        $internal_id = $order_status->getOrderNumInternal();
        
```

#### статус заказа DPD
```php
use Vdmkbu\Dpd\Config;
use Vdmkbu\Dpd\Services\Order\OrderTracking;


$config = new Config([
            'clientNumber' => 'DPD_CLIENT_NUMBER',
            'clientKey' => 'DPD_CLIENT_KEY',
            'server' => 'DPD_SERVER'
        ]);

// код заказа в системе DPD        
$code = "RU028215333";

$order = new OrderTracking($config);

// список всех статусов заказа
$status_list = $order->getStatusList($code);

// последний статус заказа
$last_status = $order->getLastStatus($code);        
```


##### id городов в системе DPD
например, получение из [Dadata](https://dadata.ru/api/)  
получим значение city_kladr_id для Челябинска
```bash
curl -X POST \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Token ${API_KEY}" \
  -d '{ "query": "Челябинск", "count":1 }' \
  http://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address
```

по значению city_kladr_id получим значение id города в службе доставки DPD
```bash
curl -X POST \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Token ${API_KEY}" \
  -d '{ "query": "7400000100000" }' \
  https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/delivery
```