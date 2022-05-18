-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 18 Bulan Mei 2022 pada 01.28
-- Versi server: 10.3.32-MariaDB-cll-lve
-- Versi PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rahmatwa_vehirent`
--

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`id`, `type_id`, `brand_name`, `brand_slug`, `brand_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Toyota', 'toyota-car', 'brand-logo/toyota-car', '2022-05-14 08:55:47', '2022-05-16 20:20:03'),
(2, 1, 'Daihatsu', 'daihatsu-car', 'brand-logo/daihatsu-car', '2022-05-14 08:55:47', '2022-05-16 20:21:37'),
(3, 1, 'Suzuki', 'suzuki-car', 'brand-logo/suzuki-car', '2022-05-16 06:24:40', '2022-05-16 20:18:23'),
(4, 1, 'Mitsubishi', 'mitsubishi-car', 'brand-logo/mitsubishi-type-car-car', '2022-05-16 16:45:15', '2022-05-16 16:45:42');

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_11_075444_create_types_table', 1),
(6, '2022_03_11_075455_create_brands_table', 1),
(7, '2022_04_01_144002_create_vehicle_specs_table', 1),
(8, '2022_04_01_145638_create_rentals_table', 1),
(9, '2022_04_01_150345_create_payments_table', 1),
(10, '2022_04_16_152413_create_user_verifies_table', 1);

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`id`, `transaction_code`, `id_rental`, `cashier`, `payment_type`, `paid_date`, `payer_name`, `bank`, `payment_proof`, `no_ref`, `paid_total`, `created_at`, `updated_at`) VALUES
(2, 'TRX000000001', 3, 'SOF Rental Mobile Payments', 'Mobile', '2022-05-16 06:51:22', 'anonim', 'SOF Rental Bank', 'payment_proof/member-1-1652683882.jpg', '1652683882', 100000, '2022-05-15 23:51:25', '2022-05-15 23:51:25'),
(3, 'TRX000000002', 4, 'SOF Rental Mobile Payments', 'Mobile', '2022-05-17 05:26:00', 'anonim', 'SOF Rental Bank', 'payment_proof/member-1-1652765160.jpg', '1652765160', 100000, '2022-05-16 22:26:02', '2022-05-16 22:26:02'),
(4, 'TRX000000003', 5, 'SOF Rental Mobile Payments', 'Mobile', '2022-05-17 13:00:41', 'null', 'SOF Rental Bank', 'payment_proof/member-1-1652792441.png', '1652792441', 300000, '2022-05-17 06:00:41', '2022-05-17 06:00:41'),
(5, 'TRX000000004', 6, 'SOF Rental Mobile Payments', 'Mobile', '2022-05-17 13:02:02', 'null', 'SOF Rental Bank', 'payment_proof/member-1-1652792522.png', '1652792522', 4200000, '2022-05-17 06:02:02', '2022-05-17 06:02:02'),
(6, 'TRX000000005', 7, 'SOF Rental Mobile Payments', 'Mobile', '2022-05-17 13:05:12', 'null', 'SOF Rental Bank', 'payment_proof/member-1-1652792712.jpg', '1652792712', 600000, '2022-05-17 06:05:12', '2022-05-17 06:05:12'),
(7, 'TRX000000006', 8, 'SOF Rental Mobile Payments', 'Mobile', '2022-05-17 14:30:35', 'null', 'SOF Rental Bank', 'payment_proof/member-1-1652797835.jpg', '1652797835', 300000, '2022-05-17 07:30:38', '2022-05-17 07:30:38'),
(8, 'TRX000000010', 12, 'SOF Rental Mobile Payments', 'Mobile', '2022-05-17 14:52:09', 'null', 'SOF Rental Bank', 'payment_proof/member-1-1652799129.jpg', '1652799129', 600000, '2022-05-17 07:52:09', '2022-05-17 07:52:09');

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(67, 'App\\Models\\User', 3, 'authToken', '3fed916674599538c931dbe4eed2f4c289ed8e9ef59a1c76ef86eec8e2aac53b', '[\"*\"]', '2022-05-17 03:50:28', '2022-05-16 07:31:54', '2022-05-17 03:50:28'),
(79, 'App\\Models\\User', 8, 'authToken', 'a9918f5d18a111e68818127b05ca06d544519a534eb7b01b5b8c901fcf388d79', '[\"*\"]', NULL, '2022-05-16 08:23:39', '2022-05-16 08:23:39'),
(80, 'App\\Models\\User', 9, 'authToken', '39cf9143de76b5087c51eed82c0ea1c7a7ead7cd24b6981189f108a87fa67686', '[\"*\"]', NULL, '2022-05-16 08:24:01', '2022-05-16 08:24:01'),
(109, 'App\\Models\\User', 2, 'authToken', 'eed513108a9b79c5fdf58efc4a496404550222bb164fb1b210f8266d956494ac', '[\"*\"]', '2022-05-17 09:04:32', '2022-05-17 07:19:16', '2022-05-17 09:04:32');

