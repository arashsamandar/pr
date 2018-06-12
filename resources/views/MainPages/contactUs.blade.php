@extends('Layouts.UpdeRegis')
<style>
    .cgooglemap {
        float: left;width: 80%;height: 500px;margin-bottom: 20px;border: 1px solid black;
    }
    .csidebar {
        width: 20%;float: right
    }

    @media only screen and (max-width: 990px) {
        .cgooglemap {
            width: 100%;height: 500px;margin-bottom: 20px;border: 1px solid black;
        }
        .csidebar {
            width: 100%;
        }
    }
</style>
<script
        src="http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&amp;language=fa-IR&key=AIzaSyBPE7WWdaSiKs5_qtd4U7agoJ1jmCJ6XbE">
</script>
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

@section('URS')

    <div style="width: 100%;height: auto;margin: 50px auto;direction: rtl">
        <h2
                style="margin-left:100px;margin-right:50px;padding:10px;border:#eee solid 1px;border-radius: 5px;">
            تماس با کانون تبلیغاتی پیام رهپاد
        </h2>

        <div style=" margin-left:100px;margin-right:50px;margin-bottom:30px;padding:10px;border-radius: 5px;text-align: right">
            <div class="csidebar">

                <p><strong>
                         تلفن : </strong><br/></p>
                <p>

                    <label class="text">9821 88618804+</label><br/>
                    <label class="text">9821 88621886+</label><br/>
                    <label class="text">9821 88221659+</label><br/>
                </p>

                <p><strong>
                         فكس : </strong><br/>
                    9821 89772126+<br/>
                </p>

                <p><strong>
                         کانال تلگرام : </strong><br/>
                    <a href="https://t.me/Payam_e_Rahpad" title="telegramchannel">Telegram.me/Payam_e_Rahpad</a><br/>
                </p>

                <p><strong>
                         پست الکترونیک :</strong><br/>
                    info@payamerahpad.com<br/>
                </p>
                <p><strong>
                         آدرس : </strong><br/>
                    تهران – صندوق پستی 1579-14155<br/>
                </p>



            </div>








            <div id="map_canvas" class="cgooglemap">
            </div>
        </div>
    </div>
@endsection