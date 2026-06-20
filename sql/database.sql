-- ============================================
-- BASE DE DONNEES WONDERLY
-- ============================================

CREATE DATABASE IF NOT EXISTS wonderly;
USE wonderly;

-- ============================================
-- TABLE UTILISATEURS
-- ============================================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    role ENUM('user', 'admin') DEFAULT 'user',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================
-- TABLE DESTINATIONS
-- ============================================
CREATE TABLE IF NOT EXISTS destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    badge VARCHAR(50),
    category VARCHAR(50),
    rating DECIMAL(2,1) DEFAULT 4.5,
    reviews INT DEFAULT 0,
    is_popular BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- TABLE CIRCUITS
-- ============================================
CREATE TABLE IF NOT EXISTS circuits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    location VARCHAR(100) NOT NULL,
    duration INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    features TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- TABLE VOLS
-- ============================================
CREATE TABLE IF NOT EXISTS flights (
    id INT AUTO_INCREMENT PRIMARY KEY,
    airline VARCHAR(100) NOT NULL,
    flight_number VARCHAR(20) NOT NULL,
    departure_city VARCHAR(100) NOT NULL,
    departure_code VARCHAR(10) NOT NULL,
    arrival_city VARCHAR(100) NOT NULL,
    arrival_code VARCHAR(10) NOT NULL,
    departure_time DATETIME NOT NULL,
    arrival_time DATETIME NOT NULL,
    duration INT,
    price DECIMAL(10,2) NOT NULL,
    seats_available INT DEFAULT 100,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- TABLE HOTELS
-- ============================================
CREATE TABLE IF NOT EXISTS hotels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    description TEXT,
    stars INT DEFAULT 3,
    price_per_night DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    amenities TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- TABLE RESERVATIONS
-- ============================================
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    booking_type ENUM('circuit', 'flight', 'hotel', 'package') NOT NULL,
    item_id INT NOT NULL,
    booking_reference VARCHAR(20) NOT NULL UNIQUE,
    travel_date DATE NOT NULL,
    return_date DATE,
    adults INT DEFAULT 1,
    children INT DEFAULT 0,
    total_price DECIMAL(12,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    payment_status ENUM('pending', 'paid', 'refunded') DEFAULT 'pending',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================
-- TABLE PAIEMENTS
-- ============================================
CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    payment_method ENUM('card', 'orange_money', 'mtn_money', 'wave', 'bank') NOT NULL,
    transaction_id VARCHAR(100),
    status ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
    payment_date DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
);

-- ============================================
-- TABLE CONTACTS
-- ============================================
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- TABLE NEWSLETTER
-- ============================================
CREATE TABLE IF NOT EXISTS newsletter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- TABLE BLOG
-- ============================================
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    excerpt TEXT,
    category VARCHAR(50),
    image VARCHAR(255),
    author VARCHAR(100),
    views INT DEFAULT 0,
    is_published BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================
-- DONNEES INITIALES
-- ============================================

INSERT INTO users (first_name, last_name, email, password, role) VALUES
('Admin', 'Wonderly', 'admin@wonderly.ci', '.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

INSERT INTO destinations (title, country, city, description, price, image, badge, category, rating, reviews, is_popular) VALUES
('Grand-Bassam', 'Cote d\'Ivoire', 'Grand-Bassam', 'Explorez l\'ancienne capitale coloniale, ses plages et son patrimoine historique.', 150000, 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=500&q=80', 'Populaire', 'ci', 4.8, 234, TRUE),
('Man', 'Cote d\'Ivoire', 'Man', 'Decouvrez les montagnes, les cascades et la culture locale de la region de Man.', 180000, 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=500&q=80', 'Tendance', 'ci', 4.7, 189, TRUE),
('San-Pedro', 'Cote d\'Ivoire', 'San-Pedro', 'Partez a la decouverte des plages paradisiaques de San-Pedro.', 200000, 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&q=80', 'Coup de coeur', 'ci', 4.9, 312, TRUE),
('Dakar', 'Senegal', 'Dakar', 'Decouvrez la capitale senegalaise et son histoire fascinante.', 350000, 'https://images.unsplash.com/photo-1516307365426-bea591f05011?w=500&q=80', 'International', 'afrique', 4.6, 456, TRUE),
('Paris', 'France', 'Paris', 'La Ville Lumiere et ses monuments iconiques.', 850000, 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=500&q=80', 'Europe', 'international', 4.7, 987, TRUE),
('Marrakech', 'Maroc', 'Marrakech', 'Vivez une experience unique entre la medina et le desert.', 450000, 'https://images.unsplash.com/photo-1517823364403-d8b92f5d2dc7?w=500&q=80', 'Afrique', 'afrique', 4.8, 567, TRUE),
('Dubai', 'Emirats Arabes Unis', 'Dubai', 'Luxe moderne et architecture futuriste.', 950000, 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=500&q=80', 'Luxe', 'luxe', 4.6, 876, TRUE),
('Abidjan', 'Cote d\'Ivoire', 'Abidjan', 'La capitale economique ivoirienne, vibrante et moderne.', 120000, 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=500&q=80', 'Tendance', 'ci', 4.5, 423, TRUE);

INSERT INTO circuits (title, description, location, duration, price, image, features) VALUES
('Decouverte du Grand-Bassam', 'Explorez l\'ancienne capitale coloniale, ses plages et son patrimoine historique.', 'Grand-Bassam, Cote d\'Ivoire', 7, 350000, 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=500&q=80', 'Hotel 4*, Demi-pension, Transport inclus'),
('Escapade a Man et ses Montagnes', 'Decouvrez les montagnes, les cascades et la culture locale de la region de Man.', 'Man, Cote d\'Ivoire', 5, 280000, 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=500&q=80', 'Hotel 3*, Demi-pension, Randonnees'),
('Circuit Cote d\'Ivoire Authentique', 'Un voyage complet pour decouvrir toutes les richesses de la Cote d\'Ivoire.', 'Abidjan - Grand-Bassam - Man - San-Pedro', 10, 650000, 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&q=80', 'Hotels 3*/4*, Pension complete, Transport inclus, Guide local'),
('Marrakech et Desert du Maroc', 'Vivez une experience unique entre la medina de Marrakech et le desert.', 'Marrakech, Maroc', 8, 550000, 'https://images.unsplash.com/photo-1517823364403-d8b92f5d2dc7?w=500&q=80', 'Riad 4*, Demi-pension, Excursion desert'),
('Dakar et Ile de Goree', 'Decouvrez la capitale senegalaise et son histoire a travers l\'ile de Goree.', 'Dakar, Senegal', 6, 420000, 'https://images.unsplash.com/photo-1516307365426-bea591f05011?w=500&q=80', 'Hotel 4*, Demi-pension, Traversee en bateau'),
('Paris et Chateaux de la Loire', 'Le reve parisien entre la Ville Lumiere et les chateaux de la Loire.', 'Paris, France', 12, 950000, 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=500&q=80', 'Hotel 4*, Petit-dejeuner, TGV inclus');

INSERT INTO hotels (name, location, description, stars, price_per_night, image, amenities) VALUES
('Hotel Ivoire', 'Abidjan, Cote d\'Ivoire', 'L\'hotel emblematique d\'Abidjan avec vue sur la lagune.', 5, 120000, 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=500&q=80', 'Piscine, Spa, Restaurant, Wifi'),
('Resort de Grand-Bassam', 'Grand-Bassam, Cote d\'Ivoire', 'Un resort de luxe en bord de mer avec piscine et spa.', 4, 85000, 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=500&q=80', 'Piscine, Plage privee, Spa, Restaurant'),
('Palais de Man', 'Man, Cote d\'Ivoire', 'Un hotel de charme au coeur des montagnes de Man.', 5, 95000, 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=500&q=80', 'Vue montagne, Restaurant, Jardin, Wifi'),
('Hotel La Cote', 'San-Pedro, Cote d\'Ivoire', 'Un hotel paisible avec vue sur l\'ocean Atlantique.', 4, 65000, 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=500&q=80', 'Plage, Piscine, Restaurant, Wifi');