--
-- Dumping data untuk tabel `rentals`
--

INSERT INTO `rentals` (`id`, `transaction_code`, `user_id`, `id_vehicle`, `start_rent_date`, `end_rent_date`, `vehicle_picked`, `vehicle_returned`, `status`, `reason`, `guarante_rent_1`, `guarante_rent_2`, `guarante_rent_3`, `rent_price`, `created_at`, `updated_at`) VALUES
(3, 'TRX000000001', 2, 3, '2022-05-15 00:00:00', '2022-05-16 00:00:00', NULL, NULL, 'Not Picked', NULL, 'guarante-ktp/KTP-15-05-22-04-01-04-member-1.jpg', NULL, NULL, 100000, '2022-05-15 09:01:04', '2022-05-15 09:01:04'),
(4, 'TRX000000002', 2, 2, '2022-05-16 00:00:00', '2022-05-18 00:00:00', NULL, NULL, 'Not Picked', NULL, 'guarante-ktp/KTP-16-05-22-06-58-59-member-1.jpg', NULL, NULL, 100000, '2022-05-15 23:58:59', '2022-05-15 23:58:59'),
(5, 'TRX000000003', 2, 9, '2022-05-17 10:02:06', '2022-05-18 00:00:00', NULL, NULL, 'Not Picked', NULL, 'guarante-ktp/KTP-17-05-22-03-02-14-member-1.jpg', NULL, NULL, 300000, '2022-05-16 20:02:14', '2022-05-16 20:02:14'),
(6, 'TRX000000004', 2, 3, '2022-05-17 10:10:22', '2022-05-31 00:00:00', NULL, NULL, 'Not Picked', NULL, 'guarante-ktp/KTP-17-05-22-03-10-51-member-1.jpg', NULL, NULL, 4200000, '2022-05-16 20:10:51', '2022-05-16 20:10:51'),
(7, 'TRX000000005', 2, 10, '2022-05-17 10:47:12', '2022-05-19 00:00:00', NULL, NULL, 'Not Picked', NULL, 'guarante-ktp/KTP-17-05-22-03-50-54-member-1.jpg', NULL, NULL, 600000, '2022-05-16 20:50:54', '2022-05-16 20:50:54'),
(8, 'TRX000000006', 2, 8, '2022-05-17 00:00:00', '2022-05-18 00:00:00', NULL, NULL, 'Not Picked', NULL, 'guarante-ktp/KTP-17-05-22-05-09-44-member-1.jpg', NULL, NULL, 300000, '2022-05-16 22:09:44', '2022-05-16 22:09:44'),
(9, 'TRX000000007', 2, 2, '2022-05-16 00:00:00', '2022-05-18 00:00:00', NULL, NULL, 'Not Picked', NULL, 'guarante-ktp/KTP-17-05-22-05-10-25-member-1.jpg', NULL, NULL, 100000, '2022-05-16 22:10:25', '2022-05-16 22:10:25'),
(10, 'TRX000000008', 2, 12, '2022-05-17 00:00:00', '2022-05-18 00:00:00', NULL, NULL, 'Not Picked', NULL, 'guarante-ktp/KTP-17-05-22-08-27-49-member-1.jpg', NULL, NULL, 300000, '2022-05-17 01:27:49', '2022-05-17 01:27:49'),
(11, 'TRX000000009', 2, 5, '2022-05-17 20:07:08', '2022-05-19 00:00:00', NULL, NULL, 'Not Picked', NULL, 'guarante-ktp/KTP-17-05-22-01-07-21-member-1.jpg', NULL, NULL, 400000, '2022-05-17 06:07:23', '2022-05-17 06:07:23'),
(12, 'TRX000000010', 2, 11, '2022-05-18 00:00:00', '2022-05-20 00:00:00', NULL, NULL, 'Not Picked', NULL, 'guarante-ktp/KTP-17-05-22-02-51-24-member-1.jpg', NULL, NULL, 600000, '2022-05-17 07:51:26', '2022-05-17 07:51:26');

