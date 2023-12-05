'use strict';

async function fetchDisasterNews() {
    const apiKey = '07fded7d38f64bb2b96ad03c65e1404d';
    const apiUrl = 'https://newsapi.org/v2/everything';

    const country = 'jp';
    const query = '災害';
    const pageSize = 5;
    const requestUrl = `${apiUrl}?q=${query}&pageSize=${pageSize}&apiKey=${apiKey}`;

    try {
        const response = await fetch(requestUrl);
        const data = await response.json();

        const newsListDiv = document.getElementById('newsList');

        data.articles.forEach(article => {
            const newsItem = document.createElement('div');
            newsItem.classList.add('news-item');
            newsItem.innerHTML = `
                <h2>${article.title}</h2>
                <p>${article.description}</p>
                <a href="${article.url}" target="_blank">詳細を読む</a>
                <hr>
            `;
            newsListDiv.appendChild(newsItem);
        });
    } catch (error) {
        console.error('エラーが発生しました:', error);
    }
}

window.onload = function () {
    fetchDisasterNews();
};
