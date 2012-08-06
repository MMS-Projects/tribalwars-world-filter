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

