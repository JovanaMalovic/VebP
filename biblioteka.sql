-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2018 at 03:30 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteka`
--

-- --------------------------------------------------------

--
-- Table structure for table `knjiga`
--

CREATE TABLE `knjiga` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ocena` int(11) NOT NULL DEFAULT '0',
  `slika` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `izdavac` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_korisnik` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `knjiga`
--

INSERT INTO `knjiga` (`id`, `naziv`, `ocena`, `slika`, `opis`, `autor`, `izdavac`, `id_korisnik`) VALUES
(3, 'SjeÄ‡anja', 5, 'knjiga4.jpg', 'Knjiga koja se jako teÅ¡ko nalazi. SjeÄ‡anja predstavljaju autobiografiju MeÅ¡e SelimoviÄ‡a, jednog od mojih omiljenih pisaca. Toplo vam je preporuÄujem. :)', 'MeÅ¡a SelimoviÄ‡', '', 'Andromeda'),
(6, 'Knjiga o groblju', 4, 'knjiga5.jpg', 'Najbolje delo Nila Gejmena. Maestralna!', 'Nil Gejmen', 'Laguna', 'Andromeda'),
(7, 'Na putu', 4, 'naputu.jpg', 'Ekstra knjiga.', 'DÅ¾ek Keruak', 'Laguna', 'Andromeda'),
(8, 'ÄŒovek po imenu Uve', 5, 'covek_po_imenu_uve_v.jpg', 'BuduÄ‡i klasik!', 'Frederik Bakman', 'Laguna', 'Andromeda'),
(9, 'Planeta mrtvih', 5, '36762011_10214588131570882_5069037681116184576_n.jpg', 'TreÄ‡i broj edicije Planeta mrtvih.', 'Ticiano Sklavi', 'Veseli Äetvrtak', 'DilanDog'),
(11, 'OÅ¡trica', 5, 'ostrica-dzo_aberkrombi_v.jpg', 'Mnogo akcije i crnog humora â€“ knjiga koja se zaista Äita u jednom dahu.', 'DÅ¾o Aberkrombi', 'Laguna', 'DilanDog'),
(12, 'MistiÄni kabare', 4, 'MK_korice_p.jpg', 'â€™Svi smo robovi naÅ¡eg lika kog je na prvom mestu stvorila porodica, na drugom druÅ¡tvo i na treÄ‡em kultura. Put transformacije znaÄi oslobaÄ‘anje od ropstva. Iza mojih hiljadu maski, nalazi se autentiÄni ja.â€™\r\n\r\nAlehandro Hodorovski', 'Alehandro Hodorovski', 'Arete', 'DilanDog'),
(13, 'Lovac u Å¾itu', 5, 'lovac_u_zitu_vv.jpg', 'â€žLovac u Å¾ituâ€œ je zaista najÄitaniji roman na planeti. SelindÅ¾eru je trebalo gotovo deset godina da napiÅ¡e ovo delo.', 'DÅ¾. D. SelindÅ¾er', 'Lom', 'DilanDog'),
(14, 'Ja sam Akiko', 5, 'ja_sam_akiko-stefan_mitic_v.jpg', '\"Ljubav je beskrajna potraga za toplinom.\" Autor', 'Stefan TiÄ‡mi', 'Laguna', 'Andromeda'),
(15, 'Programiranje u Pythonu', 5, 'knjiga2.jpg', 'Najbolji vodiÄ za programiranje na programskom jeziku Python namenjen poÄetnicima! ', 'Rouzi Dikens', 'Kreativni centar', 'Andromeda'),
(16, 'Majstor i Margarita', 5, 'majstor_i_margarita_vv.jpg', 'Da li nam Ä‘avo donosi zlo ili je zlo u nama?', 'Mihail Bulgakov', 'Vulkan', 'Andromeda'),
(17, 'MeseÄevi vrtovi', 4, 'vrtovi.jpg', 'Roman epske fantastike. Prvi roman u serijalu MalaÅ¡ka knjiga palih.', 'Stiven Erikson', 'Laguna', 'avram'),
(19, 'Programiranje u Scratchu', 5, 'knjiga1.jpg', 'Najbolji vodiÄ za programiranje na programskom jeziku Scratch namenjen apsolutnim poÄetnicima! ', 'Rouzi Dikens', 'Kreativni centar', 'Andromeda'),
(20, 'PriÄa o galebu i maÄku koji ga je nauÄio da leti', 5, '242519.jpg', 'Sjajna knjiga namenjena deci a jako pouÄna i za odrasle. PriÄa o prijateljstvu.', 'Luis Sepulveda', 'Paideia', 'Andromeda'),
(21, 'ZloÄin i kazna', 5, 'zlocin_i_kazna_vv.jpg', 'Jedan od najveÄ‡ih romana ruske knjiÅ¾evnosti. Roman sa elementima kriminalnog, socijalnog, psiholoÅ¡kog i filozofskog romana. ', 'Dostojevski', 'Nova knjiga', 'Andromeda'),
(22, 'BraÄ‡a Karamazovi', 5, 'IMG_00026.jpg', 'BraÄ‡a Karamazovi je poslednje delo Dostojevskog, filozofski roman koji istraÅ¾uje hriÅ¡Ä‡ansku etiku, slobodu volje, otuÄ‘enost, suparniÅ¡tvo i moral.', 'Dostojevski', '', 'Andromeda');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id_knjiga` int(11) NOT NULL,
  `id_korisnik` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `komentar` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `vreme` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id_knjiga`, `id_korisnik`, `komentar`, `vreme`) VALUES
(3, 'avram', 'Prelepa knjiga. Sve preporuke!', '2018-07-07 23:48:05'),
(6, 'avram', 'Procitao sam je u jednom dahu. Buduci klasik!', '2018-07-07 23:28:47'),
(8, 'DilanDog', 'Jako mi se dopala. Topla preporuka! :)', '2018-07-07 02:13:33'),
(9, 'Andromeda', 'Ono Å¡to vas prvo privuce su korice a zatim i tematika. Topla preporuka svim ljubiteljima stripa.', '2018-07-08 03:01:56'),
(11, 'avram', 'Maestralno delo!', '2018-07-07 23:32:17'),
(12, 'Andromeda', 'Meni se knjiga baÅ¡ dopala jer je puna nekih kraÄ‡ih priÄa i iskustva samog autora.', '2018-07-07 11:28:14'),
(13, 'Andromeda', 'Genijalna knjiga!', '2018-07-08 03:26:37'),
(14, 'DilanDog', 'Divna knjiga!', '2018-07-07 10:43:44'),
(15, 'Andromeda', 'MoÅ¾e posluÅ¾iti i deci i nastavnicima i svima onima koji bi kroz igru da se upoznaju sa programskim jezikom Python.', '2018-07-08 02:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`username`, `mail`, `password`) VALUES
('Andromeda', 'jmalovic92@gmail.com', '12345678'),
('avram', 'avram@yahoo.com', '123gg123'),
('DilanDog', 'dilan.dog@gmail.com', '987654'),
('Mali Princ', 'mali.princ@gmail.com', '24680');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `knjiga`
--
ALTER TABLE `knjiga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_korisnik` (`id_korisnik`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id_knjiga`,`id_korisnik`,`vreme`),
  ADD KEY `komentari_ibfk_2` (`id_korisnik`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `knjiga`
--
ALTER TABLE `knjiga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `knjiga`
--
ALTER TABLE `knjiga`
  ADD CONSTRAINT `knjiga_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`id_knjiga`) REFERENCES `knjiga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentari_ibfk_2` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`username`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
