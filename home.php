<?php
session_start();
include 'functions.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pre-Rental</title>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <!-- Bootstrap読み込み（スタイリングのため） -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>

<body class="mx-auto">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top">
        <div class="container">
            <img src="./img/icon.png" width="40">
            <a class="navbar-brand ml-3" href="#">Pre-Rental</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active border mr-5">
                        <a class="nav-link" href="logout.php">ログアウト</a>
                    </li>
            </div>
        </div>
    </nav>

    <!-- Page Content -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="mt-3 text-primary"><strong>ようこそ！</strong></h2>
                <p class="mt-3">あなたが提供する宿泊施設を最適化します<br></p>
                <h3 class="mt-5 mb-5 text-primary">chart jsの練習</h3>
                <p>Data Baseに格納されている値を描画</p>
            </div>
        </div>
    </div>

    <!-- グラフの練習 -->
    <!-- ここにグラフ表示 -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <canvas id="myChart1"></canvas>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <canvas id="myChart3"></canvas>
            </div>
            <div class="col-lg-6">
                <canvas id="myChart4"></canvas>
            </div>
        </div>
    </div>
    </div>
    <!-- <script type="text/javascript" src="vendor/Chart.js"></script>
    <script type="text/javascript" src="vendor/moment.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script type="text/javascript" src="vendor/chartjs-plugin-streaming.js"></script>

    <script>
        let a = 0;

        // function get_data() {
        //     $.ajax({
        //             url: "get_data.php",
        //             method: "POST",
        //         })
        //         .done(function(data) {
        //             a = data;
        //             console.log(data);
        //             $('#len').html(data);
        //         });
        //     return a;
        // }
        // DBからデータを取得する関数


        function get_data(num) {
            switch (num) {
                case 2:
                    const url2 = 'get_Age.php';
                    var result = 0;
                    $.getJSON({
                            url: url2,
                            metod: 'POST',
                            async: false
                        })
                        .done(function(data, textStatus, jqXHR) {
                            // console.log(data);
                            result = data;

                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            console.log('error');
                        })
                        .always(function() {});
                    return result;
                    break;
                case 3:
                    const url3 = 'get_Survived.php';
                    var result = 0;
                    $.getJSON({
                            url: url3,
                            metod: 'POST',
                            async: false
                        })
                        .done(function(data, textStatus, jqXHR) {
                            // console.log(data);
                            result = data;

                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            console.log('error');
                        })
                        .always(function() {});
                    return result;
                    break;
                case 4:
                    const url4 = 'get_Sex.php';
                    var result = 0;
                    $.getJSON({
                            url: url4,
                            metod: 'POST',
                            async: false
                        })
                        .done(function(data, textStatus, jqXHR) {
                            console.log(data);
                            result = data;

                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            console.log('error');
                        })
                        .always(function() {});
                    return result;
                    break;
            }

        }

        var ctx1 = document.getElementById('myChart1').getContext('2d');
        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var ctx3 = document.getElementById('myChart3').getContext('2d');
        var ctx4 = document.getElementById('myChart4').getContext('2d');

        var chart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                datasets: [{
                    data: []
                }]
            },
            options: {
                title: {
                    display: true,
                    text: '各時刻にランダム値を描画'
                },
                scales: {
                    xAxes: [{
                        type: 'realtime'
                    }]
                },
                plugins: {
                    streaming: {
                        duration: 20000,
                        refresh: 1000,
                        delay: 1000,
                        frameRate: 30,
                        pause: false,


                        onRefresh: function(chart) {
                            chart.data.datasets[0].data.push({
                                x: Date.now(),
                                y: Math.random() * 100
                            });
                        }
                    }
                }
            }
        });

        var data2 = get_data(2);
        // console.log(data2[1].Age);
        var data2_label = [];
        var data2_data = [];
        for (let i = 1; i < 65; i++) {
            data2_label.push(data2[i].Age);
            data2_data.push(data2[i].AgeCount);
        }
        // console.log(data2_label);
        var chart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: data2_label,
                datasets: [{
                    label: '人数',
                    data: data2_data,
                    backgroundColor: 'rgb(0, 255, 0)'
                }],
            },
            options: {
                title: {
                    display: true,
                    text: 'タイタニック号乗客の年齢の分布'
                },
                scales: {
                    xAxes: [{
                        // type: 'realtime'
                    }]
                }
            }
        });
        var data3 = get_data(3);
        // console.log(data3);
        var data3_data = [];
        for (let i = 0; i < 2; i++) {
            data3_data.push(data3[i].SurvivedCount);
        }
        var chart3 = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: ['死亡', '生存'],
                datasets: [{
                    label: '人数',
                    data: data3_data,
                    backgroundColor: [
                        "#BB5179",
                        "#FAFF67",
                    ],
                }],
            },
            options: {
                title: {
                    display: true,
                    text: 'タイタニック号乗客の生存者数と死亡者数'
                }
            }
        });

        var data4 = get_data(4);
        // console.log(data3);
        var data4_data = [];
        for (let i = 0; i < 2; i++) {
            data4_data.push(data4[i].SexCount);
        }
        var chart4 = new Chart(ctx4, {
            type: 'pie',
            data: {
                labels: ['女', '男'],
                datasets: [{
                    label: '人数',
                    data: data4_data,
                    backgroundColor: [
                        "#f7394f",
                        "#2e56db",
                    ],
                }],
            },
            options: {
                title: {
                    display: true,
                    text: 'タイタニック号乗客の男女比'
                }
            }
        });
    </script>

    <footer class="container-fluid" style="text-align:center;padding:10px;background: #101010;">
        <small><a href="/">Copyright (C) 2019 Pre-Rental All Rights Reserved.</a></small>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.slim.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>