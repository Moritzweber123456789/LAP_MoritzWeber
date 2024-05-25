-- Datenbank erstellen und verwenden
DROP DATABASE IF EXISTS User;
CREATE DATABASE User;
USE User;

-- Tabelle 'waren' erstellen und Daten einfügen
CREATE TABLE waren (
    warenId INT AUTO_INCREMENT PRIMARY KEY,
    beschreibung VARCHAR(100),
    preis FLOAT,
    steuersatz FLOAT
);
INSERT INTO waren(beschreibung, preis, steuersatz)
VALUES ('Hammer', 20, 10);

-- Tabelle 'kunde' erstellen und Daten einfügen
CREATE TABLE kunde (
    kundenId INT AUTO_INCREMENT PRIMARY KEY,
    vorname VARCHAR(200),
    nachname VARCHAR(50),
    strasse VARCHAR(70),
    plz VARCHAR(10),
    email VARCHAR(100),
    telefon VARCHAR(20),
    geburtsdatum DATE,
    erstellungsdatum TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notizen TEXT
);
INSERT INTO kunde (vorname, nachname, strasse, plz, email, telefon, geburtsdatum, notizen)
VALUES 
    ('John', 'Doe', '123 Main St', '12345', 'john.doe@example.com', '555-1234', '1980-01-01', 'Erster Kunde'),
    ('Jane', 'Smith', '456 Oak Ave', '67890', 'jane.smith@example.com', '555-5678', '1990-02-02', ''),
    ('Alice', 'Johnson', '789 Pine Rd', '54321', 'alice.johnson@example.com', '555-9876', '1985-03-03', '');

-- Tabelle 'firmen' erstellen und Daten einfügen
CREATE TABLE firmen (
    firmenId INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    strasse VARCHAR(70),
    plz VARCHAR(10)
);
INSERT INTO firmen (name, strasse, plz)
VALUES
    ('companyOne', 'blablastrasse', '1234-a'),
    ('bcompany', 'strasseyMcstrasseface', '6541-b');

-- Tabelle 'rechnung' erstellen und Daten einfügen
CREATE TABLE rechnung (
    rechnungId INT AUTO_INCREMENT PRIMARY KEY,
    datetime DATETIME,
    preis FLOAT,
    kundenId INT,
    FOREIGN KEY (kundenId) REFERENCES kunde(kundenId)
);
INSERT INTO rechnung (datetime, preis, kundenId)
VALUES ('2024-05-22 13:45:00', 12.23, 1);

-- Tabelle 'rechnungsdetails' erstellen und Daten einfügen
CREATE TABLE rechnungsdetails (
    rechnungId INT,
    warenId INT,
    FOREIGN KEY (rechnungId) REFERENCES rechnung(rechnungId),
    FOREIGN KEY (warenId) REFERENCES waren(warenId),
    PRIMARY KEY (rechnungId, warenId)
);
INSERT INTO rechnungsdetails (rechnungId, warenId)
VALUES (1, 1);

-- Daten aus 'kunde' anzeigen
SELECT * FROM kunde;
