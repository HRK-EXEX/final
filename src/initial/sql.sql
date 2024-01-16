DROP TABLE IF EXISTS HasItems, Treasures, Histories, Accounts, Categories, Items;

CREATE TABLE IF NOT EXISTS Accounts (
    account_id    VARCHAR(32)  PRIMARY KEY,
    account_nick  VARCHAR(128) NOT NULL,
    account_pswd  VARCHAR(128) NOT NULL,
    account_level INTEGER      NOT NULL,
    account_point BIGINT       NOT NULL,
    account_rank  INTEGER      NOT NULL
);

CREATE TABLE IF NOT EXISTS Categories (
    category_id   INTEGER PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(128)
);

CREATE TABLE IF NOT EXISTS Items  (
    item_id    INTEGER PRIMARY KEY AUTO_INCREMENT,
    item_name  VARCHAR(128),
    item_desc  VARCHAR(128),
    item_point VARCHAR(128)
);

CREATE TABLE IF NOT EXISTS HasItems (
    account_id VARCHAR(32),
    item_id    INTEGER,
    PRIMARY KEY (account_id, item_id),
    FOREIGN KEY (account_id) REFERENCES Accounts (account_id),
    FOREIGN KEY (item_id) REFERENCES Items (item_id)
);

CREATE TABLE IF NOT EXISTS Treasures (
    treasure_id    INTEGER       PRIMARY KEY AUTO_INCREMENT,
    treasure_name  VARCHAR(128)  NOT NULL,
    treasure_desc  VARCHAR(128)  NOT NULL,
    treasure_rank  INTEGER       NOT NULL,
    treasure_price DECIMAL(64,0) NOT NULL,
    treasure_ctgr  INTEGER       NOT NULL,
    FOREIGN KEY (treasure_ctgr) REFERENCES Categories (category_id)
);

CREATE TABLE IF NOT EXISTS Histories (
    account_id  CHAR(32),
    treasure_id INTEGER,
    PRIMARY KEY (account_id, treasure_id),
    FOREIGN KEY (account_id)  REFERENCES Accounts (account_id),
    FOREIGN KEY (treasure_id) REFERENCES Treasures (treasure_id)
);

-- ¯\_(ツ)_/¯ --
INSERT INTO Accounts VALUE ('必殺奥義！ッ管理者権限!!ッ', 'Administrator', 'ADMINNNN', 1, 0, 0);

INSERT INTO Categories (category_name) VALUES
    ('無分類'),
    ('日用品'),
    ('高級品'),
    ('インテリア'),
    ('ハードウェア'),
    ('家電機器'),
    ('建物'),
    ('概念'),
    ('惑星')
;

INSERT INTO Items (item_name, item_desc, item_point) VALUES
    ('挑戦券', 'ゲーム開始前に１枚必要。', 10),
    ('運気券', '宝が当たりやすくなる。', 15),
    ('超運券', '必ず宝が当たるようになる。', 50),
    ('豪運券', '必ずレアな宝が当たるようになる。(Aランク以上)', 200),
    ('欲張り屋', '全ての宝箱を開けられる。', 80),
    ('Ｘ視線', '宝箱の中身を見ることができる。', 100),
    ('権限の暴力', '入手したい宝を選ぶことができる。', 9999)
;

INSERT INTO Treasures (treasure_name, treasure_desc, treasure_ctgr, treasure_rank, treasure_price) VALUES 
    ('テストデータ１', 'テストですよ', 6, 0, 10),
    ('テストデータ２', 'テストですよよ', 6, 0, 100),
    ('テストデータ３', 'テストですよよよ', 6, 0, 1000)
;