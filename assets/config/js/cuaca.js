$.ajax({
    url: 'https://api.openweathermap.org/data/2.5/weather',
    type: 'get',
    dataType: 'json',
    data: {
        'lang': 'id',
        'appid': '1c320d6ffb386e3d2d757839944ad9e8',
        'units': 'metric',
        'q': $('#input-kota').val()
    },
    success: function (result) {
        $('#suhu').html(result.main.feels_like + '°C')
        $('#cuaca').html(result.weather[0].description + `<img width="55" height="55" src="https://openweathermap.org/img/wn/` + result.weather[0].icon + `.png" alt="">`)
    }
})