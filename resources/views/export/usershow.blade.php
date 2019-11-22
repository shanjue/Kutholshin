<!DOCTYPE html>
<html lang="en">

<head>


    <title>{{config('app.name')}}</title>
</head>

<body>
    <img src="/opt/lampp/htdocs/KuTholShin/public/images/simple.jpg" width="500px" height="500px">
    <h1>User Show</h1>
    <h2>{{$user->name}}</h2>
    <h3>{{$user->email}}</h3>

</body>

</html>