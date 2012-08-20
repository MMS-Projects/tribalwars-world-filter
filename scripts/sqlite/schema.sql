-- scripts/schema.sqlite.sql
--
-- You will need load your database schema with this SQL.
 
-- Describe FILTER_OPTIONS
-- Describe FILTERS

CREATE TABLE "filters" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "title" TEXT,
    "tag" TEXT
);

CREATE TABLE "filter_options" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "text" TEXT,
    "value" TEXT,
    "filter_id" INTEGER
);

CREATE TABLE "worlds" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "tag" TEXT,
    "game_knight" INTEGER,
    "snob_gold" INTEGER,
    "game_church" INTEGER,
    "speed" REAL,
    "coord_bonus_villages" INTEGER
);
