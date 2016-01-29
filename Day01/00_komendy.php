// mysql -u root -p

// quit
\q

// pokazanie wszystkich baz
show databases;

// wejscie do bazy danych
use database_name;

// wyswietl rodzaj tabeli (bedac w bazie)
describe table_name;

// pokazywanie tabel
show tables;

// pokazuje dane z kolumn (będąc w danej bazie) // * = wszyskto // zamiast * można podać nazwę kolumny

select * from table_name;

// usun cala tabele
DROP TABLE table_name;

// usun cala baze
DROP DATABASE db_name;


// wyświet w partiach

|more


// Podstawowe komendy

CRUD

INSERT INTO - Create

SELECT - Retriee

UPDATE - Update

DELETE FROM - Delete

// dodanie nowej kolumny
ALTER TABLE table_name ADD column_name datatype;


// usunięcie kolumny
ALTER TABLE table_name DROP COLUMN column_name;



//Zmiana rodzaju danych trzymanych w kolumnie
ALTER TABLE table_name MODIFY COLUMN column_name new_datatype;

// SELECT column_name FROM table_name ORDER BY column_name ASC | DESC [limit 4];

// zaczecie cyklu operacji - transferu.
begin;
rollback;
cimmit;

//połączone table - te same kolumny
selec tab.id as id_1