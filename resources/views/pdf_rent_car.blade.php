<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>pdf rent car</title>
    <style>

        body {
          font-family: "thsarabunnew";
          font-size: 18px;
          line-height: 16px;
        }
        #td-1 {
          text-align: right;
          width: 85%;
        }
        #td-2 {
          text-align: left;
        }
        #td-3 {
          text-align: left;
        }
        #td-4 {
          text-align: left;
          width: 90%;
        }
        p {
          line-height: 16px;
        }
    </style>
</head>
<body>
  <div class="row">
    <div class="col-4">
        <img src="{{ public_path('img/slogan.png') }}" alt="IMG" style="width:100%; height:120px;" >
    </div>
    <div class="text-right">
        <strong>ใบสำหรับการยืมรถ</strong>
    </div>
  </div>
  <div class="row">
      <div class="col-12 text-center" style="background-color:grey">
        <h3><b>RECEIPT/TAX INVOICE</b></h3>
      </div>
  </div>
  <table style="width:100%">
    <tr>
      <th id="td-1">Doucument No:</td>
      <td id="td-2">{{$id}}</td>
    </tr>
    <tr>
      <th id="td-1">Detail:</td>
      <td id="td-2">{{$car_detail}}</td>
    </tr>
    <tr>
      <th id="td-1">ยืม:</td>
      <td id="td-2">{{$date_borrow}}, {{$time_borrow}}</td>
    </tr>
    <tr>
      <th id="td-1">คืน:</td>
      <td id="td-2">{{$date_return}}, {{$time_return}}</td>
    </tr>
    <tr>
      <th id="td-1">Address:</td>
      <td id="td-2">{{$landmark}}</td>
    </tr>
  </table>
  <table style="width:100%">
    <tr>
      <th id="td-3">Code:</td>
      <td id="td-4">{{$code}}</td>
    </tr>
    <tr>
      <th id="td-3">Name:</td>
      <td id="td-4">{{$name}}</td>
    </tr>
    <tr>
        <th id="td-3">Email:</td>
        <td id="td-4">{{$email}}</td>
    </tr>
    <tr>
      <th id="td-3">Phone:</td>
      <td id="td-4">{{$phone}}</td>
    </tr>
  </table>
  <br>
  <br>
    <table class="table table-sm text-center table-bordered">
        <thead class="thead-light">
          <tr>
            <th scope="col" style="width: 50%;">Description</th>
            <th scope="col" style="width: 50%;">Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td scope="row" style="width: 50%;">{{$car_detail}}</th>
            <td style="width: 50%;">{{$price}} / day</td>
          </tr>
        </tbody>
      </table>
      <table class="table table-sm text-center table-bordered">
        <thead class="thead-light">
          <tr>
            <th scope="col" style="width: 25%;">Days</th>
            <th scope="col" style="width: 25%;">Times</th>
            <th scope="col">AmountTotal</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td scope="row" style="width: 25%;">{{$days}} days.</th>
            <td style="width: 25%;">{{$times}} hr.</td>
            <td>{{$priceTotal}}</td>
          </tr>
        </tbody>
      </table>
      <br>
      <br>
      <table style="width:100%">
        <tr>
          <th style="text-align: left">Payment Type:</td>
          <td style="width: 80%; text-align: left">{{$payment_type}}</td>
        </tr>
        <tr>
          <th style="text-align: left">Date Pay:</td>
          <td style="width: 80%; text-align: left">{{$date_pay}}</td>
        </tr>
      </table>
      <br>
      <br>
          <table align="right" style="width:40%; border:1px black solid;">
              <tr>
                  <td style="height:10%; border-bottom:1px solid black;" align="center">............................................................ <br>(cnxdeliverycarandbike)</td>
              </tr>
              <tr>
                  <td style="height:10%;" align="center">............................................................ <br>({{$name}})</td>
              </tr>
          </table>
            
</body>
</html>