CREATE Table nationality (
  id int PRIMARY KEY AUTO_INCREMENT,
  name_nationality varchar(255) not null,
  flag_url TEXT NOT NULL
);

CREATE Table clubs (
  id int PRIMARY KEY AUTO_INCREMENT,
  name_clubs varchar(255) not null,
  logo_url TEXT NOT NULL
);


CREATE Table players (
  id int PRIMARY KEY AUTO_INCREMENT,
  name varchar(255) not null,
  photo TEXT NOT NULL,
  position VARCHAR(10) NOT NULL,
  rating INT NOT NULL,
  status ENUM('main', 'substitutes', 'inactive') NOT NULL,
  club_id INT,
  nationality_id INT,
  Foreign Key (club_id) REFERENCES clubs(id),
  Foreign Key (nationality_id) REFERENCES nationality(id)
);


CREATE TABLE goolkeeper (
  id int PRIMARY KEY AUTO_INCREMENT,
  diving int NOT NULL,
  handling int NOT NULL,
  kicking int NOT NULL,
  reflexes int NOT NULL,
  speed int NOT NULL,
  positioning int NOT NULL,
  id_player INT NOT NULL,
  Foreign Key (id_player) REFERENCES players(id)
);


CREATE TABLE normal_playear (
  id int PRIMARY KEY AUTO_INCREMENT,
  pace int NOT NULL,
  shooting int NOT NULL,
  passing int NOT NULL,
  dribbling int NOT NULL,
  defending int NOT NULL,
  physical int NOT NULL,
  id_player INT NOT NULL,
  Foreign Key (id_player) REFERENCES players(id)
);



