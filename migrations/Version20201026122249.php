<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026122249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE debt (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, creditor_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, accepted TINYINT(1) NOT NULL, finished TINYINT(1) NOT NULL, already_refund DOUBLE PRECISION DEFAULT NULL, deadline DATE DEFAULT NULL, INDEX IDX_DBBF0A837E3C61F9 (owner_id), INDEX IDX_DBBF0A83DF91AC92 (creditor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE debt ADD CONSTRAINT FK_DBBF0A837E3C61F9 FOREIGN KEY (owner_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE debt ADD CONSTRAINT FK_DBBF0A83DF91AC92 FOREIGN KEY (creditor_id) REFERENCES personne (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE debt DROP FOREIGN KEY FK_DBBF0A837E3C61F9');
        $this->addSql('ALTER TABLE debt DROP FOREIGN KEY FK_DBBF0A83DF91AC92');
        $this->addSql('DROP TABLE debt');
        $this->addSql('DROP TABLE personne');
    }
}
