<?php $this->beginContent('application.views.layouts.main'); ?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <?php if (Yii::app()->user->isGuest) { ?>
                <?php echo CHtml::beginForm($this->createAbsoluteUrl('/Login'), "post", array("class" => "navbar-form navbar-right", "role" => "form", "style" => "display:none;")); ?>
                <div class="form-group">
                    <?php $login = new UserLogin(); ?>
                    <?php echo CHtml::activeTextField($login, 'username', array("placeholder" => Yii::t("user", "Email"), "class" => "form-control")) ?>
                </div>
                <div class="form-group">
                    <?php echo CHtml::activePasswordField($login, 'password', array("placeholder" => Yii::t("user", "Password"), "class" => "form-control")) ?>
                </div>
                <div class="checkbox">
                    <label>
                        <?php echo CHtml::activeCheckBox($login, 'rememberMe'); ?> <?php echo Yii::t("user", "Remember me"); ?>
                    </label>
                </div>
                <?php echo CHtml::submitButton(Yii::t("user", "Login"), array("type" => "submit", "class" => "btn btn-success")); ?>
                <?php
                echo CHtml::endForm();
            } else {
                ?>


            <?php } ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#section-home" class="slow-scrolling">Home</a></li>
                <li><a href="#section-first" class="slow-scrolling">Busca</a></li>
                <li><a href="#section-second" class="slow-scrolling">Cadastre-se</a></li>
                <li><a href="#section-third" class="slow-scrolling">Login</a></li>
                <li><a href="#section-quarto" class="slow-scrolling">Sobre</a></li>
                <li><a href="#section-cinco" class="slow-scrolling">Contato</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php echo $content; ?>
<!-- Google -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL2xkLRGH5KKCHULrY7PEzDhBEsBvkwjE"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/google/google-maps/infobox/infobox.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/google/google-maps/markerclusterer/markerclusterer.min.js"></script>
<script type="text/javascript">
    var map;
    var idInfoBoxAberto;
    var infoBox = [];
    var markers = [];
    var directionsDisplay;
    var directionsDisplay2;
//            var directionsService = new google.maps.DirectionsService();

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        directionsDisplay2 = new google.maps.DirectionsRenderer();
        var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);

        var options = {
            zoom: 5,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("map"), options);
        directionsDisplay.setMap(map);
        directionsDisplay2.setMap(map);
    }

    initialize();

    $("#form-busca").click(function (event) {
        event.preventDefault();

        /// Criar ponto isolado para o passageiro
        var enderecoPartida = $("#origem_endereco").text() + "," + $("#origem_bairro option:selected").text() + "," + $("#origem_cidade option:selected").text() + "," + $("#origem_uf option:selected").text() + ", Brasil";
        console.log(enderecoPartida);




        // Procurar na base de dados todos os destino
        var enderecoChegada = $("#destino_bairro option:selected").text() + "," + $("#destino_cidade option:selected").text() + "," + $("#destino_uf option:selected").text() + ", Brasil";
        console.log(enderecoChegada);


//Barra da Tijuca,Rio de Janeiro,Rio de Janeiro, Brasil
//Centro,Guapimirim,Rio de Janeiro, Brasil

        var request = {// Novo objeto google.maps.DirectionsRequest, contendo:
            origin: enderecoPartida, // origem
            destination: enderecoChegada, // destino
            travelMode: google.maps.TravelMode.DRIVING // meio de transporte, nesse caso, de carro
        };
        var request2 = {
            origin: "Barra da Tijuca,Rio de Janeiro,Rio de Janeiro, Brasil", // origem
            destination: "Centro,Guapimirim,Rio de Janeiro, Brasil", // destino
            travelMode: google.maps.TravelMode.DRIVING
        };

        var directionsService = new google.maps.DirectionsService();
        var directionsService2 = new google.maps.DirectionsService();

        directionsService.route(request, function (result, status) {
            if (status == google.maps.DirectionsStatus.OK) { // Se deu tudo certo
                directionsDisplay.setDirections(result); // Renderizamos no mapa o resultado
            }
        });

        directionsService2.route(request2, function (result2, status2) {
            if (status2 == google.maps.DirectionsStatus.OK) { // Se deu tudo certo
                directionsDisplay2.setDirections(result2); // Renderizamos no mapa o resultado
            }
        });
    });


    function abrirInfoBox(id, marker) {
        if (typeof (idInfoBoxAberto) == 'number' && typeof (infoBox[idInfoBoxAberto]) == 'object') {
            infoBox[idInfoBoxAberto].close();
        }

        infoBox[id].open(map, marker);
        idInfoBoxAberto = id;
    }

    function carregarPontos() {

        $.getJSON('<?php echo($this->createAbsoluteUrl('/Site/LatLon')); ?>', function (pontos) {

            var latlngbounds = new google.maps.LatLngBounds();

            $.each(pontos, function (index, ponto) {

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(ponto.Latitude, ponto.Longitude),
                    title: "Meu ponto personalizado! :-D",
                    icon: '<?php echo Yii::app()->request->baseUrl; ?>/plugins/google/google-maps/img/marcador.png'
                });

                var myOptions = {
                    content: "<p>" + ponto.Descricao + "</p>",
                    pixelOffset: new google.maps.Size(-150, 0),
                    infoBoxClearance: new google.maps.Size(1, 1)
                };

                infoBox[ponto.Id] = new InfoBox(myOptions);
                infoBox[ponto.Id].marker = marker;

                infoBox[ponto.Id].listener = google.maps.event.addListener(marker, 'click', function (e) {
                    abrirInfoBox(ponto.Id, marker);
                });

                markers.push(marker);

                latlngbounds.extend(marker.position);

            });

            var markerCluster = new MarkerClusterer(map, markers);

            map.fitBounds(latlngbounds);

        });

    }

    carregarPontos();

</script>
<?php $this->endContent(); ?>