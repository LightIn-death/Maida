<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201112090556 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE debt (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, creditor_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, accepted TINYINT(1) NOT NULL, finished TINYINT(1) NOT NULL, already_refund DOUBLE PRECISION DEFAULT NULL, deadline DATE DEFAULT NULL, INDEX IDX_DBBF0A837E3C61F9 (owner_id), INDEX IDX_DBBF0A83DF91AC92 (creditor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE debt_user (debt_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E583298D240326A5 (debt_id), INDEX IDX_E583298DA76ED395 (user_id), PRIMARY KEY(debt_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE debt ADD CONSTRAINT FK_DBBF0A837E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE debt ADD CONSTRAINT FK_DBBF0A83DF91AC92 FOREIGN KEY (creditor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE debt_user ADD CONSTRAINT FK_E583298D240326A5 FOREIGN KEY (debt_id) REFERENCES debt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE debt_user ADD CONSTRAINT FK_E583298DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE debt_user DROP FOREIGN KEY FK_E583298D240326A5');
        $this->addSql('ALTER TABLE debt DROP FOREIGN KEY FK_DBBF0A837E3C61F9');
        $this->addSql('ALTER TABLE debt DROP FOREIGN KEY FK_DBBF0A83DF91AC92');
        $this->addSql('ALTER TABLE debt_user DROP FOREIGN KEY FK_E583298DA76ED395');
        $this->addSql('DROP TABLE debt');
        $this->addSql('DROP TABLE debt_user');
        $this->addSql('DROP TABLE user');
    }
}
