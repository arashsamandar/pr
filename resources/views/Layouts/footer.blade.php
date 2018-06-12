<div style="clear: both">
    <script type="text/javascript">
        var geocoder;
        var map;
        function initialize() {
            geocoder = new google.maps.Geocoder();
            var defaultMap = new google.maps.LatLng(35.721800, 51.400368);
            var mapOptions = {
                zoom: 16,
                center: defaultMap,
                mapTypeId: google.maps.MapTypeId.TERRAIN        }
            var image = '';
            var marker = new google.maps.Marker({
                position: defaultMap,
                icon: image,
                title:'شرکت رهپاد'
            });
            var mapMarker = '1'
            var infoContent = 'شرکت  رهپاد<br>تلفن تماس: 88618804-021'
            var contentString = '<div id="infowindow" style="font-family: B Yekan;font-size: 14px">کانون تبلیغات و آگهی پیام رهپاد</div>';
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
            if (mapMarker == "1") {
                marker.setMap(map);
            }
            if (infoContent != "") {
                infowindow.open(map,marker);
            }
        }
        function codeAddress() {
            var address = document.getElementById('address').value;
            geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    alert('Location not found: ' + status);
                }
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <div id="map_canvas" class="google_map googlemap" ></div>
</div>














<div style="margin-top: 50px;width: 100%;background-color: #002A3A;text-align: center;color: white;">
    کلیه حقوق مادی و معنوی این سایت متعلق به کانون تبلیغاتی <a style="color: #F26622">پیام رهپاد</a> می باشد
    <br>
    <a href="https://www.facebook.com/PayameRahpad/">
        <img src="{{asset('images/005-facebook.png')}}" style="width: 60px;height: 60px;padding: 10px" />
    </a>
    <a href="http://instagram.com/rahpadads">
        <img src="{{asset('images/002-instagram-1.png')}}" style="width: 60px;height: 60px;padding: 10px" />
    </a>
    <a href="https://t.me/Payam_e_Rahpad">
        <img src="{{asset('images/001-telegram.png')}}" style="width: 60px;height: 60px;padding: 10px" />
    </a>
    <br>
    طراحی و راه اندازی پایگاه اینترنتی <a style="color:#F26622;">گروه رهپاد</a>
</div>