--
-- Dumping data untuk tabel `types`
--

INSERT INTO `types` (`id`, `type_name`, `type_slug`, `created_at`, `updated_at`) VALUES
(1, 'Car', 'car', '2022-05-14 08:55:47', '2022-05-14 08:55:47'),
(2, 'Motorcycle', 'motorcycle', '2022-05-14 08:55:47', '2022-05-14 08:55:47'),
(3, 'Bicyle', 'bicyle', '2022-05-14 08:55:47', '2022-05-14 08:55:47');

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `address`, `role`, `avatar`, `email_verified_at`, `kyc`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '081234567890', 'Jl. Mencari Cinta Sejati', 'Admin', 'user-avatar/default.png', '2022-05-14 08:55:47', 'user-kyc/default.png', '$2y$10$jq4Y8f.lzTw/XcfL0DSdSubS1hRpxfr4BWluj.ZdA73crheY73.la', 'hFeizOpgIXgNEcF8QmUQNnsVb9IVpRxlNASjgQXxiCCwkUvlp25KGM0mbpBD', '2022-05-14 08:55:47', '2022-05-14 08:55:47'),
(2, 'Member 1', 'member1@gmail.com', '08123234234', 'Jl. Mencari Cinta Sejati', 'Member', 'user-avatar/default.png', '2022-05-14 08:55:47', 'user-kyc/default.png', '$2y$10$YV.iJwEvNx25oz5bnKwtoO.YYXiw6l8E/c3RAbnt7Vt7eZ1F645te', 'OcFQHkNMqB', '2022-05-14 08:55:47', '2022-05-14 08:55:47'),
(3, 'Member 2', 'member2@gmail.com', '08123435345', 'Jl. Mencari Cinta Sejati', 'Member', 'user-avatar/default.png', '2022-05-14 08:55:47', NULL, '$2y$10$/eIAPWwdwZhRLjjQnhm96uomuXJo5Z9fEAioYhaJfbaY4JzMPfXOu', 'pT8mbxzQXP', '2022-05-14 08:55:47', '2022-05-14 08:55:47'),
(7, 'Scuff', 'martinwicaksono1@gmail.com', '082128371', 'Jambu Timur', 'Member', 'user-avatar/default.png', '2022-05-16 08:34:53', NULL, '$2y$10$0yzTYTOR66h4CD3kXSdYteNi6ky.rKPLSNEl7dBjBYyx9I0Oc08yK', NULL, '2022-05-16 08:19:49', '2022-05-16 08:34:53'),
(8, 'Fendi', 'fendiridho@gmail.com', '0812345632', 'Jl. PLTU Tanjung Jati B', 'Member', 'user-avatar/default.png', '2022-05-16 08:30:22', NULL, '$2y$10$17u2hy784OvUJmafcTucOu3gNVxj5pGScnZyiBo09AXL3R2H7iH0y', NULL, '2022-05-16 08:23:39', '2022-05-16 08:30:22'),
(9, 'User 2', 'rudiybradak@gmail.com', '08123456322', 'Jl. PLTU Tanjung Jati B', 'Member', 'user-avatar/default.png', NULL, NULL, '$2y$10$sdkUgNkwC3L2vvU5nyXGw.0jmj892r7PF7CXeulr3JEInTsAOs5C.', NULL, '2022-05-16 08:24:00', '2022-05-16 08:24:00');

--
-- Dumping data untuk tabel `user_verifies`
--

