<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005065317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menage MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON menage');
        $this->addSql('ALTER TABLE menage ADD code_menage VARCHAR(10) NOT NULL, DROP id');
        $this->addSql('ALTER TABLE menage ADD PRIMARY KEY (code_menage)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menage ADD id INT AUTO_INCREMENT NOT NULL, DROP code_menage, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
