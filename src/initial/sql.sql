CREATE TABLE Accounts IF NOT EXISTS (
    account_id    VARCHAR(32)  PRIMARY KEY,
    account_nick  VARCHAR(128) NOT NULL,
    account_pswd  VARCHAR(128) NOT NULL,
    account_level INT          NOT NULL,
    account_point BIGINT       NOT NULL,
    account_rank  INT          NOT NULL
);

CREATE TABLE Categories IF NOT EXISTS (
    category_id    INT PRIMARY KEY AUTO_INCREMENT,
    category_name  VARCHAR(128)
);

CREATE TABLE Treasures IF NOT EXISTS (
    treasure_id    CHAR(32)      PRIMARY KEY,
    treasure_name  VARCHAR(128)  NOT NULL,
    treasure_desc  VARCHAR(128)  NOT NULL,
    treasure_ctgr  VARCHAR(128)  NOT NULL,
    treasure_rank  INT           NOT NULL,
    treasure_price DECIMAL(64,0) NOT NULL UNSIGNED,
    FOREIGN KEY (treasure_ctgr) REFERENCES Categories(category_id)
);

CREATE TABLE Histories IF NOT EXISTS (
    account_id  CHAR(32),
    treasure_id CHAR(32),
    PRIMARY KEY(account_id, treasure_id),
    FOREIGN KEY (account_id)  REFERENCES accounts (account_id),
    FOREIGN KEY (treasure_id) REFERENCES Treasures (treasure_id)
);

-- INSERT IGNORE INTO Customer VALUES
--     (NULL, 'Administrator', 'WHERE DO U LIVE? IDK', 'Admin', 'Admin');