<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231101132134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notices DROP FOREIGN KEY FK_6E2C61D2FDF2B1FA');
        $this->addSql('DROP TABLE notices');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE notices (id INT AUTO_INCREMENT NOT NULL, recipes_id INT DEFAULT NULL, note INT DEFAULT NULL, INDEX IDX_6E2C61D2FDF2B1FA (recipes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE notices ADD CONSTRAINT FK_6E2C61D2FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
