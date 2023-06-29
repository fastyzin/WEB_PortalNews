import React, { useState, useEffect } from 'react';

function NewsPage() {
  const [news, setNews] = useState([]);

  useEffect(() => {
    fetchNews();
  }, []);

  const fetchNews = async () => {
    try {
      const response = await fetch('http://localhost:5173/site/noticias');
      const data = await response.json();
      setNews(data);
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <div>
      <h2>Notícias</h2>
      {news.map((item, index) => (
        <div key={index}>
          <h3>{item.title}</h3>
          <p>{item.content}</p>
          <hr />
        </div>
      ))}
    </div>
  );
}

export default NewsPage;
