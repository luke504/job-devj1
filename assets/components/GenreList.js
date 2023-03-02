import React from 'react';

const GenreList = ({ value, onChange }) => {
  return (
    <select value={value} onChange={onChange}>
      <option hidden value="">Tutti i generi</option>
      <option value="Action">Azione</option>
      <option value="Adventure">Avventura</option>
      <option value="Animation">Animazione</option>
      <option value="Comedy">Commedia</option>
      <option value="Crime">Crimine</option>
      <option value="Drama">Dramma</option>
      <option value="Family">Famiglia</option>
      <option value="Fantasy">Fantasia</option>
      <option value="History">Storia</option>
      <option value="Horror">Orrore</option>
      <option value="Music">Musica</option>
      <option value="Mystery">Mistero</option>
      <option value="Romance">Romantico</option>
      <option value="Sci-Fi">Fantascienza</option>
      <option value="Sport">Sport</option>
      <option value="Thriller">Romanzo giallo</option>
      <option value="War">Guerra</option>
    </select>
  );
};

export default GenreList;

