-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 11 Eyl 2018, 14:26:33
-- Sunucu sürümü: 10.2.17-MariaDB
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `enes_grup`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gruplar`
--

CREATE TABLE `gruplar` (
  `id` int(11) NOT NULL,
  `isim` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `uyesayisi` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `sahibi` int(11) NOT NULL,
  `aciklama` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `onay` int(11) NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `grupdili` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `idsi` int(11) NOT NULL,
  `kategoriadi` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `seokategori` varchar(255) NOT NULL,
  `kategoriar` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `kategoriaz` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `kategoricn` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `kategoride` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `kategorien` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `kategories` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `kategorifr` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `kategoript` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `kategoriru` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `kategoritr` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`idsi`, `kategoriadi`, `seokategori`, `kategoriar`, `kategoriaz`, `kategoricn`, `kategoride`, `kategorien`, `kategories`, `kategorifr`, `kategoript`, `kategoriru`, `kategoritr`) VALUES
(1, 'Arkadaşlık', 'arkadaslik', 'صداقة', 'Dostluq', '友谊', 'Freundschaft', 'Friendship', 'Amistad', 'Amitié', 'Amizade', 'дружба', 'Arkadaşlık'),
(2, 'Yazılım', 'yazilim', 'البرمجيات', 'Proqram', '软件', 'Software', 'Software', 'Software', 'Logiciel', 'Software', 'программное обеспечение', 'Yazılım'),
(3, 'Adult', 'adult', 'بالغ', 'Adult', '成人', 'Erwachsene', 'Adult', 'Adulto', 'Adulte', 'Adulto', 'для взрослых', 'Adult'),
(4, 'Sınav', 'sinav', 'امتحان', 'İmtahan', '考试', 'Prüfung', 'Exam', 'Examen', 'Exam', 'Exame', 'экзамен', 'Sınav'),
(5, 'Yardım', 'yardim', 'مساعدة', 'Kömək', '帮助', 'Hilfe', 'Help', 'Ayudar', 'Aider', 'Ajudar', 'помощь', 'Yardım'),
(6, 'Webmaster', 'webmaster', 'المسؤول عن الموقع', 'Webmaster', '网站管理员', 'Webmaster', 'Webmaster', 'Webmaster', 'Webmestre', 'Webmaster', 'Веб-мастер', 'Webmaster'),
(7, 'Genel', 'genel', 'عام', 'Ümumi', '一般', 'General', 'General', 'General', 'Général', 'Geral', 'общий', 'Genel'),
(8, 'Etkinlik', 'etkinlik', 'نشاط', 'Fəaliyyət', '活动', 'Aktivität', 'Activity', 'Actividad', 'Activité', 'Atividade', 'деятельность', 'Etkinlik'),
(9, 'Sohbet', 'sohbet', 'ثرثرة', 'Söhbət', '聊', 'Unterhaltung', 'Chat', 'Charlar', 'Bavarder', 'Bate-papo', 'чат', 'Sohbet'),
(10, 'Oyun', 'oyun', 'لعبة', 'Oyun', '游戏', 'Spiel', 'Game', 'Juego', 'Jeu', 'Jogo', 'игра', 'Oyun');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reklamlar`
--

CREATE TABLE `reklamlar` (
  `id` int(11) NOT NULL,
  `anasayfaust` longtext NOT NULL,
  `anasayfaalt` longtext NOT NULL,
  `gruplar` longtext NOT NULL,
  `panel` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `reklamlar`
--

INSERT INTO `reklamlar` (`id`, `anasayfaust`, `anasayfaalt`, `gruplar`, `panel`) VALUES
(1, 'Ana sayfa 1', 'Sag Menü', 'Grup Listesi', 'Üye Paneli');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `twitter` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `instagram` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `site`
--

INSERT INTO `site` (`id`, `baslik`, `logo`, `facebook`, `twitter`, `instagram`) VALUES
(1, 'Whatsapp Grupları', 'whatsapp-gruplari.png', 'facebook', 'twitter', 'instagram');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(11) NOT NULL,
  `kullaniciadi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sifre` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ad` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `soyad` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `yetki` int(11) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `kullaniciadi`, `sifre`, `ad`, `soyad`, `email`, `yetki`, `token`) VALUES
(6, 'demoadmin', '8f98e228cc26b1b1ad97bc5014156053', 'Enes Alperen', 'Hürüm', 'eahurum@gmail.com', 1, 'QHKtAZzrxX07lfVygzxnwiZ8aRKVB4ePBo9ABwrwJhrsAAeeySGk0dgOtrkujE9jr6jqtOd0tIjuJDM7TSfHwCWfr4NO8MxnHUU0ivqS3NAAPM5ifbqPbAuG47U0HGeOawC9hrPY4PXHbSq4rUJGU1MMwfC4leG9QJ6v0LIsYf00vesbw0hGrsQeNQWwvcv9jsvX13GQW4EHWwiImEMSwcu7sGrbgcbGIKdABhQVZScvE91pDD5xfpuMvZlP1AV');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `gruplar`
--
ALTER TABLE `gruplar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`idsi`);

--
-- Tablo için indeksler `reklamlar`
--
ALTER TABLE `reklamlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `gruplar`
--
ALTER TABLE `gruplar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `idsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `reklamlar`
--
ALTER TABLE `reklamlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
