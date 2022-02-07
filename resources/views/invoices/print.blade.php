<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice</title>
    <style>
        .container {
            max-width: 800px;
            margin: auto;
        }

        .header {
            margin-bottom: 30px;
        }

        table, td, th {
            border: 1px solid #272727;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 60px;
            margin-bottom: 130px;
        }

        th {
            height: 40px;
            background: #D9D9D9;
        }
        
        tr{
            text-align: center;
            height: 30px;
        }
        .footer{
           text-align: center;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <img src="{{ asset('assets') }}/img/brand/logo-purple.png" alt="Logo" width="100px" height="40px">
            </div>
            <p>
                Mohcine BAADI <br/>
                Company Inc <br/>
                Morocco, Al Hoceima <br/>
                32302
            </p>
        </div>
        <hr>          
        <table>
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Date</th>
                    <th>Bill to</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <th>#{{ $invoice->id }}</th>
                <td>{{ $invoice->date }}</td>                              
                <td>{{ $invoice->supplier->first_name.' '.$invoice->supplier->last_name }}</td>
                <td>${{ $invoice->amount }}</td>
                <td>
                    @if ($invoice->finalized == 0)
                        On hold
                    @else
                        Paid
                    @endif                 
                </td>
            </tr>
            </tbody>
        </table>

        <div class="footer">
            <div>
                <p>Signature</p>
                <p>..........................................</p>
            </div>
        </div>
    </div>
</body>
</html>
