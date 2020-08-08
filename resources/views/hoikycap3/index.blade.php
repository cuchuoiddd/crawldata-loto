<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form action="/hoi-ky" method="post">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3>Hệ thống phân tích Loto</h3>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <span class="">Từ ngày</span>
                                    <input type="date" name="date_start">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <span class="">Đến ngày</span>
                                    <input type="date" name="date_end">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-danger">Huy bo</button>
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

        <div class="row">
            @if(isset($lotos))
                ngon ngay
            @endif
        </div>
    </div>
</body>
</html>