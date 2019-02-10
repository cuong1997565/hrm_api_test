<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `cities` (`id`, `zipcode`, `name`, `slug`, `order`) VALUES
            (1, '700000', 'Hồ Chí Minh', 'Ho-Chi-Minh', 1),
            (2, '100000', 'Hà Nội', 'Ha-Noi', 2),
            (3, '880000', 'An Giang', 'An-Giang', 3),
            (4, '790000', 'Bà Rịa - Vũng Tàu', 'Ba-Ria-Vung-Tau', 4),
            (5, '960000', 'Bắc Cạn', 'Bac-Can', 5),
            (6, '230000', 'Bắc Giang', 'Bac-Giang', 6),
            (7, '260000', 'Bạc Liêu', 'Bac-Lieu', 7),
            (8, '220000', 'Bắc Ninh', 'Bac-Ninh', 8),
            (9, '930000', 'Bến Tre', 'Ben-Tre', 9),
            (10, '590000', 'Bình Định', 'Binh-Dinh', 10),
            (11, '820000', 'Bình Dương', 'Binh-Duong', 11),
            (12, '830000', 'Bình Phước', 'Binh-Phuoc', 12),
            (13, '800000', 'Bình Thuận', 'Binh-Thuan', 13),
            (14, '970000', 'Cà Mau', 'Ca-Mau', 14),
            (15, '900000', 'Cần Thơ', 'Can-Tho', 15),
            (16, '270000', 'Cao Bằng', 'Cao-Bang', 16),
            (17, '550000', 'Đà Nẵng', 'Da-Nang', 17),
            (18, '630000', 'Đắc Lắc', 'Dac-Lac', 18),
            (19, '640000', 'Đắk Nông', 'Dak-Nong', 19),
            (20, '380000', 'Điện Biên', 'Dien-Bien', 20),
            (21, '810000', 'Đồng Nai', 'Dong-Nai', 21),
            (22, '870000', 'Đồng Tháp', 'Dong-Thap', 22),
            (23, '600000', 'Gia Lai', 'Gia-Lai', 23),
            (24, '310000', 'Hà Giang', 'Ha-Giang', 24),
            (25, '400000', 'Hà Nam', 'Ha-Nam', 25),
            (26, '480000', 'Hà Tĩnh', 'Ha-Tinh', 26),
            (27, '170000', 'Hải Dương', 'Hai-Duong', 27),
            (28, '180000', 'Hải Phòng', 'Hai-Phong', 28),
            (29, '910000', 'Hậu Giang', 'Hau-Giang', 29),
            (30, '350000', 'Hòa Bình', 'Hoa-Binh', 30),
            (31, '160000', 'Hưng Yên', 'Hung-Yen', 31),
            (32, '650000', 'Khánh Hòa', 'Khanh-Hoa', 32),
            (33, '920000', 'Kiên Giang', 'Kien-Giang', 33),
            (34, '580000', 'Kon Tum', 'Kon-Tum', 34),
            (35, '390000', 'Lai Châu', 'Lai-Chau', 35),
            (36, '670000', 'Lâm Đồng', 'Lam-Dong', 36),
            (37, '240000', 'Lạng Sơn', 'Lang-Son', 37),
            (38, '330000', 'Lào Cai', 'Lao-Cai', 38),
            (39, '850000', 'Long An', 'Long-An', 39),
            (40, '420000', 'Nam Định', 'Nam-Dinh', 40),
            (41, '460000 - 470000', 'Nghệ An', 'Nghe-An', 41),
            (42, '430000', 'Ninh Bình', 'Ninh-Binh', 42),
            (43, '660000', 'Ninh Thuận', 'Ninh-Thuan', 43),
            (44, '290000', 'Phú Thọ', 'Phu-Tho', 44),
            (45, '620000', 'Phú Yên', 'Phu-Yen', 45),
            (46, '510000', 'Quảng Bình', 'Quang-Binh', 46),
            (47, '560000', 'Quảng Nam', 'Quang-Nam', 47),
            (48, '570000', 'Quảng Ngãi', 'Quang-Ngai', 48),
            (49, '200000', 'Quảng Ninh', 'Quang-Ninh', 49),
            (50, '520000', 'Quảng Trị', 'Quang-Tri', 50),
            (51, '950000', 'Sóc Trăng', 'Soc-Trang', 51),
            (52, '360000', 'Sơn La', 'Son-La', 52),
            (53, '840000', 'Tây Ninh', 'Tay-Ninh', 53),
            (54, '410000', 'Thái Bình', 'Thai-Binh', 54),
            (55, '250000', 'Thái Nguyên', 'Thai-Nguyen', 55),
            (56, '440000 - 450000', 'Thanh Hoá', 'Thanh-Hoa', 56),
            (57, '530000', 'Thừa Thiên - Huế', 'Thua-Thien-Hue', 57),
            (58, '860000', 'Tiền Giang', 'Tien-Giang', 58),
            (59, '940000', 'Trà Vinh', 'Tra-Vinh', 59),
            (60, '300000', 'Tuyên Quang', 'Tuyen-Quang', 60),
            (61, '890000', 'Vĩnh Long', 'Vinh-Long', 61),
            (62, '280000', 'Vĩnh Phúc', 'Vinh-Phuc', 62),
            (63, '320000', 'Yên Bái', 'Yen-Bai', 63)");
    }
}
