CREATE TABLE games_pacman (
	name VARCHAR(20) PRIMARY KEY NOT NULL,
	score INT(11) DEFAULT '0' NOT NULL,
	ip VARCHAR(15)
);

CREATE TABLE games_banned_ip (
	ip VARCHAR(15) PRIMARY KEY NOT NULL
);