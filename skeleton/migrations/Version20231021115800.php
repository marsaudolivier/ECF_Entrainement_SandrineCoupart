<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021115800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergens (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, phone VARCHAR(10) NOT NULL, mail VARCHAR(50) NOT NULL, request LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diet_types (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(75) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notices (id INT AUTO_INCREMENT NOT NULL, note INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, preparation_time TIME NOT NULL, time_of_rest TIME DEFAULT NULL, cooking_time TIME DEFAULT NULL, steps LONGTEXT NOT NULL, image VARCHAR(150) NOT NULL, patients_accessible TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes_notices (recipes_id INT NOT NULL, notices_id INT NOT NULL, INDEX IDX_8315486FDF2B1FA (recipes_id), INDEX IDX_8315486A6721205 (notices_id), PRIMARY KEY(recipes_id, notices_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes_diettypes (recipes_id INT NOT NULL, diettypes_id INT NOT NULL, INDEX IDX_76691740FDF2B1FA (recipes_id), INDEX IDX_76691740A098876 (diettypes_id), PRIMARY KEY(recipes_id, diettypes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes_allergens (recipes_id INT NOT NULL, allergens_id INT NOT NULL, INDEX IDX_EF93A5DAFDF2B1FA (recipes_id), INDEX IDX_EF93A5DA711662F1 (allergens_id), PRIMARY KEY(recipes_id, allergens_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, age INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_diettypes (user_id INT NOT NULL, diettypes_id INT NOT NULL, INDEX IDX_FEEDA0CAA76ED395 (user_id), INDEX IDX_FEEDA0CAA098876 (diettypes_id), PRIMARY KEY(user_id, diettypes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_allergens (user_id INT NOT NULL, allergens_id INT NOT NULL, INDEX IDX_67171250A76ED395 (user_id), INDEX IDX_67171250711662F1 (allergens_id), PRIMARY KEY(user_id, allergens_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipes_notices ADD CONSTRAINT FK_8315486FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_notices ADD CONSTRAINT FK_8315486A6721205 FOREIGN KEY (notices_id) REFERENCES notices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_diettypes ADD CONSTRAINT FK_76691740FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_diettypes ADD CONSTRAINT FK_76691740A098876 FOREIGN KEY (diettypes_id) REFERENCES diet_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_allergens ADD CONSTRAINT FK_EF93A5DAFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_allergens ADD CONSTRAINT FK_EF93A5DA711662F1 FOREIGN KEY (allergens_id) REFERENCES allergens (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A76ED395 FOREIGN KEY (user_id) REFERENCES recipes (id)');
        $this->addSql('ALTER TABLE user_diettypes ADD CONSTRAINT FK_FEEDA0CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_diettypes ADD CONSTRAINT FK_FEEDA0CAA098876 FOREIGN KEY (diettypes_id) REFERENCES diet_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_allergens ADD CONSTRAINT FK_67171250A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_allergens ADD CONSTRAINT FK_67171250711662F1 FOREIGN KEY (allergens_id) REFERENCES allergens (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipes_notices DROP FOREIGN KEY FK_8315486FDF2B1FA');
        $this->addSql('ALTER TABLE recipes_notices DROP FOREIGN KEY FK_8315486A6721205');
        $this->addSql('ALTER TABLE recipes_diettypes DROP FOREIGN KEY FK_76691740FDF2B1FA');
        $this->addSql('ALTER TABLE recipes_diettypes DROP FOREIGN KEY FK_76691740A098876');
        $this->addSql('ALTER TABLE recipes_allergens DROP FOREIGN KEY FK_EF93A5DAFDF2B1FA');
        $this->addSql('ALTER TABLE recipes_allergens DROP FOREIGN KEY FK_EF93A5DA711662F1');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A76ED395');
        $this->addSql('ALTER TABLE user_diettypes DROP FOREIGN KEY FK_FEEDA0CAA76ED395');
        $this->addSql('ALTER TABLE user_diettypes DROP FOREIGN KEY FK_FEEDA0CAA098876');
        $this->addSql('ALTER TABLE user_allergens DROP FOREIGN KEY FK_67171250A76ED395');
        $this->addSql('ALTER TABLE user_allergens DROP FOREIGN KEY FK_67171250711662F1');
        $this->addSql('DROP TABLE allergens');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE diet_types');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE notices');
        $this->addSql('DROP TABLE recipes');
        $this->addSql('DROP TABLE recipes_notices');
        $this->addSql('DROP TABLE recipes_diettypes');
        $this->addSql('DROP TABLE recipes_allergens');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_diettypes');
        $this->addSql('DROP TABLE user_allergens');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