INSERT INTO `user_verifies` (`id`, `user_id`, `token`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '747214', 'Reset Password Attempt', 'Available', '2022-05-14 09:59:30', '2022-05-14 09:59:30'),
(2, 2, '457559', 'Reset Password Attempt', 'Available', '2022-05-14 10:00:33', '2022-05-14 10:00:33'),
(3, 2, '694891', 'Reset Password Attempt', 'Available', '2022-05-14 10:24:19', '2022-05-14 10:24:19'),
(4, 3, '522655', 'Reset Password Attempt', 'Available', '2022-05-14 10:24:47', '2022-05-14 10:24:47'),
(5, 2, '431976', 'Reset Password Attempt', 'Available', '2022-05-14 18:43:29', '2022-05-14 18:43:29'),
(6, 2, '157183', 'Reset Password Attempt', 'Available', '2022-05-14 20:58:52', '2022-05-14 20:58:52'),
(7, 2, '852946', 'Reset Password Attempt', 'Available', '2022-05-14 21:06:18', '2022-05-14 21:06:18'),
(8, 3, '212755', 'Reset Password Attempt', 'Available', '2022-05-14 21:31:31', '2022-05-14 21:31:31'),
(11, 6, '178c100b2942d98e4e7855443d17a6de59f4c0b2', 'Email Verification', 'Available', '2022-05-16 08:16:41', '2022-05-16 08:16:41'),
(12, 7, '2dc3be58215b2bbb1816129d9c2d6fa8e767aab4', 'Email Verification', 'Expire', '2022-05-16 08:19:49', '2022-05-16 08:34:53'),
(13, 8, '1652715022', 'Mobile Email Verification', 'Expire', '2022-05-16 08:23:39', '2022-05-16 08:30:22'),
(14, 9, '621392', 'Mobile Email Verification', 'Available', '2022-05-16 08:24:01', '2022-05-16 08:24:01'),
(15, 8, '822941', 'Reset Password Attempt', 'Available', '2022-05-16 08:41:02', '2022-05-16 08:41:02'),
(16, 8, '1652716098', 'Reset Password Attempt', 'Expire', '2022-05-16 08:47:03', '2022-05-16 08:48:18'),
(17, 8, '958854', 'Reset Password Attempt', 'Available', '2022-05-16 09:16:02', '2022-05-16 09:16:02'),
(18, 8, '127717', 'Reset Password Attempt', 'Available', '2022-05-16 09:23:56', '2022-05-16 09:23:56'),
(19, 8, '363348', 'Reset Password Attempt', 'Available', '2022-05-16 21:42:43', '2022-05-16 21:42:43'),
(20, 8, '921827', 'Reset Password Attempt', 'Available', '2022-05-16 21:43:01', '2022-05-16 21:43:01'),
(21, 8, '611575', 'Reset Password Attempt', 'Available', '2022-05-16 21:43:05', '2022-05-16 21:43:05');

--
-- Dumping data untuk tabel `vehicle_specs`
--

