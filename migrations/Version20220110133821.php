<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220110133821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE CarteCadeau ADD CONSTRAINT FK_BE8626C2BCF5E72D FOREIGN KEY (categorie_id) REFERENCES Categories (id)');
        $this->addSql('ALTER TABLE Categories ADD catEshop_id INT DEFAULT NULL, ADD catTypehm_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Categories ADD CONSTRAINT FK_75AE45B880DC6B68 FOREIGN KEY (catEshop_id) REFERENCES Eshop (id)');
        $this->addSql('ALTER TABLE Categories ADD CONSTRAINT FK_75AE45B89B1FCFFE FOREIGN KEY (catTypehm_id) REFERENCES Typehm (id)');
        $this->addSql('CREATE INDEX IDX_75AE45B880DC6B68 ON Categories (catEshop_id)');
        $this->addSql('CREATE INDEX IDX_75AE45B89B1FCFFE ON Categories (catTypehm_id)');
        $this->addSql('ALTER TABLE CommandeDetails ADD CONSTRAINT FK_CE3910DE9AADCCAA FOREIGN KEY (maCommande_id) REFERENCES `Commande` (id)');
        $this->addSql('ALTER TABLE Marque ADD marqueLogo VARCHAR(255) DEFAULT NULL, ADD updatedAt DATETIME DEFAULT NULL, ADD marqueDestination VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE Menu ADD CONSTRAINT FK_DD3795AD571B6A08 FOREIGN KEY (menuHook_id) REFERENCES Typehm (id)');
        $this->addSql('ALTER TABLE Produit ADD couleur_id INT DEFAULT NULL, ADD produitCreation DATE NOT NULL, ADD produitNouveaute DATE NOT NULL, DROP produitCouleur, DROP produitAjout, DROP produitModif, DROP produitPhoto, DROP produitPhoto1, DROP produitPhoto2, DROP produitPhoto3, DROP produitPhoto4, DROP produitPhoto5, CHANGE categorie_id categorie_id INT NOT NULL, CHANGE produitBloque produitBloque TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE Produit ADD CONSTRAINT FK_E618D5BBBCF5E72D FOREIGN KEY (categorie_id) REFERENCES Categories (id)');
        $this->addSql('ALTER TABLE Produit ADD CONSTRAINT FK_E618D5BBB5064D7E FOREIGN KEY (typehm_id) REFERENCES Typehm (id)');
        $this->addSql('ALTER TABLE Produit ADD CONSTRAINT FK_E618D5BBC256483C FOREIGN KEY (marques_id) REFERENCES Marque (id)');
        $this->addSql('ALTER TABLE Produit ADD CONSTRAINT FK_E618D5BBC31BA576 FOREIGN KEY (couleur_id) REFERENCES Couleur (id)');
        $this->addSql('CREATE INDEX IDX_E618D5BBC31BA576 ON Produit (couleur_id)');
        $this->addSql('ALTER TABLE ProduitImage ADD CONSTRAINT FK_6870FD57F347EFB FOREIGN KEY (produit_id) REFERENCES Produit (id)');
        $this->addSql('ALTER TABLE SousCategories ADD CONSTRAINT FK_EE5F7732733D0392 FOREIGN KEY (sousCatCat_id) REFERENCES Categories (id)');
        $this->addSql('ALTER TABLE SousSousCategories ADD CONSTRAINT FK_212E8AA314DD400C FOREIGN KEY (sousCat_id) REFERENCES SousCategories (id)');
        $this->addSql('ALTER TABLE Typehm CHANGE typehm_nom typehmNom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE Utilisateur ADD CONSTRAINT FK_9B80EC6497BCA7D4 FOREIGN KEY (userNationalite_id) REFERENCES Pays (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE CarteCadeau DROP FOREIGN KEY FK_BE8626C2BCF5E72D');
        $this->addSql('ALTER TABLE Categories DROP FOREIGN KEY FK_75AE45B880DC6B68');
        $this->addSql('ALTER TABLE Categories DROP FOREIGN KEY FK_75AE45B89B1FCFFE');
        $this->addSql('DROP INDEX IDX_75AE45B880DC6B68 ON Categories');
        $this->addSql('DROP INDEX IDX_75AE45B89B1FCFFE ON Categories');
        $this->addSql('ALTER TABLE Categories DROP catEshop_id, DROP catTypehm_id');
        $this->addSql('ALTER TABLE CommandeDetails DROP FOREIGN KEY FK_CE3910DE9AADCCAA');
        $this->addSql('ALTER TABLE Marque DROP marqueLogo, DROP updatedAt, DROP marqueDestination');
        $this->addSql('ALTER TABLE Menu DROP FOREIGN KEY FK_DD3795AD571B6A08');
        $this->addSql('ALTER TABLE Produit DROP FOREIGN KEY FK_E618D5BBBCF5E72D');
        $this->addSql('ALTER TABLE Produit DROP FOREIGN KEY FK_E618D5BBB5064D7E');
        $this->addSql('ALTER TABLE Produit DROP FOREIGN KEY FK_E618D5BBC256483C');
        $this->addSql('ALTER TABLE Produit DROP FOREIGN KEY FK_E618D5BBC31BA576');
        $this->addSql('DROP INDEX IDX_E618D5BBC31BA576 ON Produit');
        $this->addSql('ALTER TABLE Produit ADD produitCouleur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD produitAjout DATETIME NOT NULL, ADD produitModif DATETIME NOT NULL, ADD produitPhoto VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD produitPhoto1 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD produitPhoto2 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD produitPhoto3 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD produitPhoto4 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD produitPhoto5 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP couleur_id, DROP produitCreation, DROP produitNouveaute, CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE produitBloque produitBloque INT NOT NULL');
        $this->addSql('ALTER TABLE ProduitImage DROP FOREIGN KEY FK_6870FD57F347EFB');
        $this->addSql('ALTER TABLE SousCategories DROP FOREIGN KEY FK_EE5F7732733D0392');
        $this->addSql('ALTER TABLE SousSousCategories DROP FOREIGN KEY FK_212E8AA314DD400C');
        $this->addSql('ALTER TABLE Typehm CHANGE typehmnom typehm_nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Utilisateur DROP FOREIGN KEY FK_9B80EC6497BCA7D4');
    }
}
