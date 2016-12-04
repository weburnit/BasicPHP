**Add Agent**
```php
$agent = new Agent('PropertyFinder');
$changiAiport = new Airport('Changi Airport');
$changiAiport->addVehicle(new Plane('AirBus A320', 'CG-AB320', 250))
$this->agent->contractWith($changiAirport);
```
```php
$madrid = new Location('Madrid', 12, 13);
$train  = new Train('train', '78A', 300);
$train->setCurrentLocation($madrid);
$bacelona      = new Location('Barcelona', 12, 13);
$trainBoarding = new BoardingCard($train, $bacelona, 'Sit in seat 45B');

$airportBus = new Bus('Airport bus', '3254-A', 50);
$airportBus->setCurrentLocation($bacelona);
$geronaAirport = new Location('Gerona Airport', 15, 16);
$busTicket     = new BoardingCard($airportBus, $geronaAirport, 'No seat assignment');

$airplane = new Plane('Plane', 'SK455', 250);
$airplane->setCurrentLocation($geronaAirport);
$stockholm = new Location('Stockholm', 17, 18);
$airTicket = new BoardingCard($airplane, $stockholm, 'Gate 45B, seat 3A. Baggage drop at ticket counter 344');

$newYorkFlight = new Plane('Plane', 'SK22', 250);
$newYorkFlight->setCurrentLocation($stockholm);
$newYork         = new Location('New York JFK', 19, 20);
$ticketToNewYork = new BoardingCard(
    $newYorkFlight,
    $newYork,
    'Gate 22, seat 7B. Baggage will we automatically transferred from your last leg'
);

$agent->addCard($ticketToNewYork)->addCard($airTicket)
    ->addCard($busTicket)->addCard($trainBoarding);

$boardingCards = $agent->resolve();

$agent->printItinerary();
```
*Agent can receive a ticket`(BoardingCar)` request*
```php
//Agent must contract with Airport or Bus Station first
$stockholm = new Location('Stockholm', 17, 18);
$boardingCar = $agent->requestTicket($stockholm);
```
