<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Expired</title>
</head>
<body>
    <h2>Hello,</h2>
    <p>Your short link  <strong>{{ url('/short/' . $link->short_url) }}</strong> has expired</p>
    <p>please generate a new if needed</p>
</body>
</html>