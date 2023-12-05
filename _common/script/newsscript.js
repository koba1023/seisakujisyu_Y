'use strict';

//データ取得
var url = 'https://newsapi.org/v2/everything?' +
    'q=disaster&' +
    'from=2023-12-05&' +
    'sortBy=popularity&' +
    'apiKey=07fded7d38f64bb2b96ad03c65e1404d';

var req = new Request(url);

fetch(req)
    .then(function (response) {
        console.log(response.json());
    })