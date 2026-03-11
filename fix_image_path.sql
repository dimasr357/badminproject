-- Fix image path di database
-- Hapus slash di depan path gambar

UPDATE lapangans 
SET image = REPLACE(image, '/images/', 'images/')
WHERE image LIKE '/images/%';

-- Cek hasil
SELECT id, nama_lapangan, image FROM lapangans;
