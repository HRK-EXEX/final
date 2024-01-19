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
INSERT INTO Accounts VALUE ('必殺奥義！ッ管理者権限!!ッ', 'Administrator', 'ADMINNNN', 1, 0);

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
    ('運気券', '宝が当たりやすくなる。', 15),
    ('超運券', '必ず宝が当たるようになる。', 50),
    ('豪運券', '必ずレアな宝が当たるようになる。(Aランク以上)', 200),
    ('欲張り屋', '全ての宝箱を開けられる。', 80),
    ('Ｘ視線', '宝箱の中身を見ることができる。', 100),
    ('権限の暴力', '入手したい宝を選ぶことができる。', 10000)
;

INSERT INTO Treasures (treasure_name, treasure_desc, treasure_ctgr, treasure_rank, treasure_price) VALUES 
    ('テストデータ１', 'テストですよ', 0, 6, 10),
    ('テストデータ２', 'テストですよよ', 0, 6, 100),
    ('テストデータ３', 'テストですよよよ', 0, 6, 1000),
    ('ティッシュ', 'お世話になってます', 0, 1, 100),
    ('くもり止め', 'お世話になり過ぎてます', 0, 1, 400),
    ('A4コピー用紙500枚', 'お世話になってます', 0, 1, 400),
    ('CPU/GPUグリス', 'お世話になってます', 0, 3, 900),
    ('ワイヤレスイヤホン', 'お世話になってます', 0, 4, 20900),
    ('有線イヤホン', 'お世話になってます', 0, 2, 1480),
    ('ノート', 'お世話になってます', 0, 2, 120),
    ('しまむらのTシャツ', 'お世話になってます', 0, 2, 2980),
    ('Nintendo Switch', 'お世話になってません', 0, 3, 29800),
    ('PlayStation 5', 'お世話になってません', 0, 3, 66100),
    ('平均的なゲーミングPC', 'お世話になってます', 0, 4, 119800),
    ('冷蔵庫（大き目）', 'お世話になってます', 0, 3, 79800),
    ('4Kテレビ65V型', 'お世話になってません', 0, 6, 168300),
    ('一軒家', '縁がありません', 0, 13, 37601820),
    ('銅像（全身）', '', 0, 7, 4371800),
    ('ハンカチ', '', 0, 1, 360),
    ('太鼓の達人筐体', '', 0, 5, 420000),
    ('モバイルバッテリー', '', 0, 3, 5980)
;