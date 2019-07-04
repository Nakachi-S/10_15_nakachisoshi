-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019 年 7 月 04 日 00:19
-- サーバのバージョン： 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsf_d03_db15`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `books`
--

CREATE TABLE `books` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `img_URL` varchar(256) COLLATE utf16_unicode_ci NOT NULL,
  `title` varchar(128) COLLATE utf16_unicode_ci NOT NULL,
  `description` text COLLATE utf16_unicode_ci NOT NULL,
  `infoLink` varchar(256) COLLATE utf16_unicode_ci NOT NULL,
  `comment` text COLLATE utf16_unicode_ci,
  `state_read` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- テーブルのデータのダンプ `books`
--

INSERT INTO `books` (`id`, `user_id`, `img_URL`, `title`, `description`, `infoLink`, `comment`, `state_read`) VALUES
(3, 2, 'http://books.google.com/books/content?id=9JUyDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'か「」く「」し「」ご「」と「', 'みんなには隠している、ちょっとだけ特別なちから。別になんの役にも立たないけれど、そのせいで最近、君のことが気になって仕方ないんだ――。クラスメイト5人の「かくしごと」が照らし出す、お互いへのもどかしい想い。ベストセラー『君の膵臓をたべたい』の著者が贈る、眩しくて時に切ない、共感度No.1の青春小説！', 'https://play.google.com/store/books/details?id=9JUyDwAAQBAJ&source=gbs_api', NULL, 0),
(4, 2, 'http://books.google.com/books/content?id=AxYrDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '君の膵臓をたべたい 分冊版 / 4', '「君の膵臓を食べたい」 「その君っていうのは僕のこと？」 「他に？」 本屋大賞2位、至高の青春小説を「ひとひら」の名手が完全コミック化！高校生の【僕】は、クラスメイト・山内桜良が重病で余命いくばくもないことを偶然知ってしまう。ただし桜良は病人とは思えないほど元気で天真爛漫、内向的な【僕】とは正反対である。秘密を共有する2人の奇妙な交流が始まった…！読後、みんながこのタイトルに涙した…ベストセラーの感動をそのままコミックで！待望の第一弾。', 'https://play.google.com/store/books/details?id=AxYrDwAAQBAJ&source=gbs_api', NULL, 0),
(5, 3, 'http://books.google.com/books/content?id=Jb3GNmCzcIoC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'こころ', '夏目漱石 -- 慶応3年1月5日(新暦2月9日)江戸牛込馬場下横町に生まれる。本名は夏目金之助。帝国大学文科大学(東京大学文学部)を卒業後、東京高等師範学校、松山中学、第五高等学校などの教師生活を経て、1900年イギリスに留学する。帰国後、第一高等学校で教鞭をとりながら、1905年処女作「吾輩は猫である」を発表。1906年「坊っちゃん」「草枕」を発表。1907年教職を辞し、朝日新聞社に入社。そして「虞美人草」「三四郎」などを発表するが、胃病に苦しむようになる。1916年12月9日、「明暗」の連載途中に胃潰瘍', 'https://play.google.com/store/books/details?id=Jb3GNmCzcIoC&source=gbs_api', NULL, 0),
(14, 1, 'http://books.google.com/books/content?id=HttAvgAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'なぜ人々はポケモンGoに熱中するのか?', '「ポケモンGO」は何故多くの人を熱くさせたのか、誰が作ったのか、どうして「ポケモンGO」は生まれたのか、そもそも無料のスマートフォンのゲームは何故収益性が高いのか。「ポケモンGO」とは何なのかを、あらゆる角度からひも解いていく。', 'http://books.google.co.jp/books?id=HttAvgAACAAJ&dq=%E3%83%9D%E3%82%B1%E3%83%A2%E3%83%B3&hl=&source=gbs_api', '良き内容', 2),
(15, 1, 'http://books.google.com/books/content?id=9Iz9DAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'ポケモンGO　攻略完全ガイド', '全世界的熱狂を巻き起こし続けているスマートフォン用のアプリ『Pokémon GO』（以下ポケモンGO）。日本配信開始から約１カ月が経ちました。配信直後の報道の過熱ぶりはまだ皆さんの記憶に新しいことでしょう。 シンプルゆえに老若男女がのめり込み、各々の都合で気軽に遊べる仕様がいつまで経っても飽きさせず、夜の公園ではポケモンゲットのためにますます歩き回る大人が増え続けているのです！ 本書では、いまいちどポケモンGOがどのようなアプリであるかを簡単に紹介しつつ、最新の情報、攻略法、ニュースなどを、わかりやすく解説していきます。 ポケGOブームはまだまだ終わりません！', 'https://play.google.com/store/books/details?id=9Iz9DAAAQBAJ&source=gbs_api', 'まぁまぁ楽しかったかな', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `username` varchar(25) COLLATE utf16_unicode_ci NOT NULL,
  `email` varchar(35) COLLATE utf16_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'test1', 'test1@test.com', '$2y$10$f2wQjUM4LiaO1OZzHHGSAe5tTNTzoxZc96V4i48rZ..Am33oHhJ46'),
(2, 'test2', 'test2@test.com', '$2y$10$10SW4SbLhS.teKxAQ.UnV.G2kAmDWpPebfEp8uHald86s35bWhBde'),
(3, 'test3', 'test3@test.com', '$2y$10$BUdFqzwMSPidIZ5LI2cBX.U55jZg7RmJtADmNtoDhi3hJMJ5ZgYZ.'),
(4, 'test4', 'test4@test.com', '$2y$10$iENPSZ6cLqhK4rzlcxfIFOgjhFtopDslgQ31BEN.ZcNn5yN/oncsu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
