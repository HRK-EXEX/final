CREATE TABLE Users IF NOT EXISTS (
    user_id    CHAR(32)      PRIMARY KEY,
    user_name  VARCHAR(128)  NOT NULL,
    user_pswd  VARCHAR(128)  NOT NULL,
    user_birth DATE          NOT NULL,
    user_money DECIMAL(64,0) UNSIGNED NOT NULL
);

CREATE TABLE Treasures IF NOT EXISTS (
    treasure_id    CHAR(32)      PRIMARY KEY,
    treasure_name  VARCHAR(128)  NOT NULL,
    treasure_desc  VARCHAR(128)  NOT NULL,
    treasure_image VARCHAR(128)  NOT NULL,
    treasure_rare  TINYINT       NOT NULL,
    treasure_price DECIMAL(64,0) UNSIGNED NOT NULL,
    treasure_days  TINYINT       NOT NULL
);

CREATE TABLE GotTreasures IF NOT EXISTS (
    user_id                   CHAR(32),
    treasure_id               CHAR(32),
    PRIMARY KEY(user_id, treasure_id),
    FOREIGN KEY (user_id)     REFERENCES Users (user_id),
    FOREIGN KEY (treasure_id) REFERENCES Treasures (treasure_id)
);



-- INSERT IGNORE INTO Customer VALUES
--     (NULL, 'Administrator', 'WHERE DO U LIVE? IDK', 'Admin', 'Admin');