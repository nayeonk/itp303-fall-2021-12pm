-- Add album 'Fight On' by artist 'Spirit of Troy'
SELECT * FROM albums
ORDER BY album_id DESC;

INSERT INTO albums(title, artist_id)
VALUES('Fight On',  276);

-- Look up artist_id for 'spirit of troy'
SELECT * 
FROM artists
WHERE name LIKE '%spirit%';

-- Spirit of Troy does not exist as an artist, need to create one
SELECT * FROM artists;

INSERT INTO artists (name)
VALUES ('Spirit of Troy');

-- Check that Spirit of Troy has been added
SELECT * 
FROM artists
ORDER BY artist_id DESC;

-- Update track 'All My Love' by E. Schrody and L. Dimant to be 
-- part of the 'Fight On' album and composed by Tommy Trojan
UPDATE tracks
SET composer = 'Tommy Trojan', album_id = 348
WHERE track_id = 3316;

-- Let's check out this 'All My Love' track
SELECT * 
FROM tracks
WHERE name LIKE 'all my love';


-- Delete the album 'Fight On'
-- Can't delete a record that is referenced in another table.
-- album id 348 is referenced in the tracks table so it gives an error
DELETE FROM albums
WHERE album_id = 348;
-- Possible solutions
-- 1) Just delete 'All My Love' track that references album 348
-- 2) Null the album_id 348 in 'All My Love'

-- 1st solution:
DELETE FROM tracks
WHERE track_id = 3316;

SELECT * FROM playlist_track
WHERE track_id = 3316;

-- 2nd solution:
UPDATE tracks
SET album_id = null
WHERE track_id = 3316;
-- this is also possible
-- WHERE album_id = 348;


SELECT * FROM albums
WHERE album_id = 348;

-- Create a VIEW that displays all albums and their artist names
-- only show the album id, album title, and artist name
CREATE OR REPLACE VIEW album_artists AS
SELECT albums.album_id, albums.title, artists.name, artists.artist_id
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id;

-- 'Call' the view
SELECT * FROM album_artists;

-- Count all the tracks in the database
SELECT COUNT(*)
FROM tracks;

-- Count by columns
SELECT COUNT(*), COUNT(composer)
FROM tracks;

-- In tracks table, what's the max millisecond (aka which track is the longest?)
-- What's the average length of a song?
SELECT MAX(milliseconds), MIN(milliseconds), AVG(milliseconds)
FROM tracks;

-- How long is an album?
SELECT SUM(milliseconds)
FROM tracks
WHERE album_id = 1;

SELECT * FROM tracks
WHERE album_id = 1;


-- GROUP BY
SELECT * FROM tracks;

-- The shortest track from this entire table
SELECT MIN(milliseconds)
FROM tracks;

-- How about getting the shortest track for EACH album?
-- GROUP by allows us to group tracks by their album_id column
SELECT album_id, MIN(milliseconds)
FROM tracks
GROUP BY album_id;

-- For each arist, show artists and umber of their albums
SELECT * FROM albums;

SELECT artist_id, COUNT(*)
FROM albums
GROUP BY artist_id;

-- If i want to see the actual artist name, we can do a JOIN here
SELECT artists.artist_id, artists.name, COUNT(*)
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id
GROUP BY albums.artist_id;