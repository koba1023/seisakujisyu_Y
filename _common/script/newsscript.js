'use strict';

//データ取得
const apiKey = '07fded7d38f64bb2b96ad03c65e1404d';
const apiUrl = 'https://newsapi.org/v2/everything';


const country = 'jp'; // 取得したい国のコード（日本の場合は'jp'）
const query = '災害';
const pageSize = 10;
const requestUrl = `${apiUrl}?q=${query}&pageSize=${pageSize}&apiKey=${apiKey}`;

// ニュースを取得する関数
async function fetchDisasterNews() {
    try {
        const response = await fetch(requestUrl);
        const data = await response.json();


        console.log(data.articles);
    } catch (error) {
        console.error('エラーが発生しました:', error);
    }
}

// 災害関連のニュースを取得する関数を実行
fetchDisasterNews();