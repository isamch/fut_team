-- Active: 1733769804947@@127.0.0.1@3306@ic_fut_team



-- Insert Nationality Data
INSERT INTO nationality (name_nationality, flag_url) VALUES
('Argentina', 'https://cdn.sofifa.net/flags/ar.png'),
('Portugal', 'https://cdn.sofifa.net/flags/pt.png'),
('Belgium', 'https://cdn.sofifa.net/flags/be.png'),
('France', 'https://cdn.sofifa.net/flags/fr.png'),
('Netherlands', 'https://cdn.sofifa.net/flags/nl.png'),
('Germany', 'https://cdn.sofifa.net/flags/de.png'),
('Brazil', 'https://cdn.sofifa.net/flags/br.png'),
('Egypt', 'https://cdn.sofifa.net/flags/eg.png'),
('Slovenia', 'https://cdn.sofifa.net/flags/si.png'),
('Croatia', 'https://cdn.sofifa.net/flags/hr.png');




-- Insert Clubs Data
INSERT INTO clubs (name_clubs, logo_url) VALUES
('Inter Miami', 'https://cdn.sofifa.net/meta/team/239235/120.png'),
('Al Nassr', 'https://cdn.sofifa.net/meta/team/2506/120.png'),
('Manchester City', 'https://cdn.sofifa.net/players/239/085/25_120.png'),
('Real Madrid', 'https://cdn.sofifa.net/meta/team/3468/120.png'),
('Liverpool', 'https://cdn.sofifa.net/meta/team/8/120.png'),
('Al-Hilal', 'https://cdn.sofifa.net/meta/team/7011/120.png'),
('Bayern Munich', 'https://cdn.sofifa.net/meta/team/503/120.png'),
('Atletico Madrid', 'https://cdn.sofifa.net/meta/team/7980/120.png');





-- Insert Players Data
INSERT INTO players (name, photo, nationality_id, club_id, position, rating) VALUES
('Lionel Messi', 'https://cdn.sofifa.net/players/158/023/25_120.png', 1, 1, 'RW', 93),
('Cristiano Ronaldo', 'https://cdn.sofifa.net/players/020/801/25_120.png', 2, 2, 'ST', 91),
('Kevin De Bruyne', 'https://cdn.sofifa.net/players/192/985/25_120.png', 3, 3, 'CM', 91),
('Kylian Mbappé', 'https://cdn.sofifa.net/players/231/747/25_120.png', 4, 4, 'ST', 92),
('Virgil van Dijk', 'https://cdn.sofifa.net/players/203/376/25_120.png', 5, 5, 'CB', 90),
('Antonio Rudiger', 'https://cdn.sofifa.net/players/205/452/25_120.png', 6, 4, 'CB', 88),
('Neymar Jr', 'https://cdn.sofifa.net/players/190/871/25_120.png', 7, 6, 'LW', 90),
('Mohamed Salah', 'https://cdn.sofifa.net/players/192/985/25_120.png', 8, 5, 'RW', 89),
('Joshua Kimmich', 'https://cdn.sofifa.net/players/212/622/25_120.png', 6, 7, 'CM', 89),
('Jan Oblak', 'https://cdn.sofifa.net/players/200/389/25_120.png', 9, 8, 'GK', 91),
('Luka Modrić', 'https://cdn.sofifa.net/players/177/003/25_120.png', 10, 4, 'CM', 88),
('Vinicius Junior', 'https://cdn.sofifa.net/players/238/794/25_120.png', 7, 4, 'LW', 89);




-- Insert Normal Player
INSERT INTO normal_player (id_player, pace, shooting, passing, dribbling, defending, physical) VALUES
(1, 85, 92, 91, 95, 35, 65),
(2, 84, 94, 82, 87, 34, 77),
(3, 74, 86, 93, 88, 64, 78),
(4, 97, 89, 80, 92, 39, 77),
(5, 75, 60, 70, 72, 92, 86),
(6, 82, 55, 73, 70, 86, 86),
(7, 91, 83, 86, 94, 37, 61),
(8, 93, 87, 81, 90, 45, 75),
(9, 70, 75, 88, 84, 84, 81),
(11, 74, 78, 89, 90, 72, 65),
(12, 91, 88, 85, 94, 39, 61);

-- Insert Goalkeeper
INSERT INTO goolkeeper (id_player, diving, handling, kicking, reflexes, speed, positioning) VALUES
(10, 89, 90, 78, 92, 50, 88);

