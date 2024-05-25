drop database if exists rechnungen;
create database rechnungen;
use Rechnungen;

-- Erstellen der Tabelle für Kunden
CREATE TABLE Kunden (
    KundenID INT AUTO_INCREMENT PRIMARY KEY,
    Vorname VARCHAR(50),
    Nachname VARCHAR(50),
    Email VARCHAR(100),
    Telefon VARCHAR(20),
    Strasse VARCHAR(255),
    Ort VARCHAR(50),
    Postleitzahl VARCHAR(20),
    Land VARCHAR(50)
);

-- Erstellen der Tabelle für Produkte
CREATE TABLE Produkte (
    ProduktID INT AUTO_INCREMENT PRIMARY KEY,
    Produktname VARCHAR(100),
    Beschreibung TEXT,
    Einzelpreis DECIMAL(10, 2),
    Lagerbestand INT
);

-- Erstellen der Tabelle für Rechnungen
CREATE TABLE Rechnungen (
    RechnungsID INT AUTO_INCREMENT PRIMARY KEY,
    KundenID INT,
    Rechnungsdatum DATE,
    Faelligkeitsdatum DATE,
    Gesamtbetrag DECIMAL(10, 2),
    Status VARCHAR(50),
    FOREIGN KEY (KundenID) REFERENCES Kunden(KundenID)
);

-- Erstellen der Tabelle für Rechnungsdetails
CREATE TABLE Rechnungsdetails (
    RechnungsdetailsID INT AUTO_INCREMENT PRIMARY KEY,
    RechnungsID INT,
    ProduktID INT,
    Menge INT,
    Einzelpreis DECIMAL(10, 2),
    Gesamtpreis DECIMAL(10, 2),
    FOREIGN KEY (RechnungsID) REFERENCES Rechnungen(RechnungsID),
    FOREIGN KEY (ProduktID) REFERENCES Produkte(ProduktID)
);

-- Erstellen der Tabelle für Zahlungen
CREATE TABLE Zahlungen (
    ZahlungsID INT AUTO_INCREMENT PRIMARY KEY,
    RechnungsID INT,
    Zahlungsdatum DATE,
    Betrag DECIMAL(10, 2),
    Zahlungsart VARCHAR(50),
    FOREIGN KEY (RechnungsID) REFERENCES Rechnungen(RechnungsID)
);
-- Daten in die Kunden-Tabelle einfügen
INSERT INTO Kunden (Vorname, Nachname, Email, Telefon, Strasse, Ort, Postleitzahl, Land) VALUES
('Max', 'Mustermann', 'max.mustermann@example.com', '0123456789', 'Musterstraße 1', 'Musterstadt', '12345', 'Deutschland'),
('Erika', 'Mustermann', 'erika.mustermann@example.com', '0987654321', 'Musterweg 2', 'Musterstadt', '54321', 'Deutschland');

-- Daten in die Produkte-Tabelle einfügen
INSERT INTO Produkte (Produktname, Beschreibung, Einzelpreis, Lagerbestand) VALUES
('Produkt A', 'Beschreibung für Produkt A', 19.99, 100),
('Produkt B', 'Beschreibung für Produkt B', 29.99, 200);

-- Daten in die Rechnungen-Tabelle einfügen
INSERT INTO Rechnungen (KundenID, Rechnungsdatum, Faelligkeitsdatum, Gesamtbetrag, Status) VALUES
(1, '2024-05-01', '2024-06-01', 59.97, 'offen'),
(2, '2024-05-02', '2024-06-02', 29.99, 'bezahlt');

-- Daten in die Rechnungsdetails-Tabelle einfügen
INSERT INTO Rechnungsdetails (RechnungsID, ProduktID, Menge, Einzelpreis, Gesamtpreis) VALUES
(1, 1, 1, 19.99, 19.99),
(1, 2, 2, 19.99, 39.98),
(2, 2, 1, 29.99, 29.99);

-- Daten in die Zahlungen-Tabelle einfügen
INSERT INTO Zahlungen (RechnungsID, Zahlungsdatum, Betrag, Zahlungsart) VALUES
(2, '2024-05-03', 29.99, 'Kreditkarte');
