import React, { useState, useEffect } from "react";

const GenreList = ({ value, onChange }) => {
  const [genres, setGenres] = useState([]);

  const fetchGenres = () => {
    let endpoint = '/api/movies/genres';
    
    return fetch(endpoint)
      .then(response => response.json())
      .then(data => setGenres(data.genres))
      .catch(error => console.error(error))
  }
  useEffect(() => {
    fetchGenres();
  }, []);
  
  return (
    <select value={value} onChange={onChange}>
      <option hidden value="">
        Tutti i generi
      </option>
      {genres.map((genre) => (
        <option key={genre.id} value={genre.id}>
          {genre.value}
        </option>
      ))}
    </select>
  );
};

export default GenreList;