<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Restaurant Ticket</title>
</head>
<body>
  <div>
    <p>- Client name: {{ $Client }}</p>
    <p>- In: {{ $Datein }}</p>
    <p>- Out: {{ $Dateout }}</p>
    <p>- Table: {{ $Table }}</p>
    <p>- Dishes:</p>
    <p>Entree:</p>
    <h5>-Name: {{ $Entree }}</h5>
    <h5>-Quantity: {{ $EntreeQ }}</h5>
    <h5>-Price: {{ $EntreeP }}</h5>
    <p>Plat:</p>
    <h5>-Name: {{ $Plat }}</h5>
    <h5>-Quantity: {{ $PlatQ }}</h5>
    <h5>-Price: {{ $PlatP }}</h5>
    <p>Dessert:</p>
    <h5>-Name: {{ $Dessert }}</h5>
    <h5>-Quantity: {{ $DessertQ }}</h5>
    <h5>-Price: {{ $DessertP }}</h5>

    <p>- Total price: {{ $Total }}$</p>
  </div>
</body>
</body>
</html>