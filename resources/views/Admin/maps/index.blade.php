@extends('Admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>SmartCity - обзор точек </h2>
            </div>
            @if(!is_null($point))
            <div id="map" style="width:100%;height:600px;">
                Карта Киева
            </div>
            @endif
        </div>
    </div>
{{--    @php--}}
{{--    echo '<pre>'; print_r(json_encode($point)); echo '</pre>';--}}
{{--    @endphp--}}
    @if($point)
    <script type="text/javascript">
        //подгружаем карты Google
        function myMap() {
            var mapCanvas = document.getElementById("map");
            var mapOptions = {
                center: new google.maps.LatLng(50.45466, 30.5238),
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.HYBRID
            };
            var map = new google.maps.Map(mapCanvas, mapOptions);
            //создаём маркеры
            let markers = @json($point);
            console.log(markers);

            //делаем цикл перебора точек и создаем их
            for(var i = 0; i < markers.length; i++)
            {
                addMarker(markers[i]);
            }

            //функция создания точек
            function addMarker(properties)
            {
                var myLatlng = new google.maps.LatLng(properties.latitude, properties.longitude);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    //animation:google.maps.Animation.BOUNCE
                });
                // if (marker.properties.type === '1') {
                //     //добавляем новую иконку
                //     marker.color(#1bcf13);
                // }else if (marker.properties.type === '2') {
                //     marker.color(#fec205);
                // }else{
                //     marker.color(#fa0505);
                // }
                if (properties.comment)
                {
                    //информационное окно
                    var InfoWindow = new google.maps.InfoWindow({
                        content: properties.comment,
                        //image: '<img src="properties.image">'
                    });
                    //клик по маркуру
                    marker.addListener('click', function () {
                        InfoWindow.open(map, marker);
                        //увеличение
                        var pos = map.getZoom();
                        map.setZoom(22);
                        map.setCenter(marker.getPosition());
                        window.setTimeout(function()
                        {
                            map.setZoom(pos);
                        },10000);
                    })
                }
            }
            //marker.setMap(map);
        }
    </script>
    @endif
@endsection
