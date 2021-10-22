-- Comments in SQL
-- SELECT all columns from tracks table
SELECT * FROM tracks;
SELECT * FROM artists;

-- SELECT defines which COLUMNS to retreive from DB 
SELECT track_id, name, composer
FROM tracks; 

-- Display tracks that cost more than $0.99. Sort from shortest to longest.
SELECT track_id, name, unit_price, milliseconds 
FROM tracks 
WHERE unit_price > 0.99 
-- By default, order is from lowest to highest (ASC) but can change it 
-- to highest to lowest (DESC)
ORDER BY milliseconds DESC;

-- Display tracks that have a composer
-- Only show track's id, name, composer, and price
SELECT track_id, name, composer, unit_price
FROM tracks
WHERE composer IS NOT NULL;


-- Display tracks that have 'you' or 'day' in their titles
SELECT * 
FROM tracks
-- AND takes precendence over OR 
WHERE (name LIKE '%you%' OR name LIKE '%day%') AND composer LIKE '%u2%';

SELECT * FROM genres;

SELECT * FROM albums;

-- Display all albums and artists corresponding to each album.
-- Only show album title and artist name
SELECT *
FROM albums
JOIN artists
ON albums.artist_id = artists.artist_id;

SELECT * FROM tracks;

-- Display all Jazz tracks
-- Only show track name (as track_name), genre name (as genre_name), 
-- album title (as album_name), and artist name (as artist_name) columns
SELECT tracks.name AS track_name, genres.name AS genre_name, 
albums.title AS album_name, artists.name AS artist_name
FROM tracks
JOIN genres
ON tracks.genre_id = genres.genre_id
-- join again to get album title info
JOIN albums
ON tracks.album_id = albums.album_id
-- join again to get artist name
JOIN artists
ON albums.artist_id = artists.artist_id
WHERE t.genre_id = 2;
