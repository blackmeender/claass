
-- CREATE TABLE user
-- (
--    id INTEGER PRIMARY KEY AUTOINCREMENT,
--    active BOOL,
--    first_name TEXT,
--    last_name TEXT,
--    created_at datetime NOT NULL,
--    updated_at datetime NULL,
--    deleted_at datetime NULL,
--    email TEXT UNIQUE
-- )

-- CREATE TABLE post
-- (
--     id INTEGER PRIMARY KEY AUTOINCREMENT,
--     user_id INTEGER,
--     header TEXT,
--     text TEXT
-- )


-- CREATE TABLE comment
-- (
--     id INTEGER PRIMARY KEY AUTOINCREMENT,
--     post_id INTEGER,
--     user_id INTEGER,
--     text TEXT
-- )