<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200308205141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE post_type (type VARCHAR(100) NOT NULL, name VARCHAR(255) DEFAULT NULL, plural VARCHAR(255) DEFAULT NULL, icon VARCHAR(50) NOT NULL, hierarchical TINYINT(1) NOT NULL, ui TINYINT(1) NOT NULL, taxonomies LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(type)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) DEFAULT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, status VARCHAR(64) NOT NULL, title VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, excerpt LONGTEXT DEFAULT NULL, position INT NOT NULL, slug VARCHAR(128) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, UNIQUE INDEX UNIQ_5A8A6C8D989D9B62 (slug), INDEX IDX_5A8A6C8D8CDE5729 (type), INDEX IDX_5A8A6C8DA977936C (tree_root), INDEX IDX_5A8A6C8D727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxonomy_type (type VARCHAR(100) NOT NULL, name VARCHAR(255) DEFAULT NULL, plural VARCHAR(255) DEFAULT NULL, icon VARCHAR(50) NOT NULL, hierarchical TINYINT(1) NOT NULL, ui TINYINT(1) NOT NULL, taxonomies LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(type)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxonomy (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) DEFAULT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, status VARCHAR(64) NOT NULL, title VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, position INT NOT NULL, slug VARCHAR(128) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, UNIQUE INDEX UNIQ_FD12B83D989D9B62 (slug), INDEX IDX_FD12B83D8CDE5729 (type), INDEX IDX_FD12B83DA977936C (tree_root), INDEX IDX_FD12B83D727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demographic_type (type VARCHAR(100) NOT NULL, name VARCHAR(255) DEFAULT NULL, plural VARCHAR(255) DEFAULT NULL, icon VARCHAR(50) NOT NULL, hierarchical TINYINT(1) NOT NULL, ui TINYINT(1) NOT NULL, demographics LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(type)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demographic (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) DEFAULT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, status VARCHAR(64) NOT NULL, title VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, position INT NOT NULL, slug VARCHAR(128) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, UNIQUE INDEX UNIQ_F97515D2989D9B62 (slug), INDEX IDX_F97515D28CDE5729 (type), INDEX IDX_F97515D2A977936C (tree_root), INDEX IDX_F97515D2727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_type (type VARCHAR(100) NOT NULL, name VARCHAR(255) DEFAULT NULL, plural VARCHAR(255) DEFAULT NULL, icon VARCHAR(50) NOT NULL, ui TINYINT(1) NOT NULL, demographics LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(type)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(128) NOT NULL, status VARCHAR(64) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D8CDE5729 FOREIGN KEY (type) REFERENCES post_type (type)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA977936C FOREIGN KEY (tree_root) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D727ACA70 FOREIGN KEY (parent_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE taxonomy ADD CONSTRAINT FK_FD12B83D8CDE5729 FOREIGN KEY (type) REFERENCES taxonomy_type (type)');
        $this->addSql('ALTER TABLE taxonomy ADD CONSTRAINT FK_FD12B83DA977936C FOREIGN KEY (tree_root) REFERENCES taxonomy (id)');
        $this->addSql('ALTER TABLE taxonomy ADD CONSTRAINT FK_FD12B83D727ACA70 FOREIGN KEY (parent_id) REFERENCES taxonomy (id)');
        $this->addSql('ALTER TABLE demographic ADD CONSTRAINT FK_F97515D28CDE5729 FOREIGN KEY (type) REFERENCES demographic_type (type)');
        $this->addSql('ALTER TABLE demographic ADD CONSTRAINT FK_F97515D2A977936C FOREIGN KEY (tree_root) REFERENCES demographic (id)');
        $this->addSql('ALTER TABLE demographic ADD CONSTRAINT FK_F97515D2727ACA70 FOREIGN KEY (parent_id) REFERENCES demographic (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D8CDE5729');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA977936C');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D727ACA70');
        $this->addSql('ALTER TABLE taxonomy DROP FOREIGN KEY FK_FD12B83D8CDE5729');
        $this->addSql('ALTER TABLE taxonomy DROP FOREIGN KEY FK_FD12B83DA977936C');
        $this->addSql('ALTER TABLE taxonomy DROP FOREIGN KEY FK_FD12B83D727ACA70');
        $this->addSql('ALTER TABLE demographic DROP FOREIGN KEY FK_F97515D28CDE5729');
        $this->addSql('ALTER TABLE demographic DROP FOREIGN KEY FK_F97515D2A977936C');
        $this->addSql('ALTER TABLE demographic DROP FOREIGN KEY FK_F97515D2727ACA70');
        $this->addSql('DROP TABLE post_type');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE taxonomy_type');
        $this->addSql('DROP TABLE taxonomy');
        $this->addSql('DROP TABLE demographic_type');
        $this->addSql('DROP TABLE demographic');
        $this->addSql('DROP TABLE user_type');
        $this->addSql('DROP TABLE user');
    }
}
