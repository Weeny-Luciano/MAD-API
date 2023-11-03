<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003132618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locations DROP FOREIGN KEY FK_30AD826875E5878B');
        $this->addSql('ALTER TABLE locations DROP FOREIGN KEY FK_30AD82689D67D8AF');
        $this->addSql('DROP TABLE locations');
        $this->addSql('DROP TABLE maison');
        $this->addSql('DROP TABLE menage');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE type_maison');
        $this->addSql('ALTER TABLE user DROP nom, DROP prenom, DROP sexe, DROP date_naissance, DROP age, DROP parents, DROP cin');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE locations (maison_id INT NOT NULL, menage_id INT NOT NULL, INDEX IDX_30AD82689D67D8AF (maison_id), INDEX IDX_30AD826875E5878B (menage_id), PRIMARY KEY(maison_id, menage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE maison (id INT AUTO_INCREMENT NOT NULL, quartier_id INT DEFAULT NULL, nom_maison VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, lot VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse_map VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type_maison_id INT DEFAULT NULL, INDEX IDX_F90CB66D29A199BF (type_maison_id), INDEX IDX_F90CB66DDF1E57AB (quartier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE menage (id INT AUTO_INCREMENT NOT NULL, nom_menage VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, sexe VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_naissance DATE DEFAULT NULL, age INT DEFAULT NULL, parents JSON DEFAULT NULL, cin JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_maison (id INT AUTO_INCREMENT NOT NULL, nom_type VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE locations ADD CONSTRAINT FK_30AD826875E5878B FOREIGN KEY (menage_id) REFERENCES menage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE locations ADD CONSTRAINT FK_30AD82689D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(100) NOT NULL, ADD prenom VARCHAR(100) DEFAULT NULL, ADD sexe VARCHAR(10) NOT NULL, ADD date_naissance DATE DEFAULT NULL, ADD age INT DEFAULT NULL, ADD parents JSON DEFAULT NULL, ADD cin JSON DEFAULT NULL');
    }
}
