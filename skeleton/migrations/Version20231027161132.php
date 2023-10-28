<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027161132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipes_diet_types (recipes_id INT NOT NULL, diet_types_id INT NOT NULL, INDEX IDX_83224D0EFDF2B1FA (recipes_id), INDEX IDX_83224D0EEC9FDDD2 (diet_types_id), PRIMARY KEY(recipes_id, diet_types_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_diet_types (user_id INT NOT NULL, diet_types_id INT NOT NULL, INDEX IDX_8EC7A387A76ED395 (user_id), INDEX IDX_8EC7A387EC9FDDD2 (diet_types_id), PRIMARY KEY(user_id, diet_types_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipes_diet_types ADD CONSTRAINT FK_83224D0EFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_diet_types ADD CONSTRAINT FK_83224D0EEC9FDDD2 FOREIGN KEY (diet_types_id) REFERENCES diet_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_diet_types ADD CONSTRAINT FK_8EC7A387A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_diet_types ADD CONSTRAINT FK_8EC7A387EC9FDDD2 FOREIGN KEY (diet_types_id) REFERENCES diet_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_diettypes DROP FOREIGN KEY FK_76691740A098876');
        $this->addSql('ALTER TABLE recipes_diettypes DROP FOREIGN KEY FK_76691740FDF2B1FA');
        $this->addSql('ALTER TABLE user_diettypes DROP FOREIGN KEY FK_FEEDA0CAA098876');
        $this->addSql('ALTER TABLE user_diettypes DROP FOREIGN KEY FK_FEEDA0CAA76ED395');
        $this->addSql('DROP TABLE recipes_diettypes');
        $this->addSql('DROP TABLE user_diettypes');
        $this->addSql('ALTER TABLE recipes CHANGE preparation_time preparation_time VARCHAR(10) DEFAULT NULL, CHANGE time_of_rest time_of_rest VARCHAR(10) DEFAULT NULL, CHANGE cooking_time cooking_time VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipes_diettypes (recipes_id INT NOT NULL, diettypes_id INT NOT NULL, INDEX IDX_76691740A098876 (diettypes_id), INDEX IDX_76691740FDF2B1FA (recipes_id), PRIMARY KEY(recipes_id, diettypes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_diettypes (user_id INT NOT NULL, diettypes_id INT NOT NULL, INDEX IDX_FEEDA0CAA76ED395 (user_id), INDEX IDX_FEEDA0CAA098876 (diettypes_id), PRIMARY KEY(user_id, diettypes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE recipes_diettypes ADD CONSTRAINT FK_76691740A098876 FOREIGN KEY (diettypes_id) REFERENCES diet_types (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_diettypes ADD CONSTRAINT FK_76691740FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_diettypes ADD CONSTRAINT FK_FEEDA0CAA098876 FOREIGN KEY (diettypes_id) REFERENCES diet_types (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_diettypes ADD CONSTRAINT FK_FEEDA0CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_diet_types DROP FOREIGN KEY FK_83224D0EFDF2B1FA');
        $this->addSql('ALTER TABLE recipes_diet_types DROP FOREIGN KEY FK_83224D0EEC9FDDD2');
        $this->addSql('ALTER TABLE user_diet_types DROP FOREIGN KEY FK_8EC7A387A76ED395');
        $this->addSql('ALTER TABLE user_diet_types DROP FOREIGN KEY FK_8EC7A387EC9FDDD2');
        $this->addSql('DROP TABLE recipes_diet_types');
        $this->addSql('DROP TABLE user_diet_types');
        $this->addSql('ALTER TABLE recipes CHANGE preparation_time preparation_time TIME NOT NULL, CHANGE time_of_rest time_of_rest TIME DEFAULT NULL, CHANGE cooking_time cooking_time TIME DEFAULT NULL');
    }
}