INSERT INTO `vehicle_specs` (`id`, `id_type`, `id_brand`, `vehicle_name`, `vehicle_slug`, `number_plate`, `vehicle_image`, `vehicle_year`, `vehicle_color`, `vehicle_seats`, `vehicle_status`, `rent_price`, `vehicle_description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Kijang Inova', 'kijang-inova', 'K 6066 KIB', 'vehicle-image/kijang-inovak-6066-kib', 2016, 'Silver', 7, 'Available', 300000, '<div>Kapasitas tempat duduk: 7,<br></div><div>Dimensi: 4.735 mm P x 1.830 mm L x 1.795 mm T</div><div>Kapasitas tangki BBM: 55 l</div><div>Mesin: 2L 4-silinder, 2,4L 4-silinder diesel</div><div>Jenis Transmisi : Otomatis</div>', '2022-05-14 08:55:47', '2022-05-16 16:58:40'),
(2, 1, 1, 'Toyota Alphard', 'toyota-alphard', 'K 8932 OAS', 'vehicle-image/toyota-alphardk-8932-oas', 2017, 'Black', 7, 'Not Available', 700000, '<div>Kapasitas tempat duduk: 7</div><div>Dimensi: 4.945 mm P x 1.850 mm L x 1.895 mm T</div><div>Kapasitas tangki BBM: 75 l</div><div>Mesin: 2,5L 4-silinder, 3,5L V6</div><div>Jenis Transmisi : Otomatis</div>', '2022-05-14 08:55:47', '2022-05-16 22:10:25'),
(3, 1, 2, 'Daihatsu Sigra', 'daihatsu-sigra', 'K 5229 UB', 'vehicle-image/daihatsu-sigrak-5229-ub', 2020, 'White', 7, 'Not Available', 300000, '<div><b>Dimensi: 4.110 mm P x 1.655 mm L x 1.600 mm T</b></div><div><b>Mesin: 1L 3-silinder, 1,2L 4-silinder</b></div><div><b>Jumlah silinder: 3, 4</b></div><div><b>Transmisi: 4-kecepatan otomatis</b></div><div><b>Jenis transmisi : Otomatis</b></div>', '2022-05-14 08:55:47', '2022-05-16 20:10:51'),
(4, 1, 1, 'Toyota HiAce', 'toyota-hiace', 'K 5782 C', 'vehicle-image/toyota-hiacek-5782-c', 2015, 'White', 14, 'Available', 6000000, '<div>Kapasitas Tempat Duduk: 11</div><div>Dimensi:5380 mm P x 1880mm L x 2285 mm</div><div>Kapasitas Tangki Bahan Bakar : 70 L</div><div>Mesin: 2.5L Diesel Engine, In-line 4 Cylinder 16 Valve DOHC</div>', '2022-05-15 05:35:41', '2022-05-16 16:11:40'),
(5, 1, 3, 'Suzuki Mega Carry', 'suzuki-mega-carry', 'B 28938 C', 'vehicle-image/suzuki-mega-carryb-28938-c', 2018, 'Black', 2, 'Not Available', 200000, '<b>Mesin :&nbsp;</b><ul style=\"margin: 20px 0px 0px; -webkit-tap-highlight-color: transparent; list-style: circle; padding: 0px 0px 0px 25px; font-size: 16px; color: rgb(153, 153, 153); font-family: &quot;Source Sans Pro&quot;, sans-serif;\"><li class=\"six columns \" style=\"-webkit-tap-highlight-color: transparent;\">Jenis G15A</li><li class=\"six columns \" style=\"-webkit-tap-highlight-color: transparent;\">Isi Silinder 4, in-line</li><li class=\"six columns \" style=\"-webkit-tap-highlight-color: transparent;\">Jumlah Katup 16</li><li class=\"six columns \" style=\"-webkit-tap-highlight-color: transparent;\">Jumlah Silinder 1493 cc</li><li class=\"six columns \" style=\"-webkit-tap-highlight-color: transparent;\">Diameter x Langkah 75.0 x 84.5 mm</li><li class=\"six columns \" style=\"-webkit-tap-highlight-color: transparent;\">Perbandingan Kompresi 92.4PS/6.000rpm</li><li class=\"six columns \" style=\"-webkit-tap-highlight-color: transparent;\">Daya Maksimum 126Nm/3.000rpm</li><li class=\"six columns \" style=\"-webkit-tap-highlight-color: transparent;\">Momem Puntir Maksimum</li><li class=\"six columns \" style=\"-webkit-tap-highlight-color: transparent;\">Sistem Bahan Bakar</li></ul><p style=\"-webkit-tap-highlight-color: transparent;\"><br></p><p style=\"-webkit-tap-highlight-color: transparent;\"><b>Berat :&nbsp;</b></p><ul style=\"margin: 20px 0px 0px; -webkit-tap-highlight-color: transparent; list-style: circle; padding: 0px 0px 0px 25px; font-size: 16px; color: rgb(153, 153, 153); font-family: &quot;Source Sans Pro&quot;, sans-serif;\"><li style=\"-webkit-tap-highlight-color: transparent;\">Berat Kosong 800 kg</li><li style=\"-webkit-tap-highlight-color: transparent;\">Berat Kotor 1.950 kg</li></ul><p style=\"-webkit-tap-highlight-color: transparent;\"><br></p><p style=\"-webkit-tap-highlight-color: transparent;\"><b>Kapasitas :&nbsp;</b></p><ul style=\"margin: 20px 0px 0px; -webkit-tap-highlight-color: transparent; list-style: circle; padding: 0px 0px 0px 25px; font-size: 16px; color: rgb(153, 153, 153); font-family: &quot;Source Sans Pro&quot;, sans-serif;\"><li style=\"-webkit-tap-highlight-color: transparent;\">Tempat Duduk 2 Orang</li><li style=\"-webkit-tap-highlight-color: transparent;\">Tangki Bahan Bakar 46 Liter</li></ul>', '2022-05-16 06:37:42', '2022-05-17 06:07:23'),
(8, 1, 2, 'Daihatsu Xenia', 'daihatsu-xenia', 'R 9735 GA', 'vehicle-image/daihatsu-xeniar-98735-g', 2017, 'White', 7, 'Not Available', 300000, '<div>Kapasitas tempat duduk: 7</div><div>Dimensi: 4.190-4.395 mm P x 1.660-1.730 mm L x 1.690-1.700 mm T</div><div>Ukuran velg: 14-16\" diameter, 5\" lebar</div><div>Kapasitas tangki BBM: 43 sampai 45 l</div><div>Jenis transmisi : Manual</div>', '2022-05-16 07:36:08', '2022-05-16 22:09:44'),
(9, 1, 3, 'Suzuki Ertiga Maruti', 'suzuki-ertiga-maruti', 'K 2422 NG', 'vehicle-image/suzuki-ertiga-marutik-2422-ng', 2018, 'White', 7, 'Not Available', 300000, '<div><b>Kapasitas tempat duduk: 7</b></div><div><b>Dimensi: 4.395-4.470 mm P x 1.735 mm L x 1.690 mm T</b></div><div><b>Kapasitas tangki BBM: 45 l</b></div><div><b>Daya kuda: 105 HP</b></div><div><b>Jenis Transmisi : Otomatis</b></div>', '2022-05-16 15:53:26', '2022-05-16 20:02:14'),
(10, 1, 2, 'Daihatsu Terios', 'daihatsu-terios', 'K 8765 YT', 'vehicle-image/daihatsu-teriosk-8765-yt', 2018, 'White', 7, 'On Repair', 300000, '<p>Kapasitas tempat duduk: 7</p><p>Dimensi: 4.435 mm P x 1.695 mm L x 1.705 mm T</p><p>Sistem penggerak roda: Penggerak roda belakang</p><p>Kapasitas tangki BBM: 45 L&nbsp;</p><p>Jenis transmisi : Manual</p>', '2022-05-16 16:25:05', '2022-05-16 22:00:37'),
(11, 1, 1, 'Toyota Rush', 'toyota-rush', 'K 0234 HB', 'vehicle-image/toyota-rushk-0234-hb', 2021, 'Silver', 7, 'Not Available', 300000, '<p><br></p><p>Kapasitas tempat duduk : 7</p><p>Dimensi:4.435 mm P x 1.695 mm L x 1.7506 mm T</p><p>Kapasitas tangki BBM: 45 l</p><p>Ukuran velg: 16-17\" diameter, 6,5\" lebar</p><p>Jenis transmisi : Otomatis</p>', '2022-05-16 16:37:17', '2022-05-17 07:51:26'),
(12, 1, 4, 'Mitsubishi Xpander', 'mitsubishi-xpander', 'K 7658 OK', 'vehicle-image/mitsubishi-xpanderk-7658-ok', 2020, 'Silver', 7, 'Not Available', 300000, '<p><span style=\"color: var(--bs-body-color); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Kapasitas tempat duduk : 7</span></p><p><span style=\"color: var(--bs-body-color); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Mesin: 1,5L 4-silinder</span></p><p>Sistem penggerak roda: Penggerak roda depan</p><p>Kapasitas tangki bahan bakar: 45 l</p><p>Dimensi: 4.595 mm P x 1.750 mm L x 1.730 mm T</p><p>Jenis transmisi : Manual</p>', '2022-05-16 16:52:46', '2022-05-17 01:27:49');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
