    var map = L.map('test_map').setView([53.33657, 83.77976], 15);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYWxpbW9lZG0iLCJhIjoiY2l0Zm02b2JtMDA4ZDNvbWphNnQ4eXhyNSJ9.7BlhDTdKHCvXVVreG4OiuQ', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
        id: 'mapbox.streets'
    }).addTo(map);
    var LeafIcon = L.Icon.extend({
        options: {
            shadowUrl: '',
            iconSize:     [40, 40],
//                shadowSize:   [50, 64],
            iconAnchor:   [22, 94],
            shadowAnchor: [4, 62],
            popupAnchor:  [-3, -76]
        }
    });

    var busIcon = new LeafIcon({iconUrl: busIconPath}),
        marshIcon = new LeafIcon({iconUrl: marshIconPath}),
        tramIcon = new LeafIcon({iconUrl: tramIconPath});
        trollIcon = new LeafIcon({iconUrl: trollIconPath});
    //L.marker([53.33667, 83.77976], {icon: greenIcon}).addTo(map).bindPopup("I am a green leaf.");
    //L.marker([53.33687, 83.77976], {icon: redIcon}).addTo(map).bindPopup("I am a red leaf.");
    //L.marker([53.33647, 83.77976], {icon: orangeIcon}).addTo(map).bindPopup("I am an orange leaf.");

//
//        L.marker([51.5, -0.09]).addTo(mymap)
//                .bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();
//
//        L.circle([51.508, -0.11], 500, {
//            color: 'red',
//            fillColor: '#f03',
//            fillOpacity: 0.5
//        }).addTo(mymap).bindPopup("I am a circle.");
//
//        L.polygon([
//            [51.509, -0.08],
//            [51.503, -0.06],
//            [51.51, -0.047]
//        ]).addTo(mymap).bindPopup("I am a polygon.");

    //var circle = L.circle([53.33657, 83.77976], 20).addTo(map);
    //
    //
    //var popup = L.popup();

    function onMapClick(e) {
        //popup
        //    .setLatLng(e.latlng)
        //    .setContent("You clicked the map at " + e.latlng.toString())
        //    .openOn(mymap);
    }

    map.on('click', onMapClick);

    function Traffic() {
        this.routes = {};
        this.zones = {};
        this.stations = {};
        this.numVehicles = [];
    }

    Traffic.prototype.start = function () {
        var routes = JSON.parse($('[name="routes_list"]').val());
        var routes_helper = [];
        for (var i = 0, n = routes.length; i < n; i++) {
            if (!this.routes[routes[i]['type'] +'_'+ routes[i]['num']]) {
                this.routes[routes[i]['type'] +'_'+ routes[i]['num']] = {};
            }
            this.routes[routes[i]['type'] +'_'+ routes[i]['num']][routes[i]['distId']] = new Route(routes[i]);


            if (!this.numVehicles[routes[i]['type']]) {
                this.numVehicles[routes[i]['type']] = [];
            }
            if (!routes_helper[routes[i]['type'] +'_'+ routes[i]['num']]) {
                this.numVehicles[routes[i]['type']].push(routes[i]['num']);
                routes_helper[routes[i]['type'] +'_'+ routes[i]['num']] = 1;
            }

        }

        for (var key in this.numVehicles) {
            this.numVehicles[key].sort(function (a, b) {
                a = parseInt(a);
                b = parseInt(b);
                if (a > b) return 1;
                if (a < b) return -1;
            });
        }

        var stations = JSON.parse($('[name="stations_list"]').val());
        for (var i = 0, n = stations.length; i < n; i++) {
            this.stations[stations[i]['distId']] = new Station(stations[i]);
        }

        var zones = JSON.parse($('[name="zones_list"]').val());
        for (var i = 0, n = zones.length; i < n; i++) {
            this.zones[zones[i]['distId']] = new Zone(zones[i]);
        }
        return this;
    };

    Traffic.prototype.drawRoutes = function () {
        for (r in this.numVehicles) {
            if (this.numVehicles.hasOwnProperty(r)) {
                for (var i = 0; i < this.numVehicles[r].length; i++) {
                    $('[data-type="route_'+r+'"]').append(this.getTemplate({
                        num: this.numVehicles[r][i],
                        name: r + '_' + this.numVehicles[r][i]
                    }));
                }
            }
        }
        return this;
    };

    Traffic.prototype.getTemplate = function (ob) {
        var tpl = $('[type="text/route_template"]').html();
        tpl = tpl.replace(/{=value=}/, ob.num);
        tpl = tpl.replace(/{=title=}/, ob.num);
        tpl = tpl.replace(/{=name=}/, ob.name);

        return tpl;
    };

    Traffic.prototype.showTransport = function () {
        var routes = [];
        for (var k in this.routes) {
            for (var k2 in this.routes[k]) {
                if (this.routes[k][k2].checked) {
                    routes.push(this.routes[k][k2]['distId'] +'-0');
                }
            }
        }
        if (!routes.length) {
            return;
        }
        this.getTransportCoordinates(routes);
    };

    Traffic.prototype.getTransportCoordinates = function (routes) {
        $.ajax({
            type: 'get',
            url: 'http://traffic22.ru/php/getVehiclesMarkers.php',
            headers: {Host: 'traffic22.ru', Referer: 'http://traffic22.ru/', origin: 'http://traffic22.ru/'},
            data: {
                rids:routes.join(','),
                lat0: 0,
                lng0: 0,
                lat1: 90,
                lng1: 180,
                curk: 0,
                city: 'barnaul',
                info: 12345,
                _: 1474871160247
            },
            dataType : 'json',   //you may use jsonp for cross origin request
            crossDomain:true,
            success: function(data) {
                console.log(data);
            }
        });
    };

    setInterval(function () {
        traffic.showTransport();
    }, 2000);
    function Base(settings) {
    }
    Base.prototype.loadData = function (settings) {
        for (_set in settings) {
            this[_set] = settings[_set];
        }
    };

    function Route(settings) {
        Base.prototype.loadData.apply(this, arguments);

        this.checked = false;
    }
    Route.prototype = Object.create(Base.prototype);
    Route.prototype.constructor = Route;

    Route.prototype.setChecked = function (checked) {
        this.checked = checked;
    };

    function Station(settings) {
        this.loadData(settings);
    }
    Station.prototype = Object.create(Base.prototype);

    function Zone(settings) {
        this.loadData(settings);
    }
    Zone.prototype = Object.create(Base.prototype);


    var traffic = new Traffic();
    traffic.start().drawRoutes();

    $(document).on('change', '[data-role="routes_list"] [type="checkbox"]', function(event) {
        var $_element = $(event.target);
        var name = $_element.attr('name');
        var related_routes = traffic.routes[name];
        for (var k in related_routes) {
            if (related_routes.hasOwnProperty(k)) {
                related_routes[k].setChecked($_element.prop('checked'));
            }
        }
    });
